<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ads;
use App\Models\bus;
use App\Models\Gallery;
use App\Models\Setting;
use App\Models\Video;
use App\Models\Post;
use App\Models\aboutus;
use App\Http\Controllers\NepalidateController;
use App\Mail\SendTicketMail;
use App\Models\Booking;
use App\Models\BusRating;
use App\Models\BusShadule;
use App\Models\bustype;
use App\Models\termsandconditions;
use App\Models\contactus;
use App\Models\privacypolicy;
use App\Models\Nepaliprice;
use App\Models\Offer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function homepage(){
        $cities = Category::where('status','active')->where('is_parent',1)->get();
        return view('frontend.pages.index',compact('cities'));
    }
    public function busresult(Request $request){
        Paginator::useBootstrap();
        $from = $request->from;
        $to = $request->to;
        $in_text = $from . ' to ' . $to;
        // dd($in_text);
        $date = $request->date;
        // dd($date);
        $date = Carbon::createFromFormat('d/m/Y',$date);
        // dd($date);
        $bustype = Category::where('name',$in_text)->pluck('id')->toArray();
        $bus_ids = BusShadule::where('date',$date->format('Y-m-d'))->pluck('bus_id')->toArray();
        if(count($bus_ids) > 0){
            if(count($bustype) > 0){
                if($request->operator){
                    $user = User::where('id',$request->operator)->first();
                    if($user){
                        $buses = $user->buses()->whereIn('id',$bus_ids)->where('status','active')->wherein('busroute',$bustype)->paginate(15);
                    }else{
                        $buses = bus::whereIn('id',$bus_ids)->where('status','active')->wherein('busroute',$bustype)->paginate(15);
                    }
                }else{
                    $buses = bus::whereIn('id',$bus_ids)->where('status','active')->wherein('busroute',$bustype)->paginate(15);
                }
            }else{
                $buses_available = bus::whereIn('id',$bus_ids)->where('status','active')->limit(10)->get();
                return view('frontend.pages.busresult', compact('buses_available'));
            }
        }else{
            $buses_available = bus::whereIn('id',$bus_ids)->where('status','active')->limit(10)->get();
            return view('frontend.pages.busresult', compact('buses_available'));
        }
        return view('frontend.pages.busresult', compact('buses'));
    }

    public function esewaSuccessResponse(Request $request)
    {
        // dump(Session::get('booking_detail'));
        // dd($request->all());

        $token = $request->refId;
        $booking_id_r = $request->oid;
        $user_amount = $request->amt;
        $url = '/book/'.$booking_id_r;
        if(Session::has('booking_detail')){
            $data = Session::get('booking_detail');
            $booking = Booking::find($data['booking_id']);
            $amount = $data['amount'];
            $url = $url . $booking->bus_id;
            if(count($request->all()) == 0){
                return redirect()->to($url.'?date='. $data['date'] .'&error=Something Went Wrong, Try again!');
            }
            if($user_amount != $data['amount']){
                return redirect()->to($url.'?date='. $data['date'] .'&error=Amount Not Matched');
            }
            if(!$booking){
                return redirect()->to($url.'?date='. $data['date'] .'&error=Payment time is over! please book again!');
            }
            if($booking->status == 'cancelled'){
                return redirect()->to($url.'?date='. $data['date'] .'&error=Payment already cancelled! please book again!');
            }
            $respnose = PaymentController::esewa($amount, $token, $booking->id);
            $response = preg_replace('/\s+/', '',($this->everything_in_tags($respnose, 'response_code')));
            if($response == 'Success'){
                $booking->transaction_id = $token;
                $booking->status = 'active';
                $booking->payment_from = 'esewa';
                $booking->payment_time = now();
                $booking->payment_amount = $amount;
                $booking->save();
                return redirect()->route('book.finished');
            }else{
                return redirect()->to($url.'?date='. $data['date'] .'&error=Something Went Wrong Please Contact Us.');
            }
        }else{
            return redirect()->to($url.'?error=Payment Unsuccessful');
        }


    }


    public function bookPaySeat(Request $request, $type)
    {
        $token = $request->token;
        $user_amount = ($request->amount / 100);
        if(Session::has('booking_detail')){
            $data = Session::get('booking_detail');
            $booking = Booking::find($data['booking_id']);
            $amount = $data['amount'];
            if($user_amount != $data['amount']){
                return response()->json([
                    'status' => false,
                    'message' => 'You have to pay ' . $data['amount'],
                    'paid_amount' => $user_amount,
                ]);
            }
            if(!$booking){
                return response()->json([
                    'status' => false,
                    'message' => 'Payment time is over! please book again!',
                ]);
            }
            if($booking->status == 'cancelled'){
                return response()->json([
                    'status' => false,
                    'message' => 'Payment already cancelled! please book again!',
                ]);
            }
            if($type == 'khalti'){
                $respnose = PaymentController::khalti($amount, $token);

                $res = json_decode($respnose['respnose'], true);
                if(isset($res['idx'])){
                    $booking->transaction_id = $res['idx'];
                    $booking->status = 'active';
                    $booking->payment_from = 'khalti';
                    $booking->payment_amount = $amount;
                    $booking->payment_time = now();
                    $booking->save();
                    return response()->json([
                        'status' => true,
                        'message' => 'Payment successfully',
                        'response' => $respnose,
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Something Went Wrong Please Contact Us.',
                        'code' => $respnose,
                    ]);
                }
            }elseif($type == 'connectIPS'){
                $respnose = PaymentController::khalti($amount, $token);

                $res = json_decode($respnose['respnose'], true);
                if(isset($res['idx'])){
                    $booking->transaction_id = $res['idx'];
                    $booking->status = 'active';
                    $booking->payment_from = 'connectIPS';
                    $booking->payment_amount = $amount;
                    $booking->payment_time = now();
                    $booking->save();
                    return response()->json([
                        'status' => true,
                        'message' => 'Payment successfully',
                        'response' => $respnose,
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Something Went Wrong Please Contact Us.',
                        'code' => $respnose,
                    ]);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Payment Method Not Valid!',
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Session Expired!',
            ]);
        }
    }


    public static function everything_in_tags($string, $tagname)
    {
        $pattern = "#<\s*?$tagname\b[^>]*>(.*?)</$tagname\b[^>]*>#s";
        preg_match($pattern, $string, $matches);
        return $matches[1];
    }

    public function bookFinish()
    {
        if(Session::has('booking_detail')){
            $data = Session::get('booking_detail');
            $booking = Booking::findorfail($data['booking_id']);
            // $msg = $booking->ticket_number . ' is your ticket number of ' . $booking->busnameforpasger->name . ' of route ' . $booking->busnameforpasger->busroutename->name .'. Journey Date: '. $booking->bookingdate .'. Booked on'. $booking->created_at->format('Y-m-d h:i A') . '. Seat No. ' . $booking->map . '. Total Price: Rs. ' . $booking->payment_amount .'. Paid through '. $booking->payment_from .'. Thank You! eastbus Team.';

            $bustype = $booking->busnameforpasger ? $booking->busnameforpasger->bustypename : '';
            // dd($bustype);
            $map = explode('|', $booking->map);
            $names = json_decode($bustype->seat_names, true);
            $count = 0;
            $seats = [];
            if($names){
                foreach($map as $m){
                    $count += 1;
                    $seats[] = $names[$m];
                }
            }
            $seats = implode(',',$seats);
            $counter = $booking->busnameforpasger->operators()->where('status','active')->first();
            if($counter)
                $msg = 'eastbus M-ticket - '. $booking->ticket_number .', ' . $booking->busnameforpasger->busroutename->name .', ' . $booking->busnameforpasger->name . ', '. $booking->bookingdate .', ' . $booking->boading_point .', Seats - ' . $seats . '. Contact No - '. $counter->phone .' ('. $counter->name .'), 9828102545 (eastbus)';
            else
                $msg = 'eastbus M-ticket - '. $booking->ticket_number .', ' . $booking->busnameforpasger->busroutename->name .', ' . $booking->busnameforpasger->name . ', '. $booking->bookingdate .', ' . $booking->boading_point .', Seats - ' . $seats . '. Contact No - 9828102545 (eastbus)';
            // $msg = '
            //     eastbus Ticket Booking is Successful !!

            //     Ticket No. '. $booking->ticket_number .',
            //     Route : ' . $booking->busnameforpasger->busroutename->name .',
            //     Bus name : ' . $booking->busnameforpasger->name . ',
            //     Journey date : '. $booking->bookingdate .',
            //     Boarding point : ' . $booking->boading_point .',
            //     Seat No : ' . $booking->map . ',
            //     Price : Rs ' . $booking->payment_amount .',

            //     Contact : +977-9828102545 ( eastbus )
            // ';
            $number = $booking->pphone;
            $sendMail = SmsController::sendsms($number, $msg);
            if(!$sendMail){
                return 'Something went wrong! Please reload the page.';
            }
            Session::forget('booking_detail');
            return view('frontend.pages.user.after_payment',compact('booking'))->with('success','Your teachet Booked Successfully!');
        }else{
            return redirect(route('homepage'))->with('error','Session Expired!');
        }
    }


    public function bookingPayment()
    {
        // abort(404);
        if(Session::has('booking_detail')){
            $data = Session::get('booking_detail');
            $amount = $data['amount'];
            $booking = Booking::findorfail($data['booking_id']);

            $bus = bus::findorfail($booking->bus_id);
            if((Auth::user()->role == 'Admin') || (Auth::user()->role == 'Superadmin') || ($bus->operators()->where('users.id',Auth::user()->id)->first())){
                //
            }else{
                abort(404);
            }

            if($booking->status == 'cancelled'){
                return back()->with('error','Payment time is over! Please book again!');
            }
            $booking->transaction_id = null;
            $booking->status = 'active';
            $booking->payment_from = 'cash';
            $booking->payment_amount = $amount;
            $booking->payment_time = now();
            $booking->save();
            Session::forget('booking_detail');
            return back()->with('status','Congratulations Your Seat Booked Successfully!');
        }else{
            return redirect()->route('homepage');
        }
    }

    public function bookingCancel()
    {
        if(Session::has('booking_detail')){
            $data = Session::get('booking_detail');
            $booking = Booking::findorfail($data['booking_id']);

            $booking->status = 'cancelled';
            $booking->cancelled_time = now();
            $booking->save();
            Session::forget('booking_detail');
            return back()->with('status','Your Booking cancelled Successfully!');
        }else{
            return redirect()->route('homepage');
        }
    }


    public function reviewbus(Request $request, $id)
    {
        $request->validate([
            'rating' => 'numeric|max:5|required',
        ]);
        // dd($request->all());
        $bus = bus::findorfail($id);
        $review = BusRating::create([
            'bus_id' => $id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        return back()->with('status','Thank you for your review!');
    }




    public function book($id){
        if(Session::has('booking_detail')){
            $data = Session::get('booking_detail');
            $booking = Booking::find($data['booking_id']);
            if($booking){
                $bus = bus::findorfail($booking->bus_id);
                $bustype = Bustype::findorfail($bus->bustype);
            }else{
                $bus = bus::findorfail($id);
                $bustype = Bustype::findorfail($bus->bustype);
            }


            // dd($data);
            $booked = Booking::find($data['booking_id']);
            if(!$booked){
                if(Session::has('booking_detail')){
                    Session::forget('booking_detail');
                }
                if(isset($_GET['date'])){
                    $is_available = $bus->shadules()->whereDate('date',Carbon::createFromFormat('d/m/Y',$_GET['date'])->format('Y-m-d'))->first();
                    if(!$is_available){
                        return redirect()->route('homepage')->with('error','Not available');
                    }
                    $booked = $bus->bookings()->whereDate('bookingdate',Carbon::createFromFormat('d/m/Y',$_GET['date'])->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
                }else{
                    $is_available = $bus->shadules()->whereDate('date',now()->format('Y-m-d'))->first();
                    if(!$is_available){
                        return redirect()->route('homepage')->with('error','Not available');
                    }
                    $booked = $bus->bookings()->whereDate('bookingdate',now()->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
                }
                // $booked = $bus->bookings()->whereDate('bookingdate',now()->format('Y-m-d'))->pluck('map')->toArray();


                $selected_seats = [];
                foreach($booked as $bk){
                    $temp = explode('|',$bk);
                    foreach($temp as $t){
                        $selected_seats[] = $t;
                    }
                }
                return view('frontend.pages.booking', compact('bustype','selected_seats','bus'));

            }
            if(!($booked->status == 'cancelled')){
                $selected_seats = [];
                $temp = explode('|',$booked->map);
                foreach($temp as $t){
                    $selected_seats[] = $t;
                }
                if(isset($_GET['error'])){
                    // dd($_GET['error']);
                    Session::flash('error', $_GET['error']);
                    return view('frontend.pages.book', compact('bustype','selected_seats','bus','data'));
                }else
                    return view('frontend.pages.book', compact('bustype','selected_seats','bus','data'));
            }else{
                if(isset($_GET['date'])){
                    $is_available = $bus->shadules()->whereDate('date',Carbon::createFromFormat('d/m/Y',$_GET['date'])->format('Y-m-d'))->first();
                    if(!$is_available){
                        return redirect()->route('homepage')->with('error','Not available');
                    }
                    $booked = $bus->bookings()->whereDate('bookingdate',Carbon::createFromFormat('d/m/Y',$_GET['date'])->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
                }else{
                    $is_available = $bus->shadules()->whereDate('date',now()->format('Y-m-d'))->first();
                    if(!$is_available){
                        return redirect()->route('homepage')->with('error','Not available');
                    }
                    $booked = $bus->bookings()->whereDate('bookingdate',now()->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
                }
                // $booked = $bus->bookings()->whereDate('bookingdate',now()->format('Y-m-d'))->pluck('map')->toArray();


                $selected_seats = [];
                foreach($booked as $bk){
                    $temp = explode('|',$bk);
                    foreach($temp as $t){
                        $selected_seats[] = $t;
                    }
                }
                return view('frontend.pages.booking', compact('bustype','selected_seats','bus'));
            }

        }
        // dd(Session::get('booking_detail'));
        $bus = bus::findorfail($id);
        $bustype = Bustype::findorfail($bus->bustype);
        // dd(Carbon::createFromFormat('d/m/Y',$_GET['date'])->format('Y-m-d'));
        if(isset($_GET['date'])){
            $is_available = $bus->shadules()->whereDate('date',Carbon::createFromFormat('d/m/Y',$_GET['date'])->format('Y-m-d'))->first();
            if(!$is_available){
                return redirect()->route('homepage')->with('error','Not available');
            }
            $booked = $bus->bookings()->whereDate('bookingdate',Carbon::createFromFormat('d/m/Y',$_GET['date'])->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
        }else{
            $is_available = $bus->shadules()->whereDate('date',now()->format('Y-m-d'))->first();
            if(!$is_available){
                return redirect()->route('homepage')->with('error','Not available');
            }
            $booked = $bus->bookings()->whereDate('bookingdate',now()->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
        }
        // $booked = $bus->bookings()->whereDate('bookingdate',now()->format('Y-m-d'))->pluck('map')->toArray();


        $selected_seats = [];
        foreach($booked as $bk){
            $temp = explode('|',$bk);
            foreach($temp as $t){
                $selected_seats[] = $t;
            }
        }
        return view('frontend.pages.booking', compact('bustype','selected_seats','bus'));
    }
    public function myBookingList()
    {
        $booking = Booking::query();
        $booking = $booking->where('user_id',Auth::user()->id);
        if(isset($_GET['type'])){
            if($_GET['type'] != 'all')
            $booking = $booking->where('status',$_GET['type']);
        }
        $selected_seats = [];
        if(isset($_GET['day'])){
            $day = $_GET['day'];
            $bookings = $booking->whereDate('bookingdate',Carbon::parse($day)->format('Y-m-d'))->get();
            return view('frontend.pages.user.mybooking', compact('bookings'));
        }else{
            $bookings = $booking->latest()->limit(15)->get();
        }

        // $bookings = Booking::where('user_id',Auth::user()->id)->latest()->paginate(10);
        return view('frontend.pages.user.mybooking',  compact('bookings'));
    }
    public function myBookings(){
        $booking = Booking::query();
        $booking = $booking->where('user_id',Auth::user()->id);
        if(isset($_GET['type'])){
            if($_GET['type'] != 'all')
            $booking = $booking->where('status',$_GET['type']);
        }
        $selected_seats = [];
        if(isset($_GET['day'])){
            $day = $_GET['day'];
            $bookings = $booking->whereDate('bookingdate',Carbon::parse($day)->format('Y-m-d'))->get();
            return view('frontend.pages.user.mybooking', compact('bookings'));
        }else{
            $bookings = $booking->latest()->limit(15)->get();
        }

        // $bookings = Booking::where('user_id',Auth::user()->id)->latest()->paginate(10);
        return view('frontend.pages.user.bookings');
    }



    public function myBookingDetail($id)
    {
        $booking = Booking::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if($booking){
            return view('frontend.pages.user.bookingdetail',compact('booking'));
        }else{
            return redirect(route('my.bookings'))->with('error','Select your booking!');
        }
    }

    public function cancelbooking($id)
    {
        // dd($id);
        $booking = Booking::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if($booking){
            $booked_date = Carbon::parse($booking->bookingdate);
            if(now() < $booked_date){
                $booking->status = 'cancelled';
                $booking->cancelled_time = now();
                $booking->update();
                return back()->with('error','Your booking cancelled successfully!');
            }else{
                return back()->with('error','Something went wrong, please contact us!');
            }
        }else{
            return redirect(route('my.bookings'))->with('error','Select your booking!');
        }
    }

    public function smsBooking($id)
    {
        $booking = Booking::where('id',$id)->first();
        if($booking){
            $bustype = $booking->busnameforpasger ? $booking->busnameforpasger->bustypename : '';
            // dd($bustype);
            $map = explode('|', $booking->map);
            $names = json_decode($bustype->seat_names, true);
            $count = 0;
            $seats = [];
            if($names){
                foreach($map as $m){
                    $count += 1;
                    $seats[] = $names[$m];
                }
            }
            $seats = implode(',',$seats);
            // $msg = '
            //     eastbus Ticket Booking is Successful !!

            //     Ticket No. '. $booking->ticket_number .',
            //     Route : ' . $booking->busnameforpasger->busroutename->name .',
            //     Bus name : ' . $booking->busnameforpasger->name . ',
            //     Journey date : '. $booking->bookingdate .',
            //     Boarding point : ' . $booking->boading_point .',
            //     Seat No : ' . $seats . ',
            //     Price : Rs ' . $booking->payment_amount .',

            //     Contact : +977-9828102545 ( eastbus )
            // ';
            $counter = $booking->busnameforpasger->operators()->where('status','active')->first();
            if($counter)
                $msg = 'eastbus M-ticket - '. $booking->ticket_number .', ' . $booking->busnameforpasger->busroutename->name .', ' . $booking->busnameforpasger->name . ', '. $booking->bookingdate .', ' . $booking->boading_point .', Seats - ' . $seats . '. Contact No - '. $counter->phone .' ('. $counter->name .'), 9828102545 (eastbus)';
            else
                $msg = 'eastbus M-ticket - '. $booking->ticket_number .', ' . $booking->busnameforpasger->busroutename->name .', ' . $booking->busnameforpasger->name . ', '. $booking->bookingdate .', ' . $booking->boading_point .', Seats - ' . $seats . '. Contact No - 9828102545 (eastbus)';
            // $msg = $booking->ticket_number . ' is your ticket number of ' . $booking->busnameforpasger->name . ' of route ' . $booking->busnameforpasger->busroutename->name .'. Journey Date: '. $booking->bookingdate .'. Booked on'. $booking->created_at->format('Y-m-d h:i A') . '. Seat No. ' . $booking->map . '. Total Price: Rs. ' . $booking->payment_amount .'. Paid through '. $booking->payment_from .'. Thank You! eastbus Team.';
            $number = $booking->pphone;
            $sendMail = SmsController::sendsms($number, $msg);
            if($sendMail)
                return back()->with('success','SMS send successfully!');
            else
                return back()->with('error','SMS did not send');
        }else{
            return back()->with('error','Something went wrong try again!');
        }
    }

    public function printBooking($id)
    {
        $booking = Booking::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if($booking){
            $booked_date = Carbon::parse($booking->bookingdate);
            return view('frontend.pages.user.print',compact('booking'));
        }else{
            return redirect(route('my.bookings'))->with('error','Select your booking!');
        }
    }

    public function emailBooking($id)
    {
        $booking = Booking::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if($booking){
            $sendMail = Mail::to($booking->pemail)->send(new SendTicketMail($id));
            return back()->with('success','Mail send successfully!');
        }else{
            return back()->with('error','Something went wrong try again!');
        }
    }

    public function emailsend(Request $request)
    {
        $request->validate([
            'ticket_number' => 'required|exists:bookings,ticket_number',
            'email' => 'email|required',
        ]);
        $ticket_number = $request->ticket_number;
        $email = $request->email;
        $booking = Booking::where('ticket_number',$ticket_number)->first();
        Mail::to($email)->send(new SendTicketMail($booking->id));
        return back()->with('success','Mail send successfully!');
    }

    public function myProfile()
    {
        $id = Auth::user()->id;
        $profile = User::findorfail($id);
        return view('frontend.pages.user.profile', compact('profile'));
    }

    public function phoneVerifyCode(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $code = $request->code;
        if(!$code){
            return response([
                'status' => false,
                'message' => 'Provide Code!',
            ]);
        }
        if($user){
            if($code == $user->phone_verification_code){

                $user->is_phone_verified = now();
                $user->save();
                if($user){
                    return response([
                        'status' => true,
                        'message' => 'Verified Successfully!',
                    ]);
                }else{
                    return response([
                        'status' => false,
                        'message' => 'Something went wrong try again !.',
                    ]);
                }
            }else{
                return response([
                    'status' => false,
                    'message' => 'Code Incorrect ! ',
                ]);
            }
        }else{
            return response([
                'status' => false,
                'message' => 'Login first.',
            ]);
        }
    }

    public function phoneVerificationSend()
    {
        $user = User::find(Auth::user()->id);
        if($user){
            $phone = $user->phone;
            if($phone){
                $to = Carbon::parse($user->verification_code_g_time)->addMinutes(2)->format('Y-m-d h:i:s');
                // dd($user->code_generated_time);
                $ccc = $this->calculateDiffInMinutes(now(), $to);
                if(!$ccc){
                    return response([
                        'status' => false,
                        'message' => 'Please wait minimum 2 minute before retry!.',
                    ]);
                }
                $rand_code = rand(00000,99999);
                $message = 'Your verification code for eastbus is ' . $rand_code . '.';
                if(SmsController::sendsms($user->phone, $message)){

                    $user->phone_verification_code = $rand_code;
                    $user->verification_code_g_time = now();
                    $user->save();
                    if($user){
                        return response([
                            'status' => true,
                            'message' => 'Verification code sent successfully!',
                        ]);
                    }else{
                        return response([
                            'status' => false,
                            'message' => 'Something went wrong try again !.',
                        ]);
                    }
                }else{
                    return response([
                        'status' => false,
                        'message' => 'Something went wrong try again !. ',
                    ]);
                }
            }else{
                return response([
                    'status' => false,
                    'message' => 'Add Phone Number.',
                ]);
            }
        }else{
            return response([
                'status' => false,
                'message' => 'Login first.',
            ]);
        }
    }




    public function calculateDiffInMinutes($from, $to)
    {
        $startTime = Carbon::parse($from);
        $endTime = Carbon::parse($to);
        // dump($startTime->format('Y M d h:i'));
        // dd($endTime->format('Y M d h:i'));

        if($startTime > $endTime){
            return false;
        }else{
            return true;
        }
        return true;
        // $totalDuration =  $startTime->diff($endTime)->format('%i');
        // return $totalDuration;
    }



    public function addPhoneNumber(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user){
            $phone = $request->phone;
            if($phone){
                $check = User::where('phone',$phone)->first();
                if($check){
                    return response([
                        'status' => false,
                        'message' => 'Phone number already registered.',
                    ]);
                }else{
                    $user->phone = $phone;
                    $user->save();
                    return response([
                        'status' => true,
                        'message' => 'Phone Number Changed.',
                    ]);
                }
            }else{
                return response([
                    'status' => false,
                    'message' => 'Enter Phone Number.',
                ]);
            }
        }else{
            return response([
                'status' => false,
                'message' => 'Login First.',
            ]);
        }
    }

    public function phoneVerificationPage()
    {
        if(Auth::user()->phone){
            return view('frontend.pages.user.phone_verify');
        }
        return view('frontend.pages.user.add_phone');
    }
    public function complainsug()
    {
        return view('frontend.pages.staticpages.complainsugetin');
    }
    public function frontHelp()
    {
        return view('frontend.pages.staticpages.help');
    }
    public function privacypolicy(){
        return view('frontend.pages.staticpages.privacy-policy');
    }
    public function faq(){
        return view('frontend.pages.staticpages.faq');
    }
    public function termsconditions(){
        return view('frontend.pages.staticpages.term-and-condition');
    }
    public function contactus(){
        return view('frontend.pages.staticpages.contactus');
    }
    public function aboutus(){
        return view('frontend.pages.staticpages.aboutus');
    }
    public function gallery(Request $req){
        // return back();
        if($req->route){
            $gallery = Gallery::orderby('id','desc')->where('busroute',$req->route)->paginate(12);
        }else{
            $gallery = Gallery::orderby('id','desc')->paginate(12);
        }
        Paginator::useBootstrap();
        $routes = Category::where('status','active')->where('is_parent',0)->get();
        return view('frontend.pages.staticpages.gallery',compact('gallery','routes'));
    }
    public function offers()
    {
        $offers = Offer::where('status','active')->get();
        return view('frontend.pages.staticpages.offers', compact('offers'));
    }
}

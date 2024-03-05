<?php

namespace App\Http\Controllers;

use App\Mail\SendTicketMail;
use App\Models\Booking;
use App\Models\bus;
use App\Models\bustype as Bustype;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = Booking::all();
        $bustype = Bustype::first();
        return view('frontend.pages.bookings',compact('booking','bustype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $booking = Booking::all();
        $bus = bus::findorfail($id);
        $bustype = Bustype::findorfail($bus->bustype);
        return view('frontend.pages.booking',compact('booking','bustype','bus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $id)
    {
        $bus = Bus::findorfail($id);
        // if ($bus->booking_closing_time < $bus->departuretime){
        //     return back()->with('error','Booking Time Over!');
        // }
        $request->validate([
            'map' => 'array|required',
            'pname' => 'required',
            'pphone' => 'required',
            'pgender' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'boarding_point' => 'required|string',
            'remark' => 'nullable|string|max:200',
            'address' => 'nullable|string',
        ]);
        $bustype = Bustype::findorfail($bus->bustype);
        // dd($bustype);
        if($request->date){
            $is_available = $bus->shadules()->whereDate('date',$request->date)->first();
            if(!$is_available){
                return redirect()->route('homepage')->with('error','Not available');
            }
            $booked = $bus->bookings()->whereDate('bookingdate',$request->date)->where('status','!=','cancelled')->pluck('map')->toArray();
        }else{
            $is_available = $bus->shadules()->whereDate('date',now()->format('Y-m-d'))->first();
            if(!$is_available){
                return redirect()->route('homepage')->with('error','Not available');
            }
            $booked = $bus->bookings()->whereDate('bookingdate',now()->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
        }



        $selected_seats = [];
        foreach($booked as $bk){
            $temp = explode('|',$bk);
            foreach($temp as $t){
                $selected_seats[] = $t;
            }
        }


        $check = $this->check_map($bustype,$request->map, $selected_seats);
        if(!$check){
            return back()->with('error','Please select seat properly!');
        }

        $no_of_seats = count($request->map);
        if($no_of_seats <= 0){
            return back('error','Please Select Seat Properly!');
        }

        // amount setup
        $amount = $bus->after_discount;
        $total_amount = $no_of_seats * $amount;
        // dd($total_amount);


        $ticket_number = $this->gen_ticket_num();

        $booking = new Booking();
        $booking->ticket_number = $ticket_number;
        $booking->paied_amount = $total_amount;
        $booking->address = $request->address;
        $booking->boading_point = $request->boarding_point;
        $booking->remark = $request->remark;
        $booking->pname = $request->pname;
        $booking->pemail = $request->pemail;
        $booking->pphone = $request->pphone;
        $booking->pgender = $request->pgender;
        $booking->inactive_time = now();

        if(Auth::user()){
            $booking->user_id = Auth::user()->id;
        }
        // dd($request->all());
        if($request->date){
            $booking->bookingdate = $request->date;
        }else{
            $booking->bookingdate = now()->format('Y-m-d');
        }

        // dd($booking);

        $booking->page = $request->page;
        $booking->map =  implode('|',$request->map);
        $booking->bus_id = $bus->id;
        $booking->departuretime = $request->departuretime;
        $booking->arrivaltime = $request->arrivaltime;
        $booking->save();



        $detail = [
            'inactive_time' => now(),
            'booking_id' => $booking->id,
            'amount' => $total_amount,
            'no_of_seats' => $no_of_seats,
            'date' => $request->date,
        ];

        if(Session::has('booking_detail')){
            Session::forget('booking_detail');
        }
        Session::put('booking_detail',$detail);


        return redirect()->back()->with('status', $request->pname. ' Your Seat Booking Is In Process Please Finish Payment!');

    }

    public static function gen_ticket_num(){
        $rand_value = rand(0, 99999);
        $number = sprintf("%05s", $rand_value);
        $check = DB::table('bookings')->where('ticket_number',$number)->first();
        if($check){
            BookingController::gen_ticket_num();
        }else{
            return $number;
        }
    }


    public static function check_map($bustype, $map, $selected_seats = [])
    {
        $rows = $bustype->n_row;
        $cols = $bustype->n_col;
        $col_count = 0;

        // for filter data
        $filtered_map = [];
        for ($i = 1; $i <= $rows; $i++){
            for($j = 1; $j <= $cols; $j++){
                $row_cols = explode('|',$bustype->map);
                $pp = 0;
                foreach($row_cols as $rc){
                    $randc = explode(',',$rc);
                    $rr = $randc[0];
                    $cc = $randc[1];
                    if(($i == $rr) && ($j == $cc)){
                        $pp = $randc[2];
                    }
                }
                $col_count += 1;

                // operation
                if($pp == 1){
                    // dump($map);
                    // dd($selected_seats);

                    foreach($map as $key => $m){
                        foreach($selected_seats as $st){
                            if($st == $m){
                                return false;
                            }
                        }
                        if($m == $col_count){
                            $filtered_map[] = $m;
                            unset($map[$key]);
                        }
                    }
                }
            }
        }

        // dd('end');
        if(count($map) > 0){
            return false;
        }else{
            return true;
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function deletebooking($booking_id)
    {
        $booking = Booking::where('id',$booking_id)->first();
        $booking->delete();
        return back()->with('status', 'booking has been successfully delete!');
    }

    public function showbooking($id)
    {
        $data = Booking::find($id);
        return view('backend.pages.booking.edit', ['data' => $data]);
    }

    public function showpassangers()
    {
        Paginator::useBootstrap();
        $bookings = Booking::where('status','!=','cancelled')->latest()->paginate(100);
        // $bustype = Bustype::first();
        return view('backend.pages.passangers.index',compact('bookings'));
    }


    public function cancelledPassenger()
    {
        Paginator::useBootstrap();
        $bookings = Booking::where('status','=','cancelled')->latest()->paginate(100);
        // $bustype = Bustype::first();
        return view('backend.pages.passangers.cancelled',compact('bookings'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        $booking->name = $request->name;
        $booking->slag = $request->slag;
        $booking->save();
        return redirect()->route('admin.booking.index')->with('status','booking Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function bookingstatus($id){
        $booking = Booking::findorfail($id);
        if($booking != null){
            if($booking->status == 'active'){
                $booking->status = 'inactive';
            }else{
                $booking->status = 'active';
            }
            $booking->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry booking Didnot Found.');
        }
    }

    public function sn_update(Request $request, $id){
        $booking = Booking::findorfail($id);
        $booking->sn = $request->sn;
        $check = Booking::where('sn','=',$request->sn)->first();
        if($check == null){
            $booking->save();
            return back();
        }else {

            $above_ads = Booking::where('sn','>=',$request->sn)->get();
            foreach($above_ads as $cat){
                $cat->sn += 1;
                $cat->save();
            }
        }
        $booking->save();
        return back();
    }


    public function showTicket($id)
    {
        $booking = Booking::where('id',$id)->first();
        if($booking){
            $booked_date = Carbon::parse($booking->bookingdate);
            return view('frontend.pages.user.print',compact('booking'));
        }else{
            return redirect(route('user.showpassangers.index'))->with('error','Select your booking!');
        }
    }

    public function emailTicket($id)
    {
        $booking = Booking::where('id',$id)->first();
        if($booking){
            $sendMail = Mail::to($booking->pemail)->send(new SendTicketMail($id));
            return back()->with('success','Mail send successfully!');
        }else{
            return back()->with('error','Something went wrong try again!');
        }
    }

    public function smsTicket($id)
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
            $msg = '
                eastbus Ticket Booking is Successful !!

                Ticket No. '. $booking->ticket_number .',
                Route : ' . $booking->busnameforpasger->busroutename->name .',
                Bus name : ' . $booking->busnameforpasger->name . ',
                Journey date : '. $booking->bookingdate .',
                Boarding point : ' . $booking->boading_point .',
                Seat No : ' . $seats . ',
                Price : Rs ' . $booking->payment_amount .',

                Contact : +977-9828102545 ( eastbus )
            ';
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

    public function refundTicket($id)
    {
        $booking = Booking::where('id',$id)->first();
        if($booking){
            if($booking->refund == 1){
                return back()->with('error','Booking refunded already!');
            }
            if($booking->status == 'cancelled'){
                $booking->refund = 1;
                $booking->refund_time = now();
                $booking->update();
                return back()->with('error','booking cancelled successfully!');
            }else{
                return back()->with('error','Something went wrong, please contact us!');
            }
        }else{
            return back()->with('error','Select your booking!');
        }
    }

    public function cancelTicket($id){
        // dd($id);
        $booking = Booking::where('id',$id)->first();
        if($booking){
            $booked_date = Carbon::parse($booking->bookingdate);
                $booking->status = 'cancelled';
                $booking->cancelled_time = now();
                $booking->update();
                return back()->with('error','Your booking cancelled successfully!');
        }else{
            return redirect(route('user.showpassangers.index'))->with('error','Select your booking!');
        }
    }

    public static function totalSeats($id)
    {
        $bus = bus::find($id);
        if($bus){
            $bustype = $bus->bustypename;
            if($bustype){
                return $bustype->seats;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public static function countSelectedSeats($id)
    {
        $bus = bus::find($id);
        if($bus){
            if(isset($_GET['date'])){
                $booked = $bus->bookings()->whereDate('bookingdate',Carbon::createFromFormat('d/m/Y',$_GET['date'])->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
            }else{
                $booked = $bus->bookings()->whereDate('bookingdate',now()->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
            }

            $selected_seats = 0;
            foreach($booked as $bk){
                $temp = explode('|',$bk);
                foreach($temp as $t){
                    $selected_seats++;
                }
            }
            return $selected_seats;
        }else{
            return 0;
        }
    }











    // for admin
    public function bookintList(){
        if(isset($_GET['bus'])){
            $bus_id = $_GET['bus'];
            $bus = bus::findorfail($bus_id);
            $bustype = Bustype::findorfail($bus->bustype);


            $booking = Booking::query();
            $booked = Booking::query();

            if(isset($_GET['status'])){
                if($_GET['status'] != 'all')
                $booking = $booking->where('status',$_GET['status']);
            }
            $selected_seats = [];
            if(isset($_GET['day'])){
                $day = $_GET['day'];

                $booked = $booked->whereDate('bookingdate',Carbon::parse($day)->format('Y-m-d'))->where('status','!=','cancelled')->where('bus_id',$bus_id)->pluck('map')->toArray();
                foreach($booked as $bk){
                    $temp = explode('|',$bk);
                    foreach($temp as $t){
                        $selected_seats[] = $t;
                    }
                }


                $bookings = $booking->where('bus_id',$bus_id)->whereDate('bookingdate',Carbon::parse($day)->format('Y-m-d'))->get();
            }else{
                $bookings = [];
            }
            return view('backend.pages.bookings.list',compact('bookings','bus','bustype','selected_seats'));
        }
        return view('backend.pages.bookings.list');
    }


    public function digitalChalani()
    {

        if(isset($_GET['bus'])){
            $bus_id = $_GET['bus'];
            $bus = bus::findorfail($bus_id);
            $bustype = Bustype::findorfail($bus->bustype);


            $booking = Booking::query();
            $booked = Booking::query();
            $booking = $booking->where('status','active');
            $selected_seats = [];
            if(isset($_GET['day'])){
                $day = $_GET['day'];

                $booked = $booked->whereDate('bookingdate',Carbon::parse($day)->format('Y-m-d'))->where('status','!=','cancelled')->where('bus_id',$bus_id)->pluck('map')->toArray();
                foreach($booked as $bk){
                    $temp = explode('|',$bk);
                    foreach($temp as $t){
                        $selected_seats[] = $t;
                    }
                }


                $bookings = $booking->where('bus_id',$bus_id)->whereDate('bookingdate',Carbon::parse($day)->format('Y-m-d'))->get();
            }else{
                $bookings = [];
            }
            return view('backend.pages.bookings.digitalchalani',compact('bookings','bus','bustype','selected_seats'));
        }
        return view('backend.pages.bookings.digitalchalani');
    }

    public function paymentManage()
    {


        if(isset($_GET['bus'])){
            $bus_id = $_GET['bus'];
            if($bus_id == 'all'){
                $buses = bus::where('status','active')->pluck('id')->toArray();
            }else{
                $bus = bus::findorfail($bus_id);
            }

            $booking = Booking::query();
            $booked = Booking::query();
            if(isset($buses)){
                $booking = $booking->whereIn('bus_id',$buses);
                $booked = $booked->whereIn('bus_id',$buses);
            }else{
                $booking = $booking->where('bus_id',$bus);
                $booked = $booked->where('bus_id',$bus);
            }
            if(isset($_GET['type'])){
                if($_GET['type'] != 'all')
                    $booking = $booking->where('payment_from',$_GET['type']);
            }
            $selected_seats = [];
            if(isset($_GET['day'])){
                $day = $_GET['day'];

                $booked = $booked->whereDate('bookingdate',Carbon::parse($day)->format('Y-m-d'))->where('status','!=','cancelled')->pluck('map')->toArray();
                foreach($booked as $bk){
                    $temp = explode('|',$bk);
                    foreach($temp as $t){
                        $selected_seats[] = $t;
                    }
                }


                $bookings = $booking->whereDate('bookingdate',Carbon::parse($day)->format('Y-m-d'))->get();
            }else{
                $bookings = [];
            }
            return view('backend.pages.bookings.payment',compact('bookings','selected_seats'));
        }
        return view('backend.pages.bookings.payment');
    }
}

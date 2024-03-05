<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\bus;
use App\Models\bustype;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    public function dashboard()
    {
        return view('operator.index');
    }



    public function digitalChalani()
    {

        if(isset($_GET['bus'])){
            $bus_id = $_GET['bus'];
            $bus = bus::findorfail($bus_id);
            if(!($bus->operators()->where('users.id',Auth::user()->id))){
                abort(404);
            }
            $bustype = bustype::findorfail($bus->bustype);


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
            return view('operator.pages.digitalchalani',compact('bookings','bus','bustype','selected_seats'));
        }
        return view('operator.pages.digitalchalani');
    }


}

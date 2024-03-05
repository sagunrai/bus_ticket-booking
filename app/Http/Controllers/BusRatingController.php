<?php

namespace App\Http\Controllers;

use App\Models\bus;
use App\Models\BusRating;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class BusRatingController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        if(isset($_GET['bus'])){
            $ratings = BusRating::where('bus_id',$_GET['bus'])->paginate(15);
        }else{
            $ratings = BusRating::paginate(15);
        }

        $buses = bus::all();
        return view('backend.pages.review.list',compact('ratings','buses'));
    }

    public function destroy($id){
        $rating = BusRating::findorfail($id);
        $rating->delete();
        return back()->with('statuss','Deleted Successfully!');
    }



    public static function getRating($bus_id){
        $bus = bus::find($bus_id);
        if($bus){
            $ratings = $bus->ratings()->avg('rating');

            return floatval($ratings);

        }else{
            return 0;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\bus;
use App\Models\BusBoardingPoint;
use Illuminate\Http\Request;

class BusBoardingPointController extends Controller
{
    public function addpoint(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:dropping_point,boarding_point',
            'time' => 'required',
            'city' => 'required',
        ]);

        $bus = bus::findorfail($id);
        BusBoardingPoint::create([
            'bus_id' => $id,
            'point_type' => $request->type,
            'time' => $request->time,
            'point' => $request->city,
        ]);
        return back()->with('status','Boarding Point Added Successfully');
    }

    public function removepoint($id)
    {
        $point = BusBoardingPoint::findorfail($id);
        $point->delete();
        return back()->with('status','Boarding Point deleted Successfully');
    }
}

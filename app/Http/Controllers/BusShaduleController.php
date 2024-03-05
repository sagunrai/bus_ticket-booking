<?php

namespace App\Http\Controllers;

use App\Models\bus;
use App\Models\BusShadule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusShaduleController extends Controller
{
    public function getDates($bus, $date = null)
    {
        $date = Carbon::parse($date);
        $dates = BusShadule::where('bus_id',$bus)->where('date',$date->format('Y-m-d'))->first();
        return $dates;
    }

    public function addcalander(Request $request)
    {
        $bus_id = $request->bus;
        if(!bus::find($bus_id)){
            return response()->json([
                'status' => false,
            ]);
        }
        $date = $request->date;
        if($date){
            $date = Carbon::parse($date);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }

        if(BusShadule::where('bus_id',$bus_id)->where('date',$date->format('Y-m-d'))->first()){
            return response()->json([
                'status' => false,
            ]);
        }
        $create = BusShadule::create([
            'bus_id' => $bus_id,
            'date' => $date->format('Y-m-d'),
        ]);
        return response()->json([
            'status' => true,
            'id' => $create->id,
        ]);
    }

    public function removecalander(Request $request)
    {
        $bus_id = $request->bus;
        if(!bus::find($bus_id)){
            return response()->json([
                'status' => false,
            ]);
        }
        $date = $request->date;
        if($date){
            $date = Carbon::parse($date);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
        $id = $request->data_id;
        $shadule = BusShadule::find($id);
        if($shadule){
            $shadule->delete();
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
        return response()->json([
            'status' => true,
        ]);
    }
}

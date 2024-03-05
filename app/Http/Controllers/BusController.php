<?php

namespace App\Http\Controllers;

use App\Models\bus as Bus;
use App\Models\BusShadule;
use App\Models\bustype;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BusController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bus = Bus::all();
        return view('backend.pages.bus.index',compact('bus'));
    }

    public function active_bus(Request $request){
        if($request->day){
            $shadules = BusShadule::where('date',Carbon::parse($request->day)->format('Y-m-d'))->pluck('bus_id')->toArray();
        }else{
            $shadules = BusShadule::where('date',now()->format('Y-m-d'))->pluck('bus_id')->toArray();
        }
        $bus = Bus::whereIn('id',$shadules)->get();
        return view('backend.pages.bus.index',compact('bus'));

    }

    public function getbusRoutewise(Request $request)
    {
        $route = Category::where('id',$request->busroute)->first();
        if($route){
            $buses = Bus::where('busroute',$route->id)->get();
            return response()->json([
                'status' => true,
                'data' => $buses,
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function boadingpoints($id)
    {
        $bus = bus::findorfail($id);
        $cities = Category::where('is_parent',1)->where('status','active')->get();
        return view('backend.pages.bus.points', compact('bus','cities'));
    }


    public function calander(Request $request, $id)
    {
        $from = $request->from;
        $to = $request->to;
        $bus = bus::findorfail($id);
        if($from && $to){
            $from = Carbon::parse($from);
            $to = Carbon::parse($to);
            $finished = 0;
            $dates = [];
            $count = 1;
            $dates[0] = $from->format('Y-m').'-1';

            // $dates[0] = $from;
            $temp = $from;
            for($count = 1; $finished < 1; $count++){
                if($temp < $to){
                    $temp = $temp->addMonth();
                    $dates[$count] = $temp->format('Y-m').'-1';
                    // dd($date);
                }else if($temp == $to){

                    break;
                }else{
                    break;
                }
            }

            // dd($dates);
            return view('backend.pages.bus.calander',compact('to','from','dates','bus'));
        }else{
            return view('backend.pages.bus.calander',compact('bus'));
        }

    }

    public function details($id)
    {
        $bustype = bustype::all();
        $busroute = Category::all();
        $gallery = Gallery::where('bus_id',$id)->first();
        $bus = Bus::where('id',$id)->first();
        return view('backend.pages.bus.details',compact('bus','bustype', 'busroute','gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bustype = bustype::all();
        $users = User::where('role','Operator')->get();
        $busroute = Category::where('is_parent',0)->get();
        return view('backend.pages.bus.create', compact('bustype', 'busroute','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'operators' => 'required|array',
            'name' => 'required',
            'busroute' => 'required',
            'bustype' => 'required',
        ]);
        // dd($request->all());
        $bus = new bus();
        $bus->name = $request->name;
        $bus->amneties = $request->amneties;
        $bus->booking_policy = $request->booking_policy;
        // $bus->bus_no = $request->bus_number;
        $bus->busroute = $request->busroute;
        $bus->bustype = $request->bustype;
        $bus->departuretime = $request->departuretime;
        $bus->booking_closing_time = $request->booking_closing_time;

        $amount = $request->persitprice;
        $discount = $request->discount;
        $after_discount = $amount - ($amount * ($discount / 100));

        // amount setup
        $bus->persitprice = $request->persitprice;
        $bus->persitpricedisper = $discount;
        $bus->after_discount = $after_discount;

        $bus->arrivaltime = $request->arrivaltime;
        // $bus->sunday = $request->sunday ?  $request->sunday : 0;
        // $bus->monday = $request->monday ?  $request->monday : 0;
        // $bus->tuesday = $request->tuesday ?  $request->tuesday : 0;
        // $bus->wednesday = $request->wednesday ?  $request->wednesday : 0;
        // $bus->thursday = $request->thursday ?  $request->thursday : 0;
        // $bus->friday = $request->friday ?  $request->friday : 0;
        // $bus->saturday = $request->saturday ? $request->saturday : 0;
        $image_file = $request->file('image');
        $image_name = 'image-' . now()->format('Y-m-d-h-i-s-') . Str::random(3) . '.' . $image_file->getClientOriginalExtension();
        $image_path = 'frontend/images/busimage/';
        $success = $image_file->move($image_path,$image_name);
        $title = $image_path . $image_name;
        $bus->image = $title;
        $bus->save();

        $bus->operators()->sync($request->operators);


        // if(count($request->dates) > 0){
        //     $dates = $request->dates;
        //     foreach($dates as $date){
        //         BusShadule::create([
        //             'date' => $date,
        //             'bus_id' => $bus->id
        //         ]);
        //     }
        // }
        return redirect()->back()->with('status','Bus Added Sucessfully!');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function deletebus($bus_id)
    {
        $bus = bus::where('id',$bus_id)->first();
        $bus->delete();
        return back()->with('status', 'bus has been successfully delete!');
    }

    public function showbus($id)
    {
        $edit = bus::findorfail($id);
        $bustype = bustype::all();
        $users = User::where('role','Operator')->get();
        $busroute = Category::where('is_parent',0)->get();
        return view('backend.pages.bus.edit', compact('edit','bustype','busroute','users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'operators' => 'required|array',
            'name' => 'required',
            'busroute' => 'required',
            'bustype' => 'required',
        ]);
        $bus = bus::find($id);
        $bus->name = $request->name;
        $bus->amneties = $request->amneties;
        $bus->booking_policy = $request->booking_policy;
        // $bus->bus_no = $request->bus_number;
        $bus->busroute = $request->busroute;
        $bus->bustype = $request->bustype;
        $bus->departuretime = $request->departuretime;
        $bus->booking_closing_time = $request->booking_closing_time;
        $bus->persitprice = $request->persitprice;
        $bus->arrivaltime = $request->arrivaltime;
        $bus->sunday = $request->sunday;
        $bus->monday = $request->monday;
        $bus->tuesday = $request->tuesday;
        $bus->wednesday = $request->wednesday;
        $bus->thursday = $request->thursday;
        $bus->friday = $request->friday;
        $bus->saturday = $request->saturday;
        $bus->status = $request->status;

        if($request->file('image')){
            $image_file = $request->file('image');
            $image_name = 'image-' . now()->format('Y-m-d-h-i-s-') . Str::random(3) . '.' . $image_file->getClientOriginalExtension();
            $image_path = 'upload/content/image/';
            $success = $image_file->move($image_path,$image_name);
            $title = $image_path . $image_name;
            $bus->image = $title;
        }
        $bus->save();

        $bus->operators()->sync($request->operators);


        return redirect()->route('admin.bus.index')->with('status','bus Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(bus $bus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bus  $bus
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bus  $bus
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function busstatus($id){
        $bus = bus::findorfail($id);
        if($bus != null){
            if($bus->status == 'active'){
                $bus->status = 'inactive';
            }else{
                $bus->status = 'active';
            }
            $bus->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry bus Didnot Found.');
        }
    }

    public function sn_update(Request $request, $id){
        $bus = bus::findorfail($id);
        $bus->sn = $request->sn;
        $check = bus::where('sn','=',$request->sn)->first();
        if($check == null){
            $bus->save();
            return back();
        }else {

            $above_ads = bus::where('sn','>=',$request->sn)->get();
            foreach($above_ads as $cat){
                $cat->sn += 1;
                $cat->save();
            }
        }
        $bus->save();
        return back();
    }
}

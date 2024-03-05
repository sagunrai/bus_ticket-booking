<?php

namespace App\Http\Controllers;

use App\Models\bustype;
use Illuminate\Http\Request;

class BustypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bustype = bustype::all();
        return view('backend.pages.bustype.index',compact('bustype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.bustype.create');
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
            'name' => 'required',
        ]);

        $sn_names = json_encode(array_combine($request->seat_id, $request->seat_name));
        // dd(json_decode($sn_names, true));
        $bustype = new bustype();
        $bustype->seat_names = $sn_names;
        $bustype->name = $request->name;
        $bustype->n_row = $request->n_row;
        $bustype->n_col = $request->n_col;
        $bustype->map =  implode('|',$request->row_col);
        $bustype->seats = $request->seats;
        // dd($bustype);
        $bustype->save();
        return redirect()->back()->with('status','BusType Added Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bustype  $bustype
     * @return \Illuminate\Http\Response
     */
    public function deletebustype($bustype_id)
    {
        $bustype = bustype::where('id',$bustype_id)->first();
        $bustype->delete();
        return back()->with('status', 'Cities has been successfully delete!');
    }

    public function showbustype($id)
    {
        $data = bustype::find($id);
        return view('backend.pages.bustype.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $bustype = bustype::find($id);
        $bustype->name = $request->name;
        $bustype->save();
        return redirect()->route('admin.bustype.index')->with('status','Cities Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bustype  $bustype
     * @return \Illuminate\Http\Response
     */
    public function edit(bustype $bustype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bustype  $bustype
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bustype  $bustype
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function bustypestatus($id){
        $bustype = bustype::findorfail($id);
        if($bustype != null){
            if($bustype->status == 'active'){
                $bustype->status = 'inactive';
            }else{
                $bustype->status = 'active';
            }
            $bustype->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry bustype Didnot Found.');
        }
    }

    public function sn_update(Request $request, $id){
        $bustype = bustype::findorfail($id);
        $bustype->sn = $request->sn;
        $check = bustype::where('sn','=',$request->sn)->first();
        if($check == null){
            $bustype->save();
            return back();
        }else {

            $above_ads = bustype::where('sn','>=',$request->sn)->get();
            foreach($above_ads as $cat){
                $cat->sn += 1;
                $cat->save();
            }
        }
        $bustype->save();
        return back();
    }
}

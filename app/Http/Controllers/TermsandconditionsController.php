<?php

namespace App\Http\Controllers;

use App\Models\termsandconditions;
use Illuminate\Http\Request;

class TermsandconditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $termsandconditions = Termsandconditions::all();
        return view('backend.pages.termsandconditions.index',compact('termsandconditions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.termsandconditions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $termsandconditions = new Termsandconditions();
        $termsandconditions->termsandconditions = $request->termsandconditions;
        $termsandconditions->save();
        return redirect()->back()->with('status','termsandconditions Sent Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\termsandconditions  $termsandconditions
     * @return \Illuminate\Http\Response
     */
    public function deletetermsandconditions($termsandconditions_id)
    {
        $termsandconditions = Termsandconditions::where('id',$termsandconditions_id)->first();
        $termsandconditions->delete();
        return back()->with('status', 'termsandconditions has been successfully delete!');
    }

    public function showtermsandconditions($id)
    {
        $data = termsandconditions::find($id);
        return view('backend.pages.termsandconditions.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $termsandconditions = Termsandconditions::find($id);
        $termsandconditions->termsandconditions = $request->termsandconditions;
        $termsandconditions->save();
        return redirect()->route('admin.termsandconditions.index')->with('status','termsandconditions Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\termsandconditions  $termsandconditions
     * @return \Illuminate\Http\Response
     */
    public function edit(termsandconditions $termsandconditions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\termsandconditions  $termsandconditions
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\termsandconditions  $termsandconditions
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function termsandconditionsstatus($id){
        $termsandconditions = Termsandconditions::findorfail($id);
        if($termsandconditions != null){
            if($termsandconditions->status == 'active'){
                $termsandconditions->status = 'inactive';
            }else{
                $termsandconditions->status = 'active';
            }
            $termsandconditions->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry termsandconditions Didnot Found.');
        }
    }
}

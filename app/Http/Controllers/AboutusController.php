<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\aboutus;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutus = Aboutus::all();
        return view('backend.pages.aboutus.index',compact('aboutus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.aboutus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $aboutus = new Aboutus();
        $aboutus->aboutus = $request->aboutus;
        $aboutus->save();
        return redirect()->back()->with('status','aboutus Sent Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\aboutus  $aboutus
     * @return \Illuminate\Http\Response
     */
    public function deleteaboutus($aboutus_id)
    {
        $aboutus = Aboutus::where('id',$aboutus_id)->first();
        $aboutus->delete();
        return back()->with('status', 'aboutus has been successfully delete!');
    }

    public function showaboutus($id)
    {
        $data = Aboutus::find($id);
        return view('backend.pages.aboutus.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $aboutus = Aboutus::find($id);
        $aboutus->aboutus = $request->aboutus;
        $aboutus->save();
        return redirect()->route('admin.aboutus.index')->with('status','aboutus Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\aboutus  $aboutus
     * @return \Illuminate\Http\Response
     */
    public function edit(aboutus $aboutus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\aboutus  $aboutus
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\aboutus  $aboutus
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function aboutusstatus($id){
        $aboutus = Aboutus::findorfail($id);
        if($aboutus != null){
            if($aboutus->status == 'active'){
                $aboutus->status = 'inactive';
            }else{
                $aboutus->status = 'active';
            }
            $aboutus->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry aboutus Didnot Found.');
        }
    }
}

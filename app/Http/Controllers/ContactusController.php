<?php

namespace App\Http\Controllers;

use App\Models\contactus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactus = Contactus::all();
        return view('backend.pages.contactus.index',compact('contactus'));
    }

    public function dasg()
    {
        dd('fuck');
        return view('backend.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.contactus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $contactus = new Contactus();
        $contactus->contactus = $request->contactus;
        $contactus->save();
        return redirect()->back()->with('status','contactus Sent Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function deletecontactus($contactus_id)
    {
        $contactus = Contactus::where('id',$contactus_id)->first();
        $contactus->delete();
        return back()->with('status', 'contactus has been successfully delete!');
    }

    public function showcontactus($id)
    {
        $data = Contactus::find($id);
        return view('backend.pages.contactus.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $contactus = Contactus::find($id);
        $contactus->contactus = $request->contactus;
        $contactus->save();
        return redirect()->route('admin.contactus.index')->with('status','contactus Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function edit(contactus $contactus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contactus  $contactus
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contactus  $contactus
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function contactusstatus($id){
        $contactus = Contactus::findorfail($id);
        if($contactus != null){
            if($contactus->status == 'active'){
                $contactus->status = 'inactive';
            }else{
                $contactus->status = 'active';
            }
            $contactus->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry contactus Didnot Found.');
        }
    }
}

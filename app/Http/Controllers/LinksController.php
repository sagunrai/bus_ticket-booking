<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Links;
use Illuminate\Support\Str;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Links::all();
        return view('backend.pages.links.index',compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $links = new Links();
        $links->facebook = $request->facebook;
        $links->whatsapp = $request->whatsapp;
        $links->instagram = $request->instagram;
        $links->twitter = $request->twitter;
        $links->youtube = $request->youtube;
        $links->linkedin = $request->linkedin;
        $links->slug = Str::slug($request->name) . Str::random(8);
        $links->save();
        return redirect()->back()->with('status','links Added Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\links  $links
     * @return \Illuminate\Http\Response
     */
    public function deletelinks($links_id)
    {
        $links = Links::where('id',$links_id)->first();
        $links->delete();
        return back()->with('status', 'links has been successfully delete!');
    }

    public function showlinks($id)
    {
        $data = Links::find($id);
        return view('backend.pages.links.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $links = Links::find($id);
        $links->facebook = $request->facebook;
        $links->whatsapp = $request->whatsapp;
        $links->instagram = $request->instagram;
        $links->twitter = $request->twitter;
        $links->youtube = $request->youtube;
        $links->linkedin = $request->linkedin;
        $links->save();
        return redirect()->route('admin.links.index')->with('status','links Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\links  $links
     * @return \Illuminate\Http\Response
     */
    public function edit(links $links)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\links  $links
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\links  $links
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function linksstatus($id){
        $links = Links::findorfail($id);
        if($links != null){
            if($links->status == 'active'){
                $links->status = 'inactive';
            }else{
                $links->status = 'active';
            }
            $links->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry links Didnot Found.');
        }
    }
}

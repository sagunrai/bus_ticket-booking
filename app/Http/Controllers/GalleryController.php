<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\bus;
use App\Models\Category;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::query();
        $buses = [];
        if(isset($_GET['route'])){
            $buses = bus::query();
            $route = $_GET['route'];
            $buses = $buses->where('busroute',$route)->pluck('id')->toArray();
            $gallery = $gallery->wherein('bus_id',$buses);
        }
        $gallery =  $gallery->paginate(15);
        $routes = Category::where('is_parent',0)->get();
        return view('backend.pages.gallery.index',compact('gallery','routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $bus = bus::all();
        $busroute = Category::where('status','active')->where('is_parent',0)->get();
        return view('backend.pages.gallery.create',compact('busroute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'busroute_id' => 'required|exists:categories,id',
            'bus_id' => 'required|exists:buses,id',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // dd($request->all());
        if($request->hasfile('filename'))
        {

           foreach($request->file('filename') as $image)
           {
               $name=$image->getClientOriginalName();
               $image->move(public_path().'/frontend/images/gallery/', $name);
               $data[] = $name;
           }
        }

        $gallery= new Gallery();
        $gallery->filename=json_encode($data);
        $gallery->bus_id = $request->bus_id;
        $gallery->busroute = $request->busroute_id;
        $gallery->save();

        return back()->with('success', 'Your Bus images has been successfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function deletegallery($gallery_id)
    {
        $gallery = Gallery::where('id',$gallery_id)->first();
        $gallery->delete();
        return back()->with('status', 'gallery has been successfully delete!');
    }

    public function showgallery($id)
    {
        $data = Gallery::find($id);
        return view('backend.pages.gallery.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $img_path = '';
        if($request->file('image')){
            $img_file = $request->file('image');
            $img_name = 'image'.Str::lower(Str::random(9)).'.'.$img_file->getClientOriginalExtension();
            $img_path = 'content/epaper/';
            $success = $img_file->move($img_path,$img_name);
        }
        $gallery->image = $img_path.$img_name;
        $gallery->save();
        return redirect()->route('admin.gallery.index')->with('status','gallery Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function gallerystatus($id){
        $gallery = Gallery::findorfail($id);
        if($gallery != null){
            if($gallery->status == 'active'){
                $gallery->status = 'inactive';
            }else{
                $gallery->status = 'active';
            }
            $gallery->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry gallery Didnot Found.');
        }
    }
}

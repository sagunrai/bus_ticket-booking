<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory = Category::where('is_parent',0)->get();
        return view('backend.pages.subcategory.index',compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('is_parent',1)->get();
        $subcategory = Category::where('is_parent',1)->get();
        return view('backend.pages.subcategory.create',compact('category','subcategory'));
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
            'category' => 'required|exists:categories,id'
        ]);
        $subcategory = new Category();
        $subcategory->name = $request->name;
        $subcategory->is_parent = 0;
        $subcategory->parent_id = $request->category;
        $subcategory->subparent_id = $request->subparent_id;
        $subcategory->save();
        return redirect()->back()->with('status','Routes Added Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function deletesubcategory($subcategory_id)
    {
        $subcategory = Category::where('id',$subcategory_id)->first();
        $subcategory->delete();
        return back()->with('status', 'subcategory has been successfully delete!');
    }

    public function showsubcategory($id)
    {
        $data = Category::find($id);
        $category = Category::where('is_parent',1)->get();
        $subcategory = Category::where('is_parent',1)->get();
        return view('backend.pages.subcategory.edit', ['data' => $data])->with('category',$category)->with('subcategory',$subcategory);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|exists:categories,id'
        ]);
        $subcategory = Category::find($id);
        $subcategory->name = $request->name;
        $subcategory->is_parent = 0;
        $subcategory->parent_id = $request->category;
        $subcategory->subparent_id = $request->subparent_id;
        $subcategory->save();
        return redirect()->route('admin.subcategory.index')->with('status','subcategory Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function subcategorystatus($id){
        $subcategory = Category::findorfail($id);
        if($subcategory != null){
            if($subcategory->status == 'active'){
                $subcategory->status = 'inactive';
            }else{
                $subcategory->status = 'active';
            }
            $subcategory->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry subcategory Didnot Found.');
        }
    }
}

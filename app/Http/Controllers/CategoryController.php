<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Subategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::where('is_parent','1')->get();
        return view('backend.pages.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category.create');
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
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->back()->with('status','Cities Added Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function deletecategory($category_id)
    {
        $category = Category::where('id',$category_id)->first();
        $category->delete();
        return back()->with('status', 'Cities has been successfully delete!');
    }

    public function showcategory($id)
    {
        $data = Category::find($id);
        return view('backend.pages.category.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category.index')->with('status','Cities Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function categorystatus($id){
        $category = Category::findorfail($id);
        if($category != null){
            if($category->status == 'active'){
                $category->status = 'inactive';
            }else{
                $category->status = 'active';
            }
            $category->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry category Didnot Found.');
        }
    }

    public function sn_update(Request $request, $id){
        $category = Category::findorfail($id);
        $category->sn = $request->sn;
        $check = Category::where('sn','=',$request->sn)->first();
        if($check == null){
            $category->save();
            return back();
        }else {

            $above_ads = Category::where('sn','>=',$request->sn)->get();
            foreach($above_ads as $cat){
                $cat->sn += 1;
                $cat->save();
            }
        }
        $category->save();
        return back();
    }
}

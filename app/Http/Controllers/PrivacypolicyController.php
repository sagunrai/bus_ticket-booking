<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\privacypolicy;
use Illuminate\Http\Request;

class PrivacypolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privacypolicy = Privacypolicy::all();
        return view('backend.pages.privacypolicy.index',compact('privacypolicy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.privacypolicy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $privacypolicy = new Privacypolicy();
        $privacypolicy->privacypolicy = $request->privacypolicy;
        $privacypolicy->save();
        return redirect()->back()->with('status','privacypolicy Sent Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\privacypolicy  $privacypolicy
     * @return \Illuminate\Http\Response
     */
    public function deleteprivacypolicy($privacypolicy_id)
    {
        $privacypolicy = Privacypolicy::where('id',$privacypolicy_id)->first();
        $privacypolicy->delete();
        return back()->with('status', 'privacypolicy has been successfully delete!');
    }

    public function showprivacypolicy($id)
    {
        $data = Privacypolicy::find($id);
        return view('backend.pages.privacypolicy.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $privacypolicy = Privacypolicy::find($id);
        $privacypolicy->privacypolicy = $request->privacypolicy;
        $privacypolicy->save();
        return redirect()->route('admin.privacypolicy.index')->with('status','privacypolicy Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\privacypolicy  $privacypolicy
     * @return \Illuminate\Http\Response
     */
    public function edit(privacypolicy $privacypolicy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\privacypolicy  $privacypolicy
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\privacypolicy  $privacypolicy
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function privacypolicystatus($id){
        $privacypolicy = Privacypolicy::findorfail($id);
        if($privacypolicy != null){
            if($privacypolicy->status == 'active'){
                $privacypolicy->status = 'inactive';
            }else{
                $privacypolicy->status = 'active';
            }
            $privacypolicy->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry privacypolicy Didnot Found.');
        }
    }
}

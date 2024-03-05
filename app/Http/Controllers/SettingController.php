<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::all();
        return view('backend.pages.setting.index',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $setting = new Setting();
        $setting->address = $request->address;
        $setting->contact = $request->contact;
        $setting->email = $request->email;
        $setting->logotext = $request->logotext;
        $setting->descriptionfooter = $request->descriptionfooter;
        $setting->slag = Str::slug($request->address) . Str::random(8);
        $img_name = '';
        $img_path = '';
        if($request->file('logo')){
            $img_file = $request->file('logo');
            $img_name = 'logo'.Str::lower(Str::random(9)).'.'.$img_file->getClientOriginalExtension();
            $img_path = 'logo/';
            $success = $img_file->move($img_path,$img_name);

        }
        $setting->logo = $img_path.$img_name;
        $img_name = '';
        $img_path = '';
        if($request->file('footerlogo')){
            $img_file = $request->file('footerlogo');
            $img_name = 'logo'.Str::lower(Str::random(9)).'.'.$img_file->getClientOriginalExtension();
            $img_path = 'logo/';
            $success = $img_file->move($img_path,$img_name);

        }
        $setting->footerlogo = $img_path.$img_name;
        $setting->save();
        return redirect()->back()->with('status','setting Added Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function deletesetting($setting_id)
    {
        $setting = setting::where('id',$setting_id)->first();
        $setting->delete();
        return back()->with('status', 'setting has been successfully delete!');
    }

    public function showsetting($id)
    {
        $data = Setting::find($id);
        return view('backend.pages.setting.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        $setting->address = $request->address;
        $setting->contact = $request->contact;
        $setting->email = $request->email;
        $setting->logotext = $request->logotext;
        $setting->descriptionfooter = $request->descriptionfooter;
        $setting->slag = Str::slug($request->address) . Str::random(8);

        $img_name = '';
        $img_path = '';
        $title = $setting->logo;
        if($request->file('logo')){
            $img_file = $request->file('logo');
            $img_name = 'logo'.Str::lower(Str::random(9)).'.'.$img_file->getClientOriginalExtension();
            $img_path = 'logo/';
            $success = $img_file->move($img_path,$img_name);
            $title = $img_path.$img_name;

        }
        $setting->logo = $title;

        $img_name = '';
        $img_path = '';
        $title = $setting->footerlogo;
        if($request->file('footerlogo')){
            $img_file = $request->file('footerlogo');
            $img_name = 'footerlogo'.Str::lower(Str::random(9)).'.'.$img_file->getClientOriginalExtension();
            $img_path = 'logo/';
            $success = $img_file->move($img_path,$img_name);
            $title = $img_path.$img_name;

        }
        $setting->footerlogo = $title;

        $setting->save();
        return redirect()->route('admin.setting.index')->with('status','setting Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function settingstatus($id){
        $setting = Setting::findorfail($id);
        if($setting != null){
            if($setting->status == 'active'){
                $setting->status = 'inactive';
            }else{
                $setting->status = 'active';
            }
            $setting->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry setting Didnot Found.');
        }
    }
}

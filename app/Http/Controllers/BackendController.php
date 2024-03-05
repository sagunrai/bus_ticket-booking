<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class BackendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.index')-> with('admin');
    }

    public function profile(){
        $profile=Auth()->user();
        return view('backend.pages.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request){
        // dd($request->all());
        $users = User::find(Auth::user()->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $users->id,
            'phone' => 'required|numeric|unique:users,phone,' . $users->id,
            'gender' => 'required|in:male,female',
            'image' => 'nullable|image|mimes:jpt,png,webp,jepg,svg|max:2024',
        ]);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->password = Hash::make($request->password);
        $users->gender = $request->gender;
        $img_name = '';
        $img_path = '';
        if($request->file('image')){
            $img_file = $request->file('image');
            $img_name = 'image'.Str::lower(Str::random(9)).'.'.$img_file->getClientOriginalExtension();
            $img_path = 'content/users/';
            $success = $img_file->move($img_path,$img_name);
            $users->image = $img_path.$img_name;
        }
        $users->save();
        return back()->with('success','User Updated Successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}




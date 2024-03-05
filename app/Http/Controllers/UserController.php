<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role','user')
        ->orwhere('role','Operator')
        ->orwhere('role','Admin')
        ->get();
        return view('backend.pages.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.users.create');
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
            'name'=> 'required|string',
            'email'=>'required|string|unique:users,email',
            'phone'=>'nullable|string|unique:users,phone',
            'password'=>'required|string|min:8',
            'role'=>'required|in:Admin,user,Operator',
        ]);
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->password = Hash::make($request->password);
        $users->role = $request->role;
        $img_name = '';
        $img_path = '';
        if($request->file('image')){
            $img_file = $request->file('image');
            $img_name = 'image'.Str::lower(Str::random(9)).'.'.$img_file->getClientOriginalExtension();
            $img_path = 'content/users/';
            $success = $img_file->move($img_path,$img_name);
        }
        $users->image = $img_path.$img_name;
        $users->save();
        return redirect()->back()->with('status','User Added Sucessfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        return view('backend.pages.users.edit', ['data' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
        $users = User::find($id);
        $request->validate([
            'name'=> 'required|string',
            'email'=>'required|string|unique:users,email,'.$users->id,
            'password'=>'nullable|string|min:8',
            'role'=>'required|in:Admin,user,Author,Editor',
        ]);

        $users->name = $request->name;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->password = Hash::make($request->password);
        $users->role = $request->role;
        $img_name = '';
        $img_path = '';
        $title = $users->image;
        if($request->file('image')){
            $img_file = $request->file('image');
            $img_name = 'image'.Str::lower(Str::random(9)).'.'.$img_file->getClientOriginalExtension();
            $img_path = 'content/upload/probonolawyers/';
            $success = $img_file->move($img_path,$img_name);
            $title = $img_path.$img_name;

        }
        $users->image = $title;
        $users->save();
        return redirect()->route('admin.user.index')->with('status','User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $users = User::where('id', $id)->first();
        $users->delete();
        return back()->with('status','User Deleted Sucessfully');
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

    // update Status
    public function userstatus($id){
        $users = User::findorfail($id);
        if($users != null){
            if($users->status == 'active'){
                $users->status = 'inactive';
            }else{
                $users->status = 'active';
            }
            $users->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry users Didnot Found.');
        }
    }
    // update Role
    public function userrole($id){
        $users = User::findorfail($id);
        if($users != null){
            if($users->role == 'user'){
                $users->role = 'Admin';
            }else{
                $users->role = 'user';
            }
            $users->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry users Didnot Found.');
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BrodcastMessage;
use App\Models\Costumer;
use App\Models\FlutterNotification;
use App\Models\Images;
use App\Models\Payment;
use App\Models\Shoptype;
use App\Models\bus;
use App\Models\BusShadule;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ApiGiveController extends Controller
{

    public function allbus(){
        $allbus = bus::all();
        if($allbus == null){
            return response()->json([
                'status' => false,
                'check' => 'no',
                'message' => 'Bus Not Found',
                'data' => 'null'
            ]);
        }else{
            return response()->json([
                'status' => true,
                'check' => 'ok',
                'message' => 'Login Successfull',
                'data' => $allbus,
            ]);
        }
    }



    public function busresult(Request $request){
        $from = $request->from;
        $to = $request->to;
        $in_text = $from . ' to ' . $to;
        // dd($in_text);
        $date = $request->date;
        // dd($date);
        // $date = Carbon::createFromFormat('d/m/Y',$date);
        // $date = Carbon::parse($date);
        // dd($date);
        $bustype = Category::where('name',$in_text)->pluck('id')->toArray();
        $bus_ids = BusShadule::where('date',$date->format('Y-m-d'))->pluck('bus_id')->toArray();
        if(count($bus_ids) > 0){
            if(count($bustype) > 0){
                if($request->operator){
                    $user = User::where('id',$request->operator)->first();
                    if($user){
                        $buses = $user->buses()->whereIn('id',$bus_ids)->where('status','active')->wherein('busroute',$bustype)->paginate(15);
                    }else{
                        $buses = bus::whereIn('id',$bus_ids)->where('status','active')->wherein('busroute',$bustype)->paginate(15);
                    }
                }else{
                    $buses = bus::whereIn('id',$bus_ids)->where('status','active')->wherein('busroute',$bustype)->paginate(15);
                }
            }else{
                $buses_available = bus::whereIn('id',$bus_ids)->where('status','active')->limit(10)->get();
                return response()->json([
                    'message' => 'buses availalbe',
                    'data' => $buses_available,
                ]);
                // return view('frontend.pages.busresult', compact('buses_available'));
            }
        }else{
            $buses_available = bus::whereIn('id',$bus_ids)->where('status','active')->limit(10)->get();
            return response()->json([
                'message' => 'buses availalbe',
                'data' => $buses_available,
            ]);
            // return view('frontend.pages.busresult', compact('buses_available'));
        }
        return response()->json([
            'message' => 'buses',
            'data' => $buses,
        ]);
        // return view('frontend.pages.busresult', compact('buses'));
    }


    public function login(Request $request){
        // $email = 'njn@njn.com';
        // $password = '12345678';
        $email = $request->email;
        $password = $request->password;
        $d_token = $request->token;
        $user = User::where('email',$email)->first();
        if($user == null){
            return response()->json([
                'status' => false,
                'check' => 'no',
                'message' => 'User didnot Found',
                'data' => null,
            ]);
        }else{
            $check = Hash::check($password,$user->password);
            if($check){
                if($request->has('token')){
                    $user->device_token = $d_token;
                    $user->save();
                }

                return response()->json([
                    'status' => true,
                    'check' => 'ok',
                    'message' => 'Login Successfull',
                    'data' => $user,
                ]);
            }else{

                return response()->json([
                    'status' => false,
                    'check' => 'no',
                    'message' => 'Password did not matched',
                    'data' => null,
                ]);
            }
        }
    }

    public function register(Request $request){
        // $email = 'njn@njn.com';
        // $password = '12345678';
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users,email',
            'phone' => 'required|min:10|unique:users,phone',
            // 'dob' => 'required',
            'gender' => 'required|min:4|in:male,female,other',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|min:8',
        ]);

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        // $dob = $request->dob;
        $gender = $request->gender;
        $password = $request->password;
        $confirm_password = $request->confirmpassword;



        // $name = "nice";
        // $email = "nice@nice.com";
        // $phone = "748934738739";
        // $dob = now();
        // $gender = 'other';
        // $password = "12345678";
        // $confirm_password = "12345678";



        if($password == $confirm_password){
            // $main_password = $password;
            $main_password = Hash::make($password);
        }else{
            return response()->json([
                'status' => false,
                'check' => 'confirm password not matched',
                'message' => 'confirm password not matched',
                'data' => null,
            ]);
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            // 'date_of_birth' => $dob,
            'gender' => $gender,
            'password' => $main_password
        ]);
        if(!$user){
            return response()->json([
                'status' => false,
                'check' => 'no',
                'message' => 'User did not created',
                'data' => null,
            ]);
        }else{
            return response()->json([
                'status' => true,
                'check' => 'ok',
                'message' => 'register successfully!',
                'data' => null,
            ]);
        }
    }



    public function logout(Request $request)
    {
        $id = $request->id;
        if($id == null){
            return response()->json([
                'status' => false,
                'check' => 'provide user id',
                'message' => 'Provide User id',
                'data' => null,
            ]);
        }
        $user = User::where('id',$id)->first();
        if($user == null){
            return response()->json([
                'status' => false,
                'check' => 'user_not_found',
                'message' => 'User Did Not Found',
                'data' => null,
            ]);
        }else{
            $user->device_token = null;
            $user->save();
            return response()->json([
                'status' => true,
                'check' => 'ok',
                'message' => 'Costumer data',
                'data' => $user,
            ]);
        }
    }


    public function login_session_check(Request $request){
        $device_token = $request->device_token;
        if($device_token == null){
            return response()->json([
                'status' => false,
                'check' => 'provide device token',
                'message' => 'Provide User token',
                'data' => null,
            ]);
        }
        $user = User::where('device_token',$device_token)->first();
        if($user == null){
            return response()->json([
                'status' => false,
                'check' => 'user_not_found',
                'message' => 'User Did Not Found',
                'data' => null,
            ]);
        }else{
            return response()->json([
                'status' => true,
                'check' => 'ok',
                'message' => 'Costumer data',
                'data' => $user,
            ]);
        }
    }



}

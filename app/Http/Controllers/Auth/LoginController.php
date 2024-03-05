<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {

        if(auth()->user()->role == 'Admin'){
            return RouteServiceProvider::HOME;
        }elseif(auth()->user()->role == 'user'){
            return RouteServiceProvider::USER;
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


   public function socialLogin($social)
   {
       return Socialite::driver($social)->redirect();
   }
   /**
    * Obtain the user information from Social Logged in.
    * @param $social
    * @return Response
    */
   public function handleProviderCallback($social)
   {

        $userSocial =   Socialite::driver($social)->user();
        if($userSocial->getEmail() != null){
            $users      =   User::where(['email' => $userSocial->getEmail()])->first();
        }else{
            $users      =   User::where(['provider_id' => $userSocial->getId()])->first();
        }
        // dd($users);
        if($users){
            Auth::login($users);
            return redirect(route('homepage'))->with('success','You are login from '.$social);
        }else{
            $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                // 'image'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $social,
            ]);
            Auth::login($user);
            return redirect()->route('homepage');
       }
   }

   public function login_view(){
       return redirect(route('homepage'))->with('login_page',true);
   }

   public function login_verify(Request $request)
   {
       $request->validate([
            'email' => 'required',
            'password' => 'required',
       ]);

    //    dd($request->all());
       if(is_numeric($request->email)){
            $credentials = [
                'phone' => $request->email,
                'password' => $request->password,
            ];
       }else{
           $credentials = $credentials = $request->only('email', 'password');
       }

       if (Auth::attempt($credentials)) {
           return redirect()->route('homepage');
       }
       return back()->with('error','credientals not matched !')->with('login_page',true);
   }




      /**
       * Get the needed authorization credentials from the request.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return array
       */
      protected function credentials(Request $request)
      {
        if(is_numeric($request->get('email'))){
          return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
        }

        return ['email' => $request->get('email'), 'password'=>$request->get('password')];
      }

}

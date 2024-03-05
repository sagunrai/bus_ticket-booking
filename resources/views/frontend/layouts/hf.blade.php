
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eastbus</title>



    <link rel="icon" href="{{ asset('frontend/images/logo/favicon.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="eastbus || My Seat, My Choice">
    <meta property="og:image" content="{{ asset('frontend/images/logo/favicon.png') }}">
    <meta property="og:description" content="eastbus.com ( eastbus Travel Agency Private Limited ) provides a technology platform for online bus ticketing that connects intending travellers with bus partners. ">
    <meta property="og:url" content="https://www.eastbus.com/">
    <meta property="og:site_name" content="eastbus">



    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @yield('style')
</head>

<body >
    {{-- login/register --}}
    @auth
@else
{{-- {{ dd(session('login_page')) }} --}}
<section id="login_section"
     style=" {{ (session('login_page') || session('register_page') || $errors->any()) ? '' : 'display:none;' }}">
   <div class="login_container" style="overflow-x: scroll; overflow-y: unset">
    <div class="row" style="height: 100%">

      <div class="col-md-4 col-10 mx-auto my-auto">
        <div class="card login_card">
            <div class="card-header d-flex">
                <span class="close_btn ml-auto" onclick="closeLoginForm()">X</span>
            </div>
          <div class="card-body mx-auto col-md-11">
            <form  action="{{ route('login') }}" method="POST" class="col-12 f_o_l_r_s" style="display: none;">
                @csrf
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" class=" costum_input" placeholder="" aria-describedby="">

                    @error('email')
                        <span class="" role="alert" style="

                            font-size: 10px;
                            color: red;
                            font-weight: 300;
                        ">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group" style="position:relative">
                  <label for="password_log">Password</label>
                  <input type="password" name="password" id="password_log" class=" costum_input" style="padding-right: 25px;" placeholder="" aria-describedby="">
                    <i class="fas fa-eye form-control-feedback show_hide_password_button" rel-id="password_log"></i>
                    @error('password')
                        <span class="" role="alert" style="

                            font-size: 10px;
                            color: red;
                            font-weight: 300;
                        ">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-check mb-2">
                  <label class="form-check-label">
                    <input type="checkbox" checked class="form-check-input" name="remember" id="remeberme">
                    Remember Me
                  </label>
                </div>
                <button type="submit" id="login_" class="btn login_button">Login</button>
            </form>

            <form  action="{{ route('register') }}" method="POST" class="col-12 f_o_l_r_s" style=" ">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class=" costum_input" placeholder="" aria-describedby="">

                    @error('name')
                        <span class="" role="alert" style="

                            font-size: 10px;
                            color: red;
                            font-weight: 300;
                        ">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class=" costum_input" placeholder="" aria-describedby="">

                    @error('email')
                        <span class="" role="alert" style="

                            font-size: 10px;
                            color: red;
                            font-weight: 300;
                        ">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="number" name="phone" id="phone" class=" costum_input" placeholder="" aria-describedby="">

                    @error('phone')
                        <span class="" role="alert" style="

                            font-size: 10px;
                            color: red;
                            font-weight: 300;
                        ">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="gender">Gender</label>
                  <select name="gender" id="gender" class=" costum_input">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                  </select>

                    @error('gender')
                        <span class="" role="alert" style="

                            font-size: 10px;
                            color: red;
                            font-weight: 300;
                        ">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group" style="position:relative">
                  <label for="password_reg">Password</label>
                  <input type="password" name="password" id="password_reg" class=" costum_input" placeholder="" style="padding-right: 25px;" aria-describedby="">
                    <i class="fas fa-eye form-control-feedback show_hide_password_button" rel-id="password_reg"></i>
                    @error('password')
                        <span class="" role="alert" style="

                            font-size: 10px;
                            color: red;
                            font-weight: 300;
                        ">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group" style="position:relative">
                    @csrf
                  <label for="password_conf">Password Confirm</label>
                  <input type="password" name="password_confirmation" id="password_conf" class=" costum_input" placeholder="" style="padding-right: 25px;" aria-describedby="">
                  <i class="fas fa-eye form-control-feedback show_hide_password_button" rel-id="password_conf"></i>
                </div>
                <button type="submit" id="register_" class="btn login_button">Sign Up</button>
            </form>


            <a href="{{ route('password.request') }}" class="d-block text-right">Forget password ? </a>
            <hr>
            <div class="d-block text-center col-12">
                <p class="login_Up_" style="display: none">Didn't have an account ? <a href="javascript:void(0);" class="l_r_s_q login_button btn">Sign Up </a></p>
                <p class="login_Up_">Already have an account ? <a href="javascript:void(0);" class="l_r_s_q login_button btn">Log In </a></p>
                <p style="font-weight: 500;">Or</p>
                <a href="{{ url('login/facebook') }}" class="social_login social_facebook">
                   <i class="fab fa-facebook" style="font-size:20px;"></i> Continue with Facebook
                </a>
                <a href="{{ url('login/google') }}" class="social_login social_google">
                  <i class="fab fa-google" style="font-size:20px;"></i>  Continue with Google
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
   </div>
 </section>
 @endauth

    {{-- end login/register --}}
    <div class="nav-row">
        <div class="container">
            <nav class="navbar py-0 navbar-expand-lg navbar-light navcolour">
                <div class="container-fluid">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <img src="{{ asset('frontend/images/logo/eastbus.png') }}" alt="" width="50%">
                    </a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="{{ route('front.offers') }}" class="nav-item nav-link">Offers</a>
                            <a href="{{ route('contactus') }}" class="nav-item nav-link">Contact Us</a>
                            <a href="{{ route('gallery') }}" class="nav-item nav-link">Gallery</a>
                            <a href="{{ route('my.bookings.list') }}" class="nav-item nav-link">My Booking</a>

                            @guest
                            @if (Route::has('login'))
                                    <a class="nav-link nav-item nav-link " href="javascript:void(0);" onclick="openLoginForm()"  style="cursor: pointer">{{ __('Login') }}</a>
                                    {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
                             @endif
                            @else
                                <a id="navbarDropdown" class="nav-link nav-item nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('user.profile') }}" class="dropdown-item">View / Edit profile</a>
                                    @auth
                                        @if(Auth::user()->role == 'Operator')
                                            <a href="{{ route('operator.dashboard') }}" class="dropdown-item">Operator Pannel</a>
                                        @endif
                                    @endauth
                                    <a href="javascript:void(0);" class="dropdown-item" id="share_button"> Invite friends to eastbus.com  </a>
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                        @endguest
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    @yield('content')


    <div class="container-fluid footer">

        <div class="container">
            <div class="row sixthrow">
                <div class="col-md-4 col-6">
                    <h5 class="h5">About Us</h5>
                    <ul class="ul">
                        <li> <a href="{{ route('aboutus') }}">FAQs</a> </li>
                        <li><a href="{{ route('contactus') }}">Contact Us</a></li>
                        <li><a href="{{ route('termsconditions') }}">Terms & conditions</a></li>
                        <li><a href="{{ route('privacypolicy') }}">Privacy-Policy</a></a></li>

                    </ul>
                </div>
                {{-- <div class="col-md-3 col-6">
                    <h5 class="h5">Top Routes</h5>

                    <ul class="ul">
                        <li> <a href="#">Itahari To Dharan</a></li>
                        <li><a href="#">Dharan To Birtamod</a></li>
                        <li><a href="#">Biratnagar To Kakadivitta</a></li>
                        <li><a href="#">Damak To Dharan</a></li> --}}
                        {{-- <li> <a href="#"><i class="fab fa-facebook" style="color: black;"></i>Facebook</a> </li>
                        <li><a href="#"><i class="fab fa-instagram" style="color: black;"></i>Instragram</a></li>
                        <li><a href="#"><i class="fab fa-youtube" style="color: black;"></i>Youtube</a></li> --}}
                        {{-- <li><a href="https://twitter.com/bus_mandu"><i class="fab fa-twitter" style="color: black;"></i>twitter</a></li>
                        <li><a href="https://www.snapchat.com/add/eastbus"><i class="fab fa-snapchat" style="color: black;"></i>Snapchat</a></li>
                        <li><a href="https://www.linkedin.com/company/eastbus/about/"><i class="fab fa-linkedin" style="color: black;"></i>Linkedin</a></li> --}}

                    {{-- </ul>
                </div> --}}
                <div class="col-md-4 col-6 pay">
                    <h5 class="h5">Payment Partners</h5>
                    <ul class="ul">
                        <li> <a href="https://esewa.com.np/"><img src="{{ asset('frontend/images/esewa_logo.png') }}"
                                    alt=""></a> </li>
                        {{-- <li class="pa"><a href="https://www.khalti.com/"><img
                                    src="{{ asset('frontend/images/khalti-logo.png') }}"
                                    alt=""></a></li>
                        <li class="pa"><a href="https://www.connectips.com/"><img
                                    src="{{ asset('frontend/images/logo_connectIPS.png') }}" alt=""></a></li> --}}
                    </ul>
                </div>
                <div class="col-6 col-md-4">
                    <h2 style="color: white; font-family: 'Comforter Brush', cursive; margin-top: 10px;">East Bus
                    </h2>
                    <p style="color: white;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate
                        impedit
                        quo
                        incidunt consequuntur eos, quisquam id amet laudantium aliquid laboriosam eveniet cupiditate
                        minus et?
                        Earum quis ex explicabo reiciendis totam.</p>
                    <p style="color: white;">Follow Us on:
                        <a href="https://www.facebook.com/sagun.rai.31945"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/____mausam____/?fbclid=IwAR0X9ViBZpYvnXvK8VPi0N73Pjd3v5a8sdrq-Sck3mZvYPjfv4xhRWq27Ew"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/channel/UCHUVopxArYZfebZRxJ9FgBQ"><i class="fab fa-youtube"></i></a>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid  last">

        <div class="container">
            <div class="row">
                <div class="col-md-12 copyright text-center">
                    <span> &copy; Copyright:All rights reserved</span>
                </div>
                {{-- <div class="col-md-6 copyright text-right">
                    - <span>Developed By grihasewa Pvt. Ltd.</span>
                </div> --}}
            </div>
        </div>
    </div>
    @include('frontend.layouts.notify')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
        $('.dropdown-toggle').click(function (){
            var t_id = $(this).attr('id');
            $('.dropdown-menu[aria-labelledby="'+ t_id +'"]').toggleClass('show');
        });
    </script>

    <script>
        document.querySelector('#share_button').addEventListener('click', function() {
          if(navigator.share) {
            navigator.share({
                title: 'Book Bus Ticket Online',
                text: '{{ 'eastbus Pvt. Ltd.' }}',
                url: '{{ route('homepage') }}'
              })
          }
        });
  </script>
<script>

function openLoginForm(){
    $('#login_section').show();
}

function closeLoginForm(){
    $('#login_section').hide();
}

</script>
  <script>
    $('.l_r_s_q').click(function (e) {
        e.preventDefault();
        $('.login_Up_').toggle();
        $('.f_o_l_r_s').toggle();
    });
    $('#register_').click(function (e) {
        // e.preventDefault();
        localStorage.setItem("login", "regiter");
    });
    $('#login_').click(function (e) {
        // e.preventDefault();
        localStorage.setItem("login", "login");
    });
</script>
<script>
    $(document).ready(function () {
        if(localStorage.getItem("login") == 'login'){
            $('.login_Up_').toggle();
            $('.f_o_l_r_s').toggle();
        }
    });

    $('.show_hide_password_button').on('click', function() {
        $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye'); // toggle our classes for the eye icon
        var id = '#'+$(this).attr('rel-id');
        var type = $(id).attr("type");
        if (type == "text")
        { $(id).attr("type", "password");}
        else
        { $(id).attr("type", "text"); }
    });

</script>
<script>
    $(function () {
        $("#s_date").datepicker({
            dateFormat: "dd/mm/yy",
            minDate: 0
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#alert_box').fadeOut(5000);
        $('#alert_box_sec').fadeOut(5000);
    });
</script>
@yield('scripts')

</body>
</html>


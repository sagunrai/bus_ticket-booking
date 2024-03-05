@extends('frontend.layouts.hf')

@section('content')

    @include('frontend.layouts.search-filter')

    <div class="container" style="margin-top:15px; margin-bottom:15px; border:4px solid #294560; border-radius:8px;">
        {{--  <div class="row thirdrow">
            <div class="col-12 sold">
                <h1>Tickets Sold by eastbus</h1>
                <hr>
            </div>
            <div class="col-4 user">
                <h4>Our users</h4>
                <p>100000</p>
            </div>
            <div class="col-4 user">
                <h4>Our users</h4>
                <p>100000</p>
            </div>
            <div class="col-4 user">
                <h4>Our users</h4>
                <p>100000</p>
            </div>
        </div>  --}}
        <div class="row fourthrow">
            <div class="col-12 popular">
                <h1> Popular Routes</h1>
                <hr>
            </div>
            @foreach ($cities as $city)
                <div class="col-md-3 col-12 place">
                    <h4>{{ $city->name }}</h4>
                    <ul class="place1">
                        @foreach ($city->sub_category()->where('status','active')->get() as $item)
                            <li><a href="/bus-result?from={{ $item->category->name }}&to={{ $item->subcategory->name }}&date={{ now()->format('d/m/Y') }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach




        </div>

        {{--  <div class="row fifthrow">
            <div class="col-12 popularop">
                <h1> Popular Operators</h1>
                <hr>
            </div>
            <div class="col-md-4 col-12 place">
                <h4>Biratnagar to Kakadivitta</h4>
                <ul class="place1">
                    <li><a href="#">Makalu Travels</a></li>
                    <li><a href="#">Sagarmatha Travels</a></li>
                    <li><a href="#">Nagarik Travels</a></li>
                    <li><a href="#">Himalayan Travels</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-12 place">
                <h4>Biratnagar to Kakadivitta</h4>
                <ul class="place1">
                    <li><a href="#">Makalu Travels</a></li>
                    <li><a href="#">Sagarmatha Travels</a></li>
                    <li><a href="#">Nagarik Travels</a></li>
                    <li><a href="#">Himalayan Travels</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-12 place">
                <h4>Biratnagar to Kakadivitta</h4>
                <ul class="place1">
                    <li><a href="#">Makalu Travels</a></li>
                    <li><a href="#">Sagarmatha Travels</a></li>
                    <li><a href="#">Nagarik Travels</a></li>
                    <li><a href="#">Himalayan Travels</a></li>
                </ul>
            </div>
        </div>  --}}
    </div>
    {{-- <div class="second ">
        <div class="container bg-light" style="border: 2px solid black; margin-top: 31px; margin-bottom: 31px;">
            <div class="row" style="background-color: white;">
                <div class="col-md-12">
                    <img src="{{ asset('frontend/images/safety.png') }}" alt="" width="60" height="60" style="margin-top: 10px;">
                    <h3 class="safety+"
                        style="margin-left: 64px;margin-top: -64px; font-weight: bold; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:35px;">
                        Safety+</h3>
                    <p class="safety"
                        style="margin-left: 64px; margin-top: 10px;font-size: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; ">
                        Travel safe with us
                    </p>
                    <div class="row">
                        <div class="col-md-4">
                            <h5 style="color:#005B99; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                <b>Sanitized Bus</b>
                            </h5>
                            <p style="margin-top: 17px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                All
                                Safety+ buses are sanitized and disinfected before and after every
                                trip
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h5 style="color:#005B99; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                <b>Sanitized Bus</b>
                            </h5>
                            <p style="margin-top: 17px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                Proper
                                masks are mandatory for tall passengers and bus staff.</p>
                        </div>
                        <div class="col-md-4">
                            <h5 style="color:#005B99;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                <b>Sanitized
                                    Bus</b>
                            </h5>
                            <p style="margin-top: 17px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                All
                                passengers will undergo thermal screening.Temperature checks for
                                buses
                                drivers and service staff are doe before eery trip.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="services" style="background-color: #BBBBBB; padding-bottom: 40px;">
        <p
            style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #005B99; font-weight: bold; font-size: 22px; text-align: center; padding-top: 17px;">
            WE PROMISE TO DELIVER</p>
        <div class="container bg-light ">
            <div class="row">
                <div class="col-md-3 col-12 card" style="border: 1px solid gray;"><img src="{{ asset('frontend/images/safe.png') }}" alt="" width="80px"
                        height="80px" style="display: block; margin-left: auto; margin-right: auto; margin-top: 25px;">
                    <p class="safety"
                        style="text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 31px;">
                        Safety+</p>
                    <p>With Safety+ we have brought in a set of measures like sanitized buses.mandatory masks etc. to
                        ensure tou travel safely.</p>
                </div>
                <div class="col-md-3 col-6 card" style="border: 1px solid gray;"><img src="{{ asset('frontend/images/customer-support.png') }}" alt=""
                        width="80px" height="80px"
                        style="display: block; margin-left: auto; margin-right: auto; margin-top: 25px;">
                    <p class="support"
                        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-align: center;font-size: 31px;">
                        Support</p>
                    <p>We put our experience and relationship to goos use and are available to solve your travel issues.
                    </p>
                </div>
                <div class="col-md-3 col-6 card" style="border: 1px solid gray;"><img src="{{ asset('frontend/images/best-price.png') }}" alt=""
                        width="80px" height="80px"
                        style="display: block; margin-left: auto; margin-right: auto; margin-top: 25px;">
                    <p class="price"
                        style="font-size: 31px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;text-align: center;">
                        Lowest Price</p>
                    <p>We always give you the lowest price with the best partner offers.</p>
                </div>
                <div class="col-md-3 col-12 card" style="border: 1px solid gray;"><img src="{{ asset('frontend/images/chair.png') }}" alt="" width="80px"
                        height="80px" style="display: block; margin-left: auto; margin-right: auto; margin-top: 25px;">
                    <p class="chair"
                        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-size: 31px;text-align: center;">
                        Comfortable</p>
                    <p>We are keen to provide comfort to your travel.</p>
                </div>
            </div>
        </div>
    </div>

@endsection

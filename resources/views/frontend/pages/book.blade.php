@extends('frontend.layouts.hf')
@section('style')

    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
<style>
    .sn-row{
        display: flex;
    }
    .sn-col{
        height: 50px;
        width: 50px;
        text-align: center;
        padding-top: 10px;
        font-size: 16px;
        border: solid 2px black;
    }.sn-col[sn-count="0"]{
        background-color: rgb(255, 255, 255);
    }.sn-col[sn-count="1"]{
        /* background-color: rgb(61, 255, 61); */
        color:white;
        background-position: center;
        background-size: cover;
        background-image: url({{ asset('frontend/images/seat-open.png') }})
    }.sn-col[sn-count="2"]{
        /* background-color: rgb(255, 43, 43); */
        color:white;
        background-position: center;
        background-size: cover;
        background-image: url({{ asset('frontend/images/seat-packed.png') }})
    }.sn-col[sn-count="3"]{
        /* background-color: rgb(46, 46, 46); */
        color: rgb(7, 3, 3);
        background-position: center;
        background-size: cover;
        background-image: url({{ asset('frontend/images/seat-selected.png') }})
    }
</style>
@endsection
@section('content')

<div class="container">
    <div class="row BUS-SECOND-ROW">
        <div class="col-md-9 col-12">
            <div class="playing-padding-row">
                <div class="play-shodow-modify1">
                    <div class="row">

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="row row-form2">
                        <h4 style="text-align: center;padding:10px;">Payment Method</h4>
                        <br><hr>
                        <div class="col-md-12 col-12">
                            <div class="row">

                                @if ((Auth::user()->role == 'Admin') || Auth::user()->role == 'Superadmin')

                                    <div class="col-md-4 col-12 contet-coupen-code">
                                        <div class="input-contet-coupen">
                                            <span style="font-size:17px ;font-weight:700">Esewa</span>
                                            <a href="{{ route('book.pay.cash.custome') }}" class="btn apply-now-bottom" id="" >Apply </a>
                                        </div>
                                    </div>
                                @endif
                                @php
                                    $operators = $bus->operators()->where('users.id',Auth::user()->id)->first();
                                @endphp
                                @if ($operators)

                                    <div class="col-md-4 col-12 contet-coupen-code">
                                        <div class="input-contet-coupen">
                                            <span style="font-size:17px ;font-weight:700">Cash in hand</span>
                                            <a href="{{ route('book.pay.cash.custome') }}" class="btn apply-now-bottom" id="" >Apply </a>
                                        </div>
                                    </div>
                                @endif


                                {{-- <div class="col-md-4 col-12 contet-coupen-code">
                                    <div class="input-contet-coupen">
                                        <span style="font-size:17px ;font-weight:700">E-sewa</span>
                                        <input type="button" class="btn apply-now-bottom" id="esewa-pay-btn" value="Apply Now">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 contet-coupen-code">
                                    <div class="input-contet-coupen">
                                        <span style="font-size:17px ;font-weight:700">Khalty Pay</span>
                                        <input type="button" id="khalti-pay-btn" class="apply-now-bottom" value="Apply Now">
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-4 col-12 contet-coupen-code">
                                    <div class="input-contet-coupen">
                                        <span style="font-size:17px ;font-weight:700">Connect IPS Pay</span>
                                        <input type="button" id="connect-ips-btn" class="apply-now-bottom" value="Apply Now">
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-4 col-12 contet-coupen-code">
                                    <div class="input-contet-coupen">
                                        <span style="font-size:17px ;font-weight:700">eBanking</span>
                                        <input disabled type="submit" class="apply-now-bottom" value="Apply Now">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 contet-coupen-code">
                                    <div class="input-contet-coupen">
                                        <span style="font-size:17px ;font-weight:700">Mobile Banking</span>
                                        <input disabled type="submit" class="apply-now-bottom" value="Apply Now">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 contet-coupen-code">
                                    <div class="input-contet-coupen">
                                        <span style="font-size:17px ;font-weight:700">SCT Debit Cards</span>
                                        <input disabled type="submit" class="apply-now-bottom" value="Apply Now">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 contet-coupen-code">
                                    <div class="input-contet-coupen">
                                        <span style="font-size:17px ;font-weight:700">connectIPS</span>
                                        <input disabled type="submit" class="apply-now-bottom" value="Apply Now">
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div><hr>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="modify-color-white">
                <div class="row first-bus-row">

                    <div class="col-md-12 col-12 d-flex"><hr>
                        @php
                        $names = json_decode($bustype->seat_names, true);
                        $rows = $bustype->n_row;
                        $cols = $bustype->n_col;
                        $col_count = 0;
                    @endphp
                    <div class="my-4 mx-auto">
                        @for ($i = 1; $i <= $rows; $i++)
                            <div class="sn-row">
                                @for ($j = 1; $j <= $cols; $j++)
                                    @php
                                        $row_cols = explode('|',$bustype->map);
                                        $pp = 0;
                                        foreach($row_cols as $rc){
                                            $randc = explode(',',$rc);
                                            $rr = $randc[0];
                                            $cc = $randc[1];
                                            if(($i == $rr) && ($j == $cc)){
                                                $pp = $randc[2];
                                            }
                                        }
                                        $col_count += 1;
                                        $selected = false;
                                        foreach($selected_seats as $st){
                                            if($st == $col_count){
                                                $selected = true;
                                            }
                                        }


                                        $sn_name = '';
                                        if($names){
                                            if($pp == 1){
                                                if(isset($names[$col_count])){
                                                    $sn_name = $names[$col_count];
                                                }
                                            }
                                        }
                                    @endphp
                                    <div class="sn-col" sn-num="{{ $col_count }}" sn-rc="{{ $i . $j }}" sn-row="{{ $i }}" sn-col="{{ $j }}" sn-count="{{ $selected ? '3' : $pp }}">{{ $sn_name }}</div>
                                @endfor
                            </div>
                        @endfor
                    </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-12">
                        <h3 ><span style="font-size: 16px">Payment Time Left </span><span class="ml-3 countdown badge badge-info "></span></h3>
                    </div>
                </div><hr>
                <div class="row next-row-text">
                    <div class="col-md-6 col-12">
                        <span class="span-modify">Per Ticket Cost</span>
                        <span class="span-modify"></span>
                        <br>
                        <b style="margin-top: 5px;">Total Cost</b>
                    </div>
                    <div class="col-md-6 col-12">
                        <span class="span-modify">Rs {{ $bus->after_discount }}</span><br>
                        <input disabled type="hidden" value="{{ $bus->after_discount }}" id="per_prices">
                        <br>
                        <b style="margin-top: 5px;" id="total_div">Rs {{ $data['amount'] }}</b>
                    </div>
                </div>

                <a class="btn btn-danger btn-block" href="{{ route('book.cancel') }}" role="button">Cancel Booking</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        <?php
            $date = \carbon\Carbon::parse($data['inactive_time'])->addMinutes(10);
            $now = now();
            $value = $date->diffInSeconds($now);
            $dt = \carbon\Carbon::now();
            $days = $dt->diffInDays($dt->copy()->addSeconds($value));
            $hours = $dt->diffInHours($dt->copy()->addSeconds($value)->subDays($days));
            $minutes = $dt->diffInMinutes($dt->copy()->addSeconds($value)->subDays($days)->subHours($hours));
            $seconds = $dt->diffInSeconds($dt->copy()->addSeconds($value)->subDays($days)->subHours($hours)->subMinutes($minutes));

        ?>
        var timer2 = "{{ $minutes }}:{{ $seconds }}";
        var interval = setInterval(function() {

            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            if((minutes == 0) && (seconds == 0)){
                window.location.reload(true);
            }
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }, 1000);

    </script>
    <script src="{{ asset('frontend/js/payment.js') }}"></script>
    <script>
        var path="https://uat.esewa.com.np/epay/main";
        var params= {
            amt: {{ $data['amount'] }},
            psc: 0,
            pdc: 0,
            txAmt: 0,
            tAmt: {{ $data['amount'] }},
            pid: "{{ $data['booking_id'] }}",
            scd: "EPAYTEST",
            su: "{{ route('book.payment.esewa.response') }}",
            fu: "{{ route('book.payment.esewa.response') }}"
        }

        var btn = document.getElementById('esewa-pay-btn');
        btn.onclick = function(){
            var response = esewa_pay(path, params);
        }
    </script>
    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
            "productIdentity": "{{ $data['booking_id'] }}",
            "productName": "Seat Booking",
            "productUrl": "{{ route('homepage') }}",
            "paymentPreference": [
                    "KHALTI",
                    "EBANKING",
                    "MOBILE_BANKING",
                    "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    console.log(payload);
                    $.ajax({
                        method: 'get',
                        url: "{{ route('book.pay.seat','khalti') }}",
                        data: {
                            amount: payload.amount,
                            token: payload.token,
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(response){
                            if(response.status == true){
                                window.location.replace("{{ route('book.finished') }}");
                            }
                        }
                    });
                },
                onError (error) {
                    console.log(error);
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("khalti-pay-btn");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: {{ $data['amount'] * 100 }} });
        }
    </script>
    {{-- <script>
        var config_ips = {
            // replace the publicKey with yours
            "publicKey": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
            "productIdentity": "{{ $data['booking_id'] }}",
            "productName": "Seat Booking",
            "productUrl": "{{ route('homepage') }}",
            "paymentPreference": [
                    "CONNECT_IPS",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    console.log(payload);
                    $.ajax({
                        method: 'get',
                        url: "{{ route('book.pay.seat','connectIPS') }}",
                        data: {
                            amount: payload.amount,
                            token: payload.token,
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(response){
                            if(response.status == true){
                                window.location.replace("{{ route('book.finished') }}");
                            }
                        }
                    });
                },
                onError (error) {
                    console.log(error);
                }
            }
        };

        var checkoutsec = new KhaltiCheckout(config_ips);
        var btn = document.getElementById("connect-ips-btn");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkoutsec.show({amount: {{ $data['amount'] * 100 }} });
        }
    </script> --}}
@endsection

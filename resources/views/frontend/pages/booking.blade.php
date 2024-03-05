@extends('frontend.layouts.hf')
@section('style')
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
    .rating-header {
        margin-top: -10px;
        margin-bottom: 10px;
    }


</style>
@endsection
@section('content')

<div class="container">
    <form action="{{ route('booking.store',$bus->id) }}" id="" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="d-none" type="date" name="date" id=""
        <?php
            if(isset($_GET['date'])){
                echo 'value="'.\carbon\Carbon::createFromFormat('d/m/Y',$_GET['date'])->format('Y-m-d').'"';
            }
        ?>
        >
    {{--  <div class="row BUS-SECOND-ROW py-4 bg-light">

    </div>  --}}
    <div class="row BUS-SECOND-ROW">
        <div class="col-md-4 col-12">
            <div class="modify-color-white">
                <div class="row first-bus-row">

                    <div class="col-md-12 col-12">
                        <div class="book-bottom">
                            <input type="button" class="bottom-book" value="SELECT SEAT" style="width: 100%">
                        </div><hr>
                        <div class="book-bottom">
                            <div class="row">
                                <div class="col-md-4 col-4"><img src="{{ asset('frontend/images/seat-open.png') }}" alt="" srcset=""></div>
                                <div class="col-md-8 col-8"><input type="button" class="bottom-book" value="Available" style="width: 100%;border: 2px solid #ccbdbd;background-color: #055a4e;"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4"><img src="{{ asset('frontend/images/seat-selected.png') }}" alt="" srcset=""></div>
                                <div class="col-md-8 col-8"><input type="button" class="bottom-book" value="Selected" style="width: 100%;border: 2px solid #ccbdbd;background-color: #055a4e;"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4"><img src="{{ asset('frontend/images/seat-packed.png') }}" alt="" srcset=""></div>
                                <div class="col-md-8 col-8"><input type="button" class="bottom-book" value="Not-Avillable"  style="width: 100%;border: 2px solid #ccbdbd;background-color: #055a4e;"></div>
                            </div>
                        </div><hr>
                        @php
                        $names = json_decode($bustype->seat_names, true);
                        $rows = $bustype->n_row;
                        $cols = $bustype->n_col;
                        $col_count = 0;
                    @endphp
                    <div class="my-4">
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
                                    <div class="sn-col" sn-num="{{ $col_count }}" sn-disable="{{ $selected ? '1' : ( $pp == 2 ? '1' : ($pp == 0 ? '1' : '0')) }}" sn-rc="{{ $i . $j }}" sn-row="{{ $i }}" sn-col="{{ $j }}" sn-count="{{ $selected ? '2' : $pp }}">{{ $sn_name }}</div>
                                @endfor
                            </div>
                        @endfor
                        <select name="map[]" style="display: none" id="sn-row-col" multiple></select>
                    </div>
                    </div>
                </div>
                <div class="row first-bus-row">
                    <br>
                    <!-- this is div for the bottom of the booking -->
                    <div class="book-bottom">
                        <input type="button" class="bottom-book" value="Ticket Price" style="width: 100%">
                    </div>
                    <p></p>
                </div>
                <div class="row next-row-text">
                    <div class="col-md-6 col-12">
                        <span class="span-modify">Per Ticket Cost</span>
                        <span class="span-modify"></span>
                        <br>
                        <b style="margin-top: 5px;">Total Cost</b>
                    </div>
                    <div class="col-md-6 col-12">
                        <span class="span-modify">Rs {{ $bus->after_discount }}</span><br>
                        <input type="hidden" value="{{ $bus->after_discount }}" id="per_prices">
                        <br>
                        <b style="margin-top: 5px;" id="total_div">Rs 0</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <div class="playing-padding-row">
                <div class="play-shodow-modify1">
                    <div class="row row-form">
                        <h4 style="text-align: center;padding:10px;">PASSENGER DETAILS</h4>
                        <br><hr>
                        @if($errors->any())
                            @foreach ($errors->all() as $message)
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endforeach
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('status') }}</strong>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        @endif

                        @auth

                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Name of Passenger <span class="text-danger">*</span> </b style="padding-left:5px;"></span>
                                    <input type="text" name="pname" value="{{ Auth::user()->name }}" class="design-input-tag" placeholder="Name" style="width: 100%">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Email of Passenger </b style="padding-left:5px;"></span>
                                    <input type="text" name="pemail" value="{{ Auth::user()->email }}" class="design-input-tag" placeholder="Email" style="width: 100%">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Mobile Number of Passenger <span class="text-danger">*</span> </b style="padding-left:5px;"></span>
                                    <input type="text" name="pphone" value="{{ Auth::user()->phone }}" class="design-input-tag" placeholder="Phone" style="width: 100%">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Address </b style="padding-left:5px;"></span>
                                    <input type="text" name="address" class="design-input-tag" placeholder="Address" style="width: 100%">
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="for-gender">
                                <span><b style="color:blueviolet; display: inline-block;">Gender <span class="text-danger">*</span> </b style="padding-left:5px;"></span>
                                </div><div class="radio-modify-div">
                                    <select name="pgender" id="pgenders" class="form-control design-input-tag1" style="height: auto">
                                        <option selected value="">---select---</option>
                                            <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female"  {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Age </b style="padding-left:5px;"></span><br>
                                    <input type="page" name="page" class="design-input-tag1" placeholder="Age">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Remark</b style="padding-left:5px;"></span><br>
                                    <input type="text" name="remark" class="design-input-tag" placeholder="Remark">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Boarding Point <span class="text-danger">*</span> </b style="padding-left:5px;"></span><br>
                                    <input type="text" name="boarding_point" class="design-input-tag" placeholder="Boarding Point">
                                </div>
                            </div>
                        @else

                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Name of Passenger <span class="text-danger">*</span> </b style="padding-left:5px;"></span>
                                    <input type="text" name="pname" class="design-input-tag" placeholder="Name" style="width: 100%">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Email of Passenger</b style="padding-left:5px;"></span>
                                    <input type="text" name="pemail" class="design-input-tag" placeholder="Email" style="width: 100%">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Mobile Number of Passenger <span class="text-danger">*</span> </b style="padding-left:5px;"></span>
                                    <input type="text" name="pphone" class="design-input-tag" placeholder="Email" style="width: 100%">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Address</b style="padding-left:5px;"></span>
                                    <input type="text" name="address" class="design-input-tag" placeholder="Address" style="width: 100%">
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="for-gender">
                                <span><b style="color:blueviolet; display: inline-block;">Gender <span class="text-danger">*</span> </b style="padding-left:5px;"></span>
                                </div><div class="radio-modify-div">
                                    <select name="pgender" id="pgenders" class="form-control design-input-tag1" style="height: auto">
                                        <option selected value="">---select---</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Age</b style="padding-left:5px;"></span><br>
                                        <input type="page" name="page" class="design-input-tag1" placeholder="Age">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Boarding Point <span class="text-danger">*</span> </b style="padding-left:5px;"></span><br>
                                    <input type="text" name="boarding_point" class="design-input-tag" placeholder="Boarding Point">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="design-input-tag-div">
                                    <span><b style="color:blueviolet; display: inline-block;">Remark</b style="padding-left:5px;"></span><br>
                                    <input type="text" name="remark" class="design-input-tag" placeholder="Remark">
                                </div>
                            </div>
                        @endauth
                    </div><hr>
                    <div class="row row-form2 pt-4">
                        <input type="submit" class="apply-now-bottom" id="continue-booking" value="CONTINUE BOOKING FOR (@isset($_GET['date']) {{ $_GET['date'] }} @endisset)" style="border-radius: 0;color:white;background-color:#1C6DD0;border:none">
                        <a href="{{ route('homepage') }}" class="btn apply-now-bottom" style="border-radius: 0;color:white;background-color:#828283;border:none;text-align:center;">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@auth

    <div class="row row-form2 bg-light py-3 px-2 mt-3">
        <h4 style="text-align: center;padding:10px;">Ratings</h4>
        <div class="col-md-12 col-12">
            <div class="row">
                <form action="{{ route('book.review',['id'=>$bus->id]) }}" method="post">
                    @csrf

                    @error('rating')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    @error('review')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="form-group" id="rating-ability-wrapper">
                        <label class="control-label" for="rating">
                        <span class="field-label-info"></span>
                        <input type="hidden" id="selected_rating" name="rating" value="" required="required">
                        </label>
                        <h2 class="bold rating-header" style="">
                        <span class="selected-rating">0</span><small> / 5</small>
                        </h2>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="1" id="rating-star-1">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                    </div>
                    <textarea name="review" id="comment" class="form-control my-2" placeholder="Write a review..."></textarea>
                    <button type="submit" class="btn btn-dark ">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
@endauth
</div>
@endsection

@section('scripts')
    <script>
        $('#continue-booking').click(function (e) {
            // e.preventDefault();
            $('.sn-col').attr('sn-disable', 1);
        });
    </script>
    <script>
        $('.sn-col').click(function(){
            var count = $(this).attr('sn-count');
            var num = $(this).attr('sn-num');
            var row = $(this).attr('sn-row');
            var col = $(this).attr('sn-col');
            var is_disabled = $(this).attr('sn-disable');
            var r_c_d = row + ',' + col;
            if(is_disabled == '0'){

                if(count == 1){
                    var row_col = row + ',' + col + ',3';
                    $(this).attr('sn-count', '3');
                }
                if(count == 3){
                    var row_col = row + ',' + col + ',1';
                    $(this).attr('sn-count', '1');
                }
                var opt_output = '<option value="'+ num +'" selected sninfo="' + r_c_d +'">'+ num +'</option>'
                if($('#sn-row-col option[sninfo="'+ r_c_d +'"]').length){
                    $('#sn-row-col option[sninfo="'+ r_c_d +'"]').attr('value',row_col);
                }else{
                    $('#sn-row-col').append(opt_output);
                }
            }
            var per_price = parseFloat($('#per_prices').val());
            calculateTotal(per_price);

        });

        function calculateTotal(per = 0){
            var total_price = 0;
            $('.sn-col').each(function () {
                var count = $(this).attr('sn-count');
                 if(count == 3){
                    total_price += per;
                 }
            });
            $('#total_div').empty();
            $('#total_div').append('Rs. ' + total_price.toFixed(2));
        }
    </script>
    <script>
        jQuery(document).ready(function($){

            $(".btnrating").on('click',(function(e) {

            var previous_value = $("#selected_rating").val();

            var selected_value = $(this).attr("data-attr");
            $("#selected_rating").val(selected_value);

            $(".selected-rating").empty();
            $(".selected-rating").html(selected_value);

            for (i = 1; i <= selected_value; ++i) {
            $("#rating-star-"+i).toggleClass('btn-warning');
            $("#rating-star-"+i).toggleClass('btn-default');
            }

            for (ix = 1; ix <= previous_value; ++ix) {
            $("#rating-star-"+ix).toggleClass('btn-warning');
            $("#rating-star-"+ix).toggleClass('btn-default');
            }

            }));


        });

    </script>
@endsection

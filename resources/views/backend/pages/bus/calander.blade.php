@extends('backend.layout.master')
@section('title', 'Add User')
@section('style')
    <style>
        .sn-cal-day.sn-active{
            background-color: black !important;
        }
        .sn-cal-day{
            border: solid 1px black;
            padding: 10px 10px;
            text-align: center;
            border-radius: 5px;
            color: #ebebeb;
            width: 55px;
            height: 45px;
        }
        .sn-cal-day-name{
            border: solid 1px black;
            padding: 10px 10px;
            text-align: center;
            border-radius: 5px;
            color: #ebebeb;
            width: 55px;
            height: 45px;
        }
        .sn-cal-top{
            padding: 10px 0px;
        }
        .sn-cal-body .row .col:last-child .sn-cal-day{
            background-color: rgb(151, 56, 56);
        }
        .sn-cal-head .col:last-child .sn-cal-day-name{
            background-color: rgb(151, 56, 56);
        }
        .sn-cal-head{
            border-bottom: 2px solid black;
            padding-bottom: 3px;
            margin-bottom: 3px !important;
            background-color: rgb(71, 71, 71)
        }
        .sn-cal-container{
            padding: 5px;
            background-color: rgb(46, 46, 46);
            border-radius: 5px;
            overflow-x: scroll;
            max-width: 440px;
        }
        .sn-cal-container .row{
            margin: 0;
            flex-wrap: nowrap;
        }
        .sn-cal-container .col{
            padding: 2px !important;
        }
        .cn_date{
            display: none;
        }
        .carousel-control-prev, .carousel-control-next{
            background-color: black;
            display: flex;
        }
        .next-prev_c{
            position: absolute;
            top: -60px;
            height: 60px;
            width: 100%;
            display: flex;
        }
    </style>
@endsection
@section('main-content')

<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                <h3 class="card-header">Bus Details</h3>
                @error('name')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $bus }}</strong>
                </div>
                @enderror
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $bus }}</strong>
                    </div>
                @enderror
                @error('phone')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $bus }}</strong>
                    </div>
                @enderror
                @error('password')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $bus }}</strong>
                </div>
                @enderror
                @error('role')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $bus }}</strong>
                </div>
                @enderror
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="from">From</label>
                                <input type="date"
                                    @isset($from)
                                        value="{{ $from->format('Y-m-d') }}"
                                    @endisset
                                class="form-control" name="from"  id="from">
                            </div>
                            <label for="to">To</label>
                            <input type="date"
                                @isset($to)
                                    value="{{ $to->format('Y-m-d') }}"
                                @endisset
                            class="form-control" name="to"  id="to">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="card-body">
                    <form action="{{ route('bus.store') }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf











                        @isset($dates)

                            <div id="calander_slide" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" style="margin-top: 60px" role="listbox">


                                    @foreach ($dates as $key=>$dateOne)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="form-group sn-cal-container mx-auto ">

                                                <?php
                                                    $dateOne = \carbon\Carbon::parse($dateOne);
                                                    $snCal = new App\Http\Controllers\CalanderOperations();
                                                    $dates_this_month = $snCal->get_calander($dateOne->format('Y-m-d'));
                                                    $j = 1;
                                                    $i = 1;
                                                ?>

                                                <div class="row sn-cal-top">
                                                    <div class="col">
                                                        <p>{{ $dateOne->format('F - Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="row sn-cal-head">
                                                    <div class="col"><div class="sn-cal-day-name">Sun</div></div>
                                                    <div class="col"><div class="sn-cal-day-name">Mon</div></div>
                                                    <div class="col"><div class="sn-cal-day-name">Tue</div></div>
                                                    <div class="col"><div class="sn-cal-day-name">Wed</div></div>
                                                    <div class="col"><div class="sn-cal-day-name">Thu</div></div>
                                                    <div class="col"><div class="sn-cal-day-name">Fri</div></div>
                                                    <div class="col"><div class="sn-cal-day-name">Sat</div></div>
                                                </div>
                                                <div class="sn-cal-body">
                                                    @if(count($dates_this_month) > 0)
                                                        @foreach ($dates_this_month as $kesy=>$weeks)
                                                            <div class="row ">
                                                                @foreach ($weeks as $d=>$day)
                                                                    @if($day)
                                                                        <?php
                                                                            $s_active = false;
                                                                            $shadule = new App\Http\Controllers\BusShaduleController();
                                                                            $dates = $shadule->getDates($bus->id, $day);
                                                                            if($dates){
                                                                                $s_active = true;
                                                                            }
                                                                        ?>
                                                                    @endif
                                                                    <div class="col"><div id="sn-cal-day-{{ $key . $kesy . $d }}" class="sn-cal-day {{ $day ? ($s_active ? 'sn-active' : '') : '' }}" data-id="{{ $day ? ($s_active ? $dates->id : '') : '' }}" val="{{ $day ? \carbon\Carbon::parse($day)->format('Y-m-d') : '' }}">  {{ $day ? \carbon\Carbon::parse($day)->format('d') : '' }}</div></div>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="row ">
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                            <div class="col"><div class="sn-cal-day"></div></div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                    @endforeach
                                </div>
                                <div class="next-prev_c">

                                    <a class="carousel-control-prev" href="#calander_slide" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#calander_slide" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>


                        @endisset


                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-center">
                                    <a href="{{ url('/admin/bus') }}" class="btn btn-space btn-danger"> Back </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
@section('scripts')
    <script>
        $('.sn-cal-day').click(function(){
            var bus = {{ $bus->id }};
            var v_l = $(this).attr('val');
            var data_id = $(this).attr('data-id');
            var t_id = $(this).attr('id');
            if($(this).hasClass('sn-active')){
                if(data_id){
                    $.ajax({
                        method: 'get',
                        url: '{{ route('bus.calander.remove') }}',
                        data: {
                            bus: bus,
                            data_id: data_id,
                            date: v_l,
                        },
                        success: function(response){
                            if(response.status){
                                $('#'+t_id).removeClass('sn-active');
                                if(v_l){
                                    $('#'+t_id).children('.cn_date').remove();
                                }
                            }
                        }
                    });
                }
            }else{
                if(!data_id){
                    $.ajax({
                        method: 'get',
                        url: '{{ route('bus.calander.add') }}',
                        data: {
                            bus: bus,
                            date: v_l,
                        },
                        success: function(response){
                            if(response.status){
                                $('#'+t_id).attr('data-id',response.id);
                                $('#'+t_id).addClass('sn-active');
                                if(v_l){
                                    var cn_inp = '<input type="text" class="cn_date" name="dates[]" value="'+ v_l +'">';
                                    $('#'+t_id).append(cn_inp);
                                }
                            }
                        }
                    });
                }
            }

        });
        $('#calander_slide').carousel({
            interval: false,
          });
    </script>
@endsection

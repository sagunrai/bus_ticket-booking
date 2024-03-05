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
                    <form action="{{ route('bus.update',$edit->id) }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="catname">Bus Name</label>
                            <input type="text" name="name" value="{{ $edit->name }}" class="form-control" id="catname12" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="catname">Amneties (Seperate with ',')</label>
                            <input type="text" name="amneties" class="form-control" id="catname12" value="{{ $edit->amneties }}" placeholder="Amneties (seperate with ',')">
                        </div>
                        <div class="form-group">
                            <label for="catname">Booking Policy</label>
                            <textarea type="text" name="booking_policy" class="form-control" id="catname12" placeholder="Booking Policy">{{ $edit->booking_policy }}</textarea>
                        </div>

                        {{-- <div class="form-group">
                            <label for="catname">Bus Number</label>
                            <input type="text" name="bus_number" value="{{ $edit->bus_no }}" class="form-control" id="catname12" placeholder="">
                        </div> --}}
                        <div class="form-group">
                            <label for="catname">Bus Image</label>
                            <input type="file" name="image" class="form-control" id="catname12" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="users">Operators</label>
                            <select name="operators[]" id="" multiple class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $edit->operators()->where('users.id',$user->id)->first() ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catname">Bus Route</label>
                            <select name="busroute" id="busroute" class="form-control">
                                <option value="">---select---</option>
                                @foreach ($busroute as $busrots)
                                    <option value="{{ $busrots->id }}" {{ $edit->busroute == $busrots->id ? 'selected' : '' }}>{{ $busrots->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bustype">Bus Type</label>
                            <select name="bustype" id="bustype" class="form-control">
                                <option value="">---select---</option>
                                @foreach ($bustype as $bustypes)
                                    <option value="{{ $bustypes->id }}" {{ $edit->bustype == $bustypes->id ? 'selected' : '' }}>{{ $bustypes->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catname">Per Sit Price(NRP):</label>
                            <input type="number" step="0.01" name="persitprice" value="{{ $edit->persitprice }}" class="form-control" id="catname12" placeholder="NRP.">
                        </div>
                        <div class="form-group">
                            <label for="catname">Discount(%):</label>
                            <input type="number" step="0.01" name="discount"  value="{{ $edit->discount }}" class="form-control" id="catname12" placeholder="Discount">
                        </div>
                        <div class="form-group">
                            <label for="catname">Departure Time:</label>
                            <input type="time" name="departuretime" class="form-control"  value="{{ $edit->departuretime }}" id="catname12" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="catname">Arrival Time:</label>
                            <input type="time" name="arrivaltime" class="form-control"  value="{{ $edit->arrivaltime }}" id="catname12" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="booking_closing_time">Booking close Time:</label>
                            <input type="time" name="booking_closing_time" class="form-control" value="{{ $edit->booking_closing_time }}" id="booking_closing_time" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="status">Status</label>
                          <select class="form-control" name="status" id="status">
                            <option value="active" {{ $edit->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $edit->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                          </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-center">
                                    <button type="submit" name="submit" class="btn btn-space btn-primary">Add</button>
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
            var v_l = $(this).attr('val');
                console.log('here');
            if($(this).hasClass('sn-active')){
                $(this).removeClass('sn-active');
                if(v_l){
                    $(this).children('.cn_date').remove();
                }
            }else{
                $(this).addClass('sn-active');
                if(v_l){
                    var cn_inp = '<input type="text" class="cn_date" name="dates[]" value="'+ v_l +'">';
                    $(this).append(cn_inp);
                }
            }

        });
    </script>
@endsection

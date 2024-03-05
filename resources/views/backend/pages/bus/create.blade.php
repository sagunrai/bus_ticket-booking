@extends('backend.layout.master')
@section('title', 'Add User')
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
                    <form action="{{ route('bus.store') }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="catname">Bus Name</label>
                            <input type="text" name="name" class="form-control" id="catname12" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="catname">Bus Number</label>
                            <input type="text" name="bus_number" class="form-control" id="catname12" placeholder="Bus Number">
                        </div>
                        <div class="form-group">
                            <label for="catname">Amneties (Seperate with ',')</label>
                            <input type="text" name="amneties" class="form-control" id="catname12" placeholder="Amneties (seperate with ',')">
                        </div>
                        <div class="form-group">
                            <label for="catname">Booking Policy</label>
                            <textarea type="text" name="booking_policy" class="form-control" id="catname12" placeholder="Booking Policy"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="catname">Bus Image</label>
                            <input type="file" name="image" class="form-control" id="catname12" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="users">Operators</label>
                            <select name="operators[]" multiple id="" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catname">Bus Route</label>
                            <select name="busroute" id="busroute" class="form-control">
                                <option value="">---select---</option>
                                @foreach ($busroute as $busrots)
                                    <option value="{{ $busrots->id }}">{{ $busrots->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bustype">Bus Type</label>
                            <select name="bustype" id="bustype" class="form-control">
                                <option value="">---select---</option>
                                @foreach ($bustype as $bustypes)
                                    <option value="{{ $bustypes->id }}">{{ $bustypes->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catname">Per Sit Price(NRP):</label>
                            <input type="number" step="0.01" name="persitprice" value="0.00" class="form-control" id="catname12" placeholder="NRP.">
                        </div>
                        <div class="form-group">
                            <label for="catname">Discount(%):</label>
                            <input type="number" step="0.01" name="discount" value="0.00" class="form-control" id="catname12" placeholder="Discount">
                        </div>
                        <div class="form-group">
                            <label for="catname">Departure Time:</label>
                            <input type="time" name="departuretime" class="form-control" id="catname12" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="catname">Arrival Time:</label>
                            <input type="time" name="arrivaltime" class="form-control" id="catname12" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="booking_closing_time">Booking close Time:</label>
                            <input type="time" name="booking_closing_time" class="form-control" id="booking_closing_time" placeholder="">
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

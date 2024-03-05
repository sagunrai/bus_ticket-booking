@extends('backend.layout.master')

@section('title', 'bus')
<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      outline: none;
    }
    html,
    body {
      background-color: #fafafa;
    }
    .box-surface {
      margin: 20px 0;
      box-shadow: 0 2px 4px 0 rgb(0 0 0/25%);
      background-color: white;
    }
    .row-padding {
      padding: 20px;
      padding-top:7px !important;
    }
    .pos-center {
      position: relative;
      padding: 40px 0;
    }
    .nisha-wrap input{
      width: 100%;
      padding: 0 15px;
      height: 50px;
      background: #fff;
      border: 1px solid #e5e5e5;
      color: black;
      font-size: 14px;
      line-height: 42px;
      box-shadow: 0 0px 4px 0 rgb(0 0 0 / 15%);
    }
</style>

@section('main-content')

<div class="container">
    @error('name')
    <div class="alert alert-danger" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
    @error('email')
    <div class="alert alert-danger" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
    @error('image')
    <div class="alert alert-danger" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror

    <div class="box-surface">
      <div class="row row-padding">
        <div class="col-md-12 col-12 text-center pos-center p-0 bg-primary">
            <h3 class="pt-3" style="color: white">{{ $bus->name }}</h3>
        </div>
        <div class="col-md-6 col-12 text-center pos-center p-0">
          <img src="{{ 'http://127.0.0.1:8000/'.$bus->image }}" height="auto" width="100%">
          @if ($gallery)
              <?php foreach (json_decode($gallery->filename)as $picture) { ?>
                <img src="{{ asset('/frontend/images/gallery/'.$picture) }}" style="height:auto; width:25%"/>
               <?php } ?>
          @endif

        </div>
        <div class="col-md-6 col-12">
            {{--  <form action="" method="POST" enctype="multipart/form-data">  --}}
                {{--  <form action="{{ route('bus.update',$bus->id) }}" method="POST" enctype="multipart/form-data">  --}}
            {{--  @csrf  --}}
              <div class="row p-2">
                <div row="col-md-12 mx-auto" style="width: 100%;">
                  <div class="form-group nisha-wrap">
                    <label for="catname">Bus Name</label>
                    <input type="text" disabled class="form-control" name="name" value="{{ $bus->name }}">
                  </div>
                </div>
                <div row="col-md-12 mx-auto" style="width: 100%;">
                    <div class="form-group nisha-wrap">
                        <label for="catname">Bus Route</label>
                        <select name="busroute" disabled id="busroute" class="form-control">
                            <option value="{{ $bus->busroutename->id }}">{{ $bus->busroutename->name }}</option>
                            @foreach ($busroute as $busrots)
                                <option value="{{ $busrots->id }}">{{ $busrots->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div row="col-md-12 mx-auto" style="width: 100%;">
                    <div class="form-group nisha-wrap">
                        <label for="bustype">Bus Type</label>
                        <select name="bustype" disabled id="bustype" class="form-control">
                            <option value="{{ $bus->bustypename->id }}">{{ $bus->bustypename->name }}</option>
                            @foreach ($bustype as $bustypes)
                                <option value="{{ $bustypes->id }}">{{ $bustypes->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div row="col-md-12 mx-auto" style="width: 100%;">
                    <div class="form-group nisha-wrap">
                        <label for="catname">Per Sit Price(NRP):</label>
                      <input type="number" disabled class="form-control" name="persitprice" value="{!! $bus->persitprice !!}">
                    </div>
                  </div>
                  <div row="col-md-12 mx-auto" style="width: 100%;">
                      <div class="form-group nisha-wrap">
                        <label for="catname">Discount(%): Per Sit Price(NRP)</label>
                          <input type="number" disabled class="form-control" name="persitpricedisper" value="{!! $bus->persitpricedisper !!}">
                      </div>
                  </div>
                  <div row="col-md-12 mx-auto" style="width: 100%;">
                      <div class="form-group nisha-wrap">
                        <label for="catname">Departure Time:</label>
                          <input type="time" disabled class="form-control" name="departuretime" value="{!! $bus->departuretime !!}">
                      </div>
                  </div>
                  <div row="col-md-12 mx-auto" style="width: 100%;">
                      <div class="form-group nisha-wrap">
                        <label for="catname">Arrival Time:</label>
                          <input type="time" disabled class="form-control" name="arrivaltime" value="{!! $bus->arrivaltime !!}">
                      </div>
                  </div>
                  {{--  <div row="col-md-12 mx-auto" style="width: 100%;">
                      <div class="form-group nisha-wrap">
                        <label for="catname">Bus Image</label>
                          <input type="file" disabled class="form-control" name="image" value="{!! $bus->arrivaltime !!}">
                      </div>
                  </div>  --}}

                  <div row="col-md-12 mx-auto" style="width: 100%;">
                      <div class="form-group nisha-wrap">
                          <label for="bustype">Status</label>
                          <select name="status" disabled id="status" class="form-control">
                              <option value="{!! $bus->status !!}">{!! $bus->status !!}</option>
                                  <option value="active">Active</option>
                                  <option value="inactive">Inactive</option>
                          </select>
                      </div>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

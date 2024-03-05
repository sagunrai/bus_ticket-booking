@extends('backend.layout.master')
@section('title', 'bus')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> All - Bus  </h5>
                    <a href="{{ url('admin/bus/add') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User">Add bus</a>
                </div>
                @if (request()->segment(3) == 'active')

                    <form action="" class="row mx-0" method="get">

                        <div class="form-group col-md-4">
                            <label for="day">Select Day</label>
                            <input name="day" class="form-control" id="day"
                            <?php
                                if(isset($_GET['day'])){
                                    echo 'value="'.$_GET['day'].'"';
                                }else{
                                    echo 'value="'.now()->format('Y-m-d').'"';
                                }
                            ?>
                            type="date">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-info btn-sm ">Search</button>
                        </div>
                    </form>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th> Action </th>
                                    <th> Details </th>
                                    <th> Image </th>
                                    <th> Name </th>
                                    <th> Busroute </th>
                                    <th> Per Sit Price(NRP.) </th>
                                    <th> Departuretime </th>
                                    <th> Arrivaltime </th>
                                    <th> bustype </th>
                                    <th> Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($bus)
                                @foreach ($bus as $user)
                                <tr>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('bus.edit', $user->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit">
                                                <i class="fa fa-edit" style="color: white"></i>
                                            </a>
                                            <a href="{{ route('admin.bus.calander', $user->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Calander">
                                                <i class="fa fa-calendar" style="color: white;" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin.bus.boadingpoints', $user->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Boading Points">
                                                <i class="fa fa-map-marker" style="color: white;" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('bus.delet', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times" style="color: white"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('admin.bus.details', $user->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit">
                                                <i class="fas fa-eye" style="color: white"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td><img src="{{ 'http://127.0.0.1:8000/'.$user->image }}" alt="Book Image" width="60px"></td>
                                    <td> {!! $user->name !!} </td>
                                    <td> {!! $user->busroutename ? $user->busroutename->name : '' !!} </td>
                                    <td> {!! $user->persitprice !!} </td>
                                    <td> {!! $user->departuretime !!} </td>
                                    <td> {!! $user->arrivaltime !!} </td>
                                    <td> {{ $user->bustypename ? $user->bustypename->name : '' }} </td>
                                    <td> {{ $user->status }} </td>
                                </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

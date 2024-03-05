@extends('backend.layout.master')
@section('title', 'Gallery')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> gallery </h5>
                    <a href="{{ url('/admin/gallery/add')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add gallery</a>
                </div>
                <div class="card-body">
                    <div>
                        <form action="" class="row py-5" method="get">
                            <div class="form-group col-md-6 ml-auto">
                              <label for="route">Routes</label>
                              <select class="form-control" name="route" id="route">
                                <option value="">--Select Route--</option>
                                @isset($routes)
                                    @foreach ($routes as $route)
                                        <option value="{{ $route->id }}"
                                            <?php
                                                if(isset($_GET['route'])){
                                                    echo $_GET['route'] == $route->id ? 'selected' : '';
                                                }
                                            ?>
                                            >{{ $route->name }}</option>
                                    @endforeach

                                @endisset
                              </select>
                            </div>
                            <div class="col-md-3 mr-auto pt-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>

                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    {{-- <th> ID </th> --}}
                                    <th> Bus  Name</th>
                                    <th> Bus Images </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($gallery)
                                    @foreach ($gallery as $user)
                                    <tr>
                                        <td> {{ $user->busname ? $user->busname->name : '' }} </td>
                                        <td>
                                            <?php foreach (json_decode($user->filename)as $picture) { ?>
                                                <img src="{{ asset('/frontend/images/gallery/'.$picture) }}" style="height:120px; width:200px"/>
                                        <?php } ?>
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('gallery.delet', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times" style="color: white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>

                        @isset($gallery)
                            {{ $gallery->links() }}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

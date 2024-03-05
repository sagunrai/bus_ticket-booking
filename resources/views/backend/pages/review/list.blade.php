@extends('backend.layout.master')
@section('title', 'Gallery')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> Reviews </h5>
                </div>
                <div class="card-body">
                    <div>
                        <form action="" class="row py-5" method="get">
                            <div class="form-group col-md-6 ml-auto">
                              <label for="bus">Busses</label>
                              <select class="form-control" name="bus" id="bus">
                                <option value="">--Select bus--</option>
                                @isset($buses)
                                    @foreach ($buses as $bus)
                                        <option value="{{ $bus->id }}"
                                            <?php
                                                if(isset($_GET['bus'])){
                                                    echo $_GET['bus'] == $bus->id ? 'selected' : '';
                                                }
                                            ?>
                                            >{{ $bus->name }}</option>
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
                                    <th>Rating</th>
                                    <th> Review </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($ratings)
                                    @foreach ($ratings as $user)
                                    <tr>
                                        <td> {{ $user->busname ? $user->busname->name : '' }} </td>
                                        <td> {{ $user->rating }} Star </td>
                                        <td> {{ $user->review }} </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('review.delet', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times" style="color: white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>

                        @isset($ratings)
                            {{ $ratings->links() }}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

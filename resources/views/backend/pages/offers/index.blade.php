@extends('backend.layout.master')
@section('title', 'Offers Management')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> Offers Management </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.offers.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image" aria-describedby="helpId" >
                        </div>
                        <div class="form-group">
                            <label for="text">short Desc</label>
                            <textarea class="form-control" name="text" id="text" aria-describedby="helpId" placeholder="Short Description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </form>
                    <div class="table-responsive mt-4">
                        <div class="card-header">
                            <h5 class="mb-0 p-2"> Offers Table </h5>
                        </div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <td>SN</td>
                                    <td>Image</td>
                                    <td>Short Desc</td>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($offers as $offer)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ asset($offer->image) }}" width="60px"></td>
                                        <td>{{ $offer->text }}</td>
                                        <td>
                                            <a href="{{ route('admin.offers.delete', $offer->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

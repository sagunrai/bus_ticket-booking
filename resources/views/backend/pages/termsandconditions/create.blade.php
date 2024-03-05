@extends('backend.layout.master')
@section('title', 'Add Termcondion')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                <h3 class="card-header">termsandconditions</h3>
                @error('name')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $termsandconditions }}</strong>
                </div>
                @enderror
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $termsandconditions }}</strong>
                    </div>
                @enderror
                @error('phone')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $termsandconditions }}</strong>
                    </div>
                @enderror
                @error('password')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $termsandconditions }}</strong>
                </div>
                @enderror
                @error('role')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $termsandconditions }}</strong>
                </div>
                @enderror
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('termsandconditions.store') }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="catname"></label>
                            <textarea  type="text" name="termsandconditions" class="form-control" id="summernote" placeholder="post_content"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-center">
                                    <button type="submit" name="submit" class="btn btn-space btn-primary">Add</button>
                                    <a href="{{ url('/admin/termsandconditions') }}" class="btn btn-space btn-danger"> Back </a>
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

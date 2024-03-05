@extends('backend.layout.master')
@section('title', 'Edit-ContactUs')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                <h5 class="card-header">Update contactus - Page</h5>
                @error('name')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $contactus }}</strong>
                </div>
                @enderror
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $contactus }}</strong>
                    </div>
                @enderror
                @error('phone')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $contactus }}</strong>
                    </div>
                @enderror
                @error('password')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $contactus }}</strong>
                </div>
                @enderror
                @error('role')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $contactus }}</strong>
                </div>
                @enderror
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('contactus.update', $data['id']) }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="catname"></label>
                            <textarea  type="text" name="contactus" class="form-control" id="summernote" placeholder="post_content">{{$data['contactus']}}" </textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-center">
                                    <button type="submit" name="submit" class="btn btn-space btn-primary">Update</button>
                                    <a href="{{ url('/admin/contactus') }}" class="btn btn-space btn-danger"> Back </a>
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

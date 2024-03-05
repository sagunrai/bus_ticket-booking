@extends('backend.layout.master')
@section('title', 'Add User')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                <h5 class="card-header">Add feedback</h5>
                @error('name')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $feedback }}</strong>
                </div>
                @enderror
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $feedback }}</strong>
                    </div>
                @enderror
                @error('phone')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $feedback }}</strong>
                    </div>
                @enderror
                @error('password')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $feedback }}</strong>
                </div>
                @enderror
                @error('role')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $feedback }}</strong>
                </div>
                @enderror
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('feedback.update', $data['id']) }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="catname">Full name</label>
                            <input type="text" value="{{$data['name']}}"  name="name" class="form-control" id="catname12" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label for="catname">email</label>
                            <input type="text" value="{{$data['email']}}"  name="email" class="form-control" id="catname12" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="catname">contact</label>
                            <input type="text" value="{{$data['contact']}}"  name="contact" class="form-control" id="catname12" placeholder="contact">
                        </div>
                        <div class="form-group">
                            <label for="catname">Feedback</label>
                            <textarea type="text"  name="feedback" class="form-control" id="summernote" placeholder="feedback">{{$data['feedback']}}</textarea>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status">
                              <option value="">STATUS</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                          </div>
                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-center">
                                    <button type="submit" name="submit" class="btn btn-space btn-primary">Add</button>
                                    <a href="{{ url('/admin/feedback') }}" class="btn btn-space btn-danger"> Back </a>
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

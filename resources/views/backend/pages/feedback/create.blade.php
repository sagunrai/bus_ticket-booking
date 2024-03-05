@extends('backend.layout.master')
@section('title', 'Add User')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                <h3 class="card-header">प्रतिक्रिया</h3>
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
                    <form action="{{ route('feedback.store') }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="catname">पुरानाम *</label>
                            <input type="text" name="name" class="form-control" id="catname12" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="catname">इमेल *</label>
                            <input type="text" name="email" class="form-control" id="catname12" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="catname">प्रतिकृया *</label>
                            <textarea type="text" name="feedback" class="form-control" id="" placeholder=""></textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-center">
                                    <button type="submit" name="submit" class="btn btn-space btn-primary">पठाउनुहोस</button>
                                    {{-- <a href="{{ url('/admin/feedback') }}" class="btn btn-space btn-danger"> Back </a> --}}
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

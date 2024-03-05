@extends('backend.layout.master')
@section('title', 'Add User')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                <h5 class="card-header">Update User</h5>
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
                @error('phone')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                @error('password')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                @error('role')
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('admin.user.update', $data['id']) }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title"> Name </label>
                            <input type="name"  value="{{$data['name']}}" name="name" placeholder="" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Email"> Email </label>
                            <input name="email" value="{{$data['email']}}" type="text" placeholder="" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone"> Phone </label>
                            <input name="phone" value="{{$data['phone']}}" type="text" placeholder="" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="addres"> Password </label>
                            <input name="password" type="password" placeholder="" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image"> Upload Image </label>
                            <input type="file" name="image" value="{{$data['image']}}"  placeholder="" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-form-label">Role</label>
                            <select name="role" class="form-control">
                                <option value="">-----Select Role-----</option>
                                <option value="user" {{ $data['role'] == 'user' ? 'selected' : '' }} >User</option>
                                <option value="Operator" {{ $data['role'] == 'Operator' ? 'selected' : '' }} >Operator</option>
                                <option value="admin" {{ $data['role'] == 'admin' ? 'selected' : '' }} >Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" value="{{$data['status']}}" name="status">
                              <option value="">STATUS</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                          </div>
                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-center">
                                    <button type="submit" name="submit" class="btn btn-space btn-primary">Add</button>
                                    <a href="{{ url('/admin/users') }}" class="btn btn-space btn-danger"> Back </a>
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

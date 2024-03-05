@extends('backend.layout.master')
@section('title', 'All Users')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> Users </h5>
                    <a href="{{ route('admin.user.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add User</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Phone </th>
                                    <th> Photo </th>
                                    <th> Joined </th>
                                    <th> Role </th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($users)
                                @foreach ($users as $user)
                                <tr>
                                    <td> {{ $user->id }} </td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->phone }} </td>
                                    <td>
                                        <img src="{{asset($user->image)}}" class="img-fluid rounded-circle" style="max-width:50px" alt="{{$user->image}}">
                                    </td>
                                    <td> {{(($user->created_at)? $user->created_at->diffForHumans() : '')}} </td>
                                    <td>
                                        <div class="dropdown d-inline-block mb-1">
                                            <button class="btn btn-{{ (($user->role == 'user') ? 'success' : 'danger') }} dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                {{ $user->role }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="/admin/users/role/{{ $user->id }}">{{ (($user->role == 'admin') ? 'user' : 'admin') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block mb-1">
                                            <button class="btn btn-{{ (($user->status == 'active') ? 'success' : 'danger') }} dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                {{ $user->status }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="/admin/users/status/{{ $user->id }}">{{ (($user->status == 'active') ? 'Inactive' : 'Active') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('admin.user.edit', $user->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit">
                                                <i class="fa fa-edit" style="color: white"></i>
                                            </a>
                                            <a href="{{ route('admin.user.delete', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times" style="color: white"></i>
                                            </a>
                                        </div>
                                    </td>
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

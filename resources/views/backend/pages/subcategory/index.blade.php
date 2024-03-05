@extends('backend.layout.master')
@section('title', 'Subcategory')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> Routes </h5>
                    <a href="{{ url('/admin/subcategory/add')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Routes</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th> Routes name </th>
                                    <th> From </th>
                                    <th> To </th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($subcategory)
                                @foreach ($subcategory as $user)
                                <tr>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->category ? $user->category->name : '' }} </td>
                                    <td> {{ $user->subcategory ? $user->subcategory->name : '' }} </td>
                                    <td>
                                        <div class="dropdown d-inline-block mb-1">
                                            <button class="btn btn-{{ (($user->status == 'active') ? 'success' : 'danger') }} dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                {{ $user->status }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="/admin/video/status/{{ $user->id }}">{{ (($user->status == 'active') ? 'Inactive' : 'Active') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('subcategory.edit', $user->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit">
                                                <i class="fa fa-edit" style="color: white"></i>
                                            </a>
                                            <a href="{{ route('subcategory.delet', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
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

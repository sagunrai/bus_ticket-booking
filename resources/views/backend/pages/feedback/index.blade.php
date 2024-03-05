@extends('backend.layout.master')
@section('title', 'All Users')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> feedback </h5>
                    <a href="{{ url('/admin/feedback/add')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add feedback</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th> id </th>
                                    <th> name </th>
                                    <th> email </th>
                                    <th> Comments </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($feedback)
                                @foreach ($feedback as $user)
                                <tr>
                                    <td> {{ $user->id }} </td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td>{!! Str::limit($user->message) !!} </td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('admin.feedback.delete', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
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

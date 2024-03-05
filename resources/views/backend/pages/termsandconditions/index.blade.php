@extends('backend.layout.master')
@section('title', 'TearmConditons')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> termsandconditions - Page </h5>
                    @isset($termsandconditions)
                    @foreach ($termsandconditions as $user)
                    <a href="{{ route('termsandconditions.edit', $user->id) }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User">Update - termsandconditions page</a>
                    @endforeach
                    @endisset
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th> termsandconditions </th>
                                    {{-- <th> Action </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @isset($termsandconditions)
                                @foreach ($termsandconditions as $user)
                                <tr>
                                    <td> {!! $user->termsandconditions !!} </td>
                                    {{-- <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('termsandconditions.edit', $user->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit">
                                                <i class="fa fa-edit" style="color: white"></i>
                                            </a>
                                            <a href="{{ route('termsandconditions.delet', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times" style="color: white"></i>
                                            </a>
                                        </div>
                                    </td> --}}
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

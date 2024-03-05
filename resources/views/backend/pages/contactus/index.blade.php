@extends('backend.layout.master')
@section('title', 'ContactUs')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> Contactus - Page </h5>
                    @isset($contactus)
                    @foreach ($contactus as $user)
                    <a href="{{ route('contactus.edit', $user->id) }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User">Update - Contactus page</a>
                    @endforeach
                    @endisset
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th> contactus </th>
                                    {{-- <th> Action </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @isset($contactus)
                                @foreach ($contactus as $user)
                                <tr>
                                    <td> {!! $user->contactus !!} </td>
                                    {{-- <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('contactus.edit', $user->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit">
                                                <i class="fa fa-edit" style="color: white"></i>
                                            </a>
                                            <a href="{{ route('contactus.delet', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
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

@extends('operator.layout.master')
@section('title', 'Operator Pannel')
@section('main-content')

<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title"> Operator Pannel </h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Operator Pannel</a></li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Home</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="ecommerce-widget">
        <div class="row">

        </div>
    </div>
</div>


@endsection


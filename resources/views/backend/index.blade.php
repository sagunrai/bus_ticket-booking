@extends('backend.layout.master')
@section('title', 'Dashboard')
@section('main-content')

<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title"> Dashboard </h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Home</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="ecommerce-widget">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted"> Users </h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">
                              <?php
                                $count = DB::table('users')->count();
                                echo '<h3>'.$count.'</h3>';
                                ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted"> Buses </h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">
                              <?php
                                $count = DB::table('buses')->count();
                                echo '<h3>'.$count.'</h3>';
                                ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted"> Operaotrs </h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">
                              <?php
                                $count = DB::table('bus_operators')->count();
                                echo '<h3>'.$count.'</h3>';
                                ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


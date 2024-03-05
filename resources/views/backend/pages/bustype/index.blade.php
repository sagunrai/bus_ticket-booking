@extends('backend.layout.master')
@section('title', 'bustype')
@section('style')
<style>
    .sn-row{
        display: flex;
    }
    .sn-col{
        height: 50px;
        width: 50px;
        text-align: center;
        padding-top: 10px;
        font-size: 16px;
        border: solid 2px black;
    }.sn-col[sn-count="0"]{
        background-color: rgb(255, 255, 255);
    }.sn-col[sn-count="1"]{
        /* background-color: rgb(61, 255, 61); */
        color:white;
        background-position: center;
        background-size: cover;
        background-image: url({{ asset('frontend/images/seat-open.png') }})
    }.sn-col[sn-count="2"]{
        /* background-color: rgb(255, 43, 43); */
        color:white;
        background-position: center;
        background-size: cover;
        background-image: url({{ asset('frontend/images/seat-packed.png') }})
    }.sn-col[sn-count="3"]{
        /* background-color: rgb(46, 46, 46); */
        color: rgb(7, 3, 3);
        background-position: center;
        background-size: cover;
        background-image: url({{ asset('frontend/images/seat-selected.png') }})
    }
</style>
@endsection
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> Bus Types </h5>
                    {{-- <a href="{{ url('/admin/bustype/add')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add BusType</a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th> Title </th>
                                    <th> Map </th>
                                    <th> Total Seats </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($bustype)
                                @foreach ($bustype as $user)
                                <tr>
                                    <td> {{ $user->name }} </td>
                                    <td>





                                    @php
                                        $names = json_decode($user->seat_names, true);
                                        $rows = $user->n_row;
                                        $cols = $user->n_col;
                                        $col_count = 0;
                                    @endphp
                                    <div class="my-4">
                                        @for ($i = 1; $i <= $rows; $i++)
                                            <div class="sn-row">
                                                @for ($j = 1; $j <= $cols; $j++)
                                                    @php
                                                        $row_cols = explode('|',$user->map);
                                                        $pp = 0;
                                                        foreach($row_cols as $rc){
                                                            $randc = explode(',',$rc);
                                                            $rr = $randc[0];
                                                            $cc = $randc[1];
                                                            if(($i == $rr) && ($j == $cc)){
                                                                $pp = $randc[2];
                                                            }
                                                        }
                                                        $col_count += 1;
                                                        $sn_name = '';
                                                        if($names){
                                                            if($pp == 1){
                                                                if(isset($names[$col_count])){
                                                                    $sn_name = $names[$col_count];
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="sn-col" sn-disable="{{ $pp == 2 ? '1' : ($pp == 0 ? '1' : '0') }}" sn-rc="{{ $i . $j }}" sn-row="{{ $i }}" sn-col="{{ $j }}" sn-count="{{ $pp }}">{{ $sn_name }}</div>
                                                @endfor
                                            </div>
                                        @endfor
                                    </div>





                                    </td>
                                    <td> {{ $user->seats }} </td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('bustype.edit', $user->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit">
                                                <i class="fa fa-edit" style="color: white"></i>
                                            </a>
                                            <a href="{{ route('bustype.delet', $user->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
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

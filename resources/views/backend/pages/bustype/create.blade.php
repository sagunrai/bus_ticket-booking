@extends('backend.layout.master')
@section('title', 'Add-bustype')
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
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                <h5 class="card-header">Bus Type</h5>
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
                    <form action="{{ route('bustype.store') }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="catname">title</label>
                            <input type="text" name="name" class="form-control" id="catname12" placeholder="name">
                        </div>


                        {{--  <div class="form-group">
                            <label for="catname">Map</label>
                            <select name="map" id="">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>  --}}

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                <label for="">Size (Row X Col)</label>
                                <input type="number"class="form-control" name="n_row" id="sn-row-get" style="width: 80px;"> X <input id="sn-col-get" name="n_col" type="number"class="form-control" style="width: 80px;">
                                <button type="button" name="" id="sn-set-all" class="btn btn-primary">Set</button>
                                </div>
                            </div>
                            <div class="draw-cotainer">
                            </div>
                            <select name="row_col[]" style="display: none" id="sn-row-col" multiple></select>
                        </div>
                        <div class="form-group col-md-6 pt-3" id="seat_name_container">
                            {{--  <div class="d-flex" id="seat_names">
                                <input type="text" name="seat_id[]" id="" class="form-control"> <span class="d-inline-block my-auto px-2">=></span> <input type="text" name="seat_name[]" id="" class="form-control">
                            </div>  --}}
                        </div>


                        <div class="form-group">
                            <label for="catname">Number of Seats</label>
                            <input type="number" name="seats" class="form-control" id="catname12" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-center">
                                    <button type="submit" name="submit" class="btn btn-space btn-primary">Add</button>
                                    <a href="{{ url('/admin/bustype') }}" class="btn btn-space btn-danger"> Back </a>
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
@section('scripts')
    <script>
        $('#sn-set-all').click(function () {
            var total_rows = $('#sn-row-get').val();
            var total_cols = $('#sn-col-get').val();
            total_rows = parseInt(total_rows);
            total_cols = parseInt(total_cols);


            var col_count = 0;
            $('.draw-cotainer').empty();
            var i = 0;
            for(i=1; i <= total_rows; i++){
                var j = 0;
                var col_out = '';
                for(j = 1; j <= total_cols; j++){
                    var id = "'sn-col-"+ i+j +"'" ;
                    col_count += 1;
                    col_out += '<div class="sn-col" sn-count="0" id="sn-col-'+ i+j +'" onclick="selectThis('+  id +','+  i +','+  j +');">'+ col_count +'</div>';
                }
                $('.draw-cotainer').append('<div class="sn-row">' + col_out + '</div>');
            }
        });
        function selectThis(id,row,col) {
            var count = $('#'+id).attr('sn-count');
            var content = parseInt($('#'+id).html());
            var r_c_d = row + ',' + col;

            var sn_id = 'sn'+ row + col ;
            if(count == 0){
                var row_col = row + ',' + col + ',1';
                $('#'+id).attr('sn-count', '1');
                if($('#'+sn_id).length == 0){
                    var take_elem = '<div class="d-flex" id="seat_names"> <input type="text" value="'+ content +'" name="seat_id[]" id="'+ sn_id +'" class="form-control"> <span class="d-inline-block my-auto px-2">=></span> <input type="text" name="seat_name[]" id="" class="form-control"></div>';
                    $('#seat_name_container').append(take_elem);
                }
            }else if(count == 1){
                var row_col = row + ',' + col + ',2';
                $('#'+id).attr('sn-count', '2');
            }else if(count == 2){
                var row_col = row + ',' + col + ',0';
                $('#'+id).attr('sn-count', '0');
            }
            var opt_output = '<option value="'+ row_col +'" selected sninfo="' + r_c_d +'">'+ row_col +'</option>'
            if($('#sn-row-col option[sninfo="'+ r_c_d +'"]').length){
                $('#sn-row-col option[sninfo="'+ r_c_d +'"]').attr('value',row_col);
            }else{
                $('#sn-row-col').append(opt_output);
            }

        }
    </script>
@endsection

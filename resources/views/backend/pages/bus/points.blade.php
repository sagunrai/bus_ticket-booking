@extends('backend.layout.master')
@section('title', 'Add User')
@section('main-content')

<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('bus.point.add', $bus->id) }}" >
                        <div class="form-group">
                            <label for="type">Select Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="boarding_point">Boarding Point</option>
                                <option value="dropping_point">Dropping Point</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">Location</label>
                            <input type="text" placeholder="Location Name" class="form-control" name="city" id="city">
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" name="time"  id="time">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
                <div class="card-body mt-3">
                    <table class="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th>SN</th>
                                <th>Point Type</th>
                                <th>Point</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bus->points as $point)
                                <tr>
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td>{{ $point->point_type }}</td>
                                    <td>{{ $point->point }}</td>
                                    <td>{{ $point->time }}</td>
                                    <td>
                                        <a class="btn btn-danger" href="{{ route('bus.point.remove', $point->id) }}" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
@section('scripts')
    <script>
        $('.sn-cal-day').click(function(){
            var bus = {{ $bus->id }};
            var v_l = $(this).attr('val');
            var data_id = $(this).attr('data-id');
            var t_id = $(this).attr('id');
            if($(this).hasClass('sn-active')){
                if(data_id){
                    $.ajax({
                        method: 'get',
                        url: '{{ route('bus.calander.remove') }}',
                        data: {
                            bus: bus,
                            data_id: data_id,
                            date: v_l,
                        },
                        success: function(response){
                            if(response.status){
                                $('#'+t_id).removeClass('sn-active');
                                if(v_l){
                                    $('#'+t_id).children('.cn_date').remove();
                                }
                            }
                        }
                    });
                }
            }else{
                if(!data_id){
                    $.ajax({
                        method: 'get',
                        url: '{{ route('bus.calander.add') }}',
                        data: {
                            bus: bus,
                            date: v_l,
                        },
                        success: function(response){
                            if(response.status){
                                $('#'+t_id).attr('data-id',response.id);
                                $('#'+t_id).addClass('sn-active');
                                if(v_l){
                                    var cn_inp = '<input type="text" class="cn_date" name="dates[]" value="'+ v_l +'">';
                                    $('#'+t_id).append(cn_inp);
                                }
                            }
                        }
                    });
                }
            }

        });
        $('#calander_slide').carousel({
            interval: false,
          });
    </script>
@endsection

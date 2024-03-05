@extends('backend.layout.master')
@section('title', 'Add-Image')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                <h5 class="card-header">Add Image</h5>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif

                  @if(session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                  @endif
                <div class="card-body">
                    <form action="{{ route('gallery.store') }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="busroute_id">Select Route</label>
                            <select name="busroute_id" id="busroute_id" class="form-control">
                                <option value="">---select---</option>
                                @foreach ($busroute as $buss)
                                    <option value="{{ $buss->id }}">{{ $buss->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catname">Select Bus</label>
                            <select name="bus_id" id="bus_id" class="form-control">
                                <option value="">---select---</option>
                            </select>
                        </div>
                        <div class="input-group control-group increment" >
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn">
                              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                            </div>
                          </div>
                          <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">
                              <input type="file" name="filename[]" class="form-control">
                              <div class="input-group-btn">
                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                              </div>
                            </div>
                          </div>

                          <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection

{{-- Media Library --}}
@section('scripts')
    <script>
        $('#busroute_id').change(function(){
            var busroute = $(this).val();
            $.ajax({
                method: 'get',
                url: "{{ route('bus.routewise.get') }}",
                data: {
                    busroute: busroute,
                },
                type: 'json',
                success: function(response){
                    if(response.status){
                        var datas = response.data;
                        $('#bus_id').empty();
                        $('#bus_id').append('<opton value="">-- Select One --</option>');
                        for(var i = 0; i < datas.length; i++){
                            var output = '<option value="'+ datas[i]["id"] +'">'+ datas[i]["name"] +'</option>'
                            $('#bus_id').append(output);
                        }
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function() {

            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });

        });

    </script>
@endsection

{{-- end Model Image Library --}}

@extends('backend.layout.master')
@section('title', 'Edit-Gallery')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-md-6 mx-auto col-12">
            <div class="card">
                <h5 class="card-header">Add Image</h5>
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
                    <form action="{{ route('gallery.update', $data['id']) }}" id="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card p-4">
                            <h5 class="card-header">Featured Image</h5>

                        <div class="card p-4">
                            <h5 class="card-header">Choose Image</h5>
                            <div class="form-group">
                                <input type="file" name="image" placeholder="" class="form-control" id="ads_image" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="catname">title(*optional)</label>
                            <input type="text" value="{{$data['name']}}"  name="name" class="form-control" id="catname12" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label for="catname">description(*optional)</label>
                            <input type="text"  value="{{$data['description']}}" name="description" class="form-control" id="catname12" placeholder="description">
                        </div>
                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-center">
                                    <button type="submit" name="submit" class="btn btn-space btn-primary">update</button>
                                    <a href="{{ url('/admin/gallery') }}" class="btn btn-space btn-danger"> Back </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

        {{-- Media Library --}}
        {{-- Model Image Library --}}
        <div class="modal fade modal-flex" id="Modal-taza" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                    <i class="fa fa-times-circle" style="font-size: 30px; color: rgb(2, 111, 138);"></i>
                    </span>
                </button>
                <form action="">
                    <div class="form-group">
                        <span class="input-title">
                        <label for="upload" style="font-size: 30px; font-weight: 600;color: black;"> Featured image </label>
                        </span>
                    </div><hr>
                    <form id="form_img" enctype="multipart/form-data" method="POST">
                        @csrf
                    <div class="form-group">
                        <span class="input-title">
                        <label for="upload" style="font-size: 22px; font-weight: 600;color: black;"> Choose to
                            Upload </label><br>
                        <input type="file" name="photo" id="upload_image" value="" size="40" class="" placeholder="">
                        <button type="button" id="store_image" class="btn btn-info">Upload</button>
                        </span><hr>

                        <small id="image_upload_status" class="text-success" style="display: none">Image Upload Successfully</small>
                    </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group col-md-6">
                                <label for="search_image"> Search Image </label>
                                <input type="text" class="form-control" id="search_image" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <label for="upload" style="font-size: 22px; font-weight: 600;color: black;"> Select Image</label>
                            <hr>
                            <div class="row" id="new_image">
                            </div>
                            <div class="row" id="image_place">
                            </div><hr>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="catname"> Alt Text </label>
                                <input type="text" name="alt" class="form-control" id="alt_text" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="catname"> Image Caption </label>
                                <input type="text" name="title" class="form-control" id="caption_text" placeholder="">
                            </div>
                            <div class="form-group">
                            <small id="not_updetd" class="text-danger" style="display: none">Detail did not updated</small>
                            <small id="yest_updetd" class="text-success" style="display: none">Updated Successfully</small>
                            </div>
                            <button type="button" id="update_detail" class="btn btn-block btn-success">Update</button>
                            <button type="button" id="select_image" class="btn btn-success mt-3 close-modal" data-dismiss="modal" aria-label="Close" style=" width: 100%; max-width: 100%;  background-color: rgb(2, 111, 138); color: white;  font-size: 20px; text-transform: uppercase;  font-weight: 600; padding: 5px; letter-spacing: 2px; float: right;"> Select </button>
                            <div style="width: 100%">
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        {{-- Media Library --}}
        @section('scripts')
            <script>
                var all_images = {};

                $('#open_model').click(function () {
                    call_image();
                });
                $('#search_image').change(function () {
                    call_image();
                });
                function call_image() {
                    $('#new_image').empty();
                    var q = $('#search_image').val();
                    $.ajax({
                        type: "get",
                        data: {
                            q: q,
                        },
                        url: "/admin/all_images",
                        success: function (response) {
                            console.log(response);
                            all_images = response.images;
                            var images = all_images;
                            var output = '';
                            $.each(images, function (index) {
                                output += ' <div class="col-md-2 col-6"> <div class="form-group"> <label class="sel-news-img"> <input class="form-control control-check photoselectfor_lib" type="radio" value="'+ images[index]["id"] +'" title="'+ images[index]["title"] +'" name="sel"> <img class="photoselectfor_img" src="/'+ images[index]["title"] +'" data-id="'+ images[index]["id"] +'" width="100%" alt=""></label> </div> </div>';
                            });
                            $('#image_place').empty();
                            $('#image_place').append(output);
                        }
                    });
                }


                $(document).ajaxStop(function(){
                    $('.photoselectfor_img').click(function (e) {
                        e.preventDefault();
                        var id = $(this).attr('data-id');
                        if(id != null){
                            take_desc(id);
                        }
                        $('#not_updetd').hide();
                    });
                });


                var file;
                $('#upload_image').change(function (e) {
                    e.preventDefault();
                    file = this.files[0];
                });
                $('#store_image').click(function (e) {
                    e.preventDefault();
                    var formdata= new FormData();
                    formdata.append('image', file, file.name);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: "/admin/store/image",
                        enctype: 'multipart/form-data',
                        cache : false,
                        contentType : false,
                        processData : false,
                        // traditional: true,
                        data: formdata,
                        // dataType: "json",
                        success: function (response) {
                            if(response.status){
                                var images = response.image;
                                all_images.push(images);
                                $('#image_upload_status').show().delay(2000).fadeOut();
                                $('#upload_image').val("");
                                var output = ' <div class="col-md-6 col-12"> <div class="form-group"> <label class="sel-news-img selectedimagelibrary"> <input class="form-control control-check photoselectfor_lib" checked="checked"  type="radio" value="'+ images["id"] +'" title="'+ images["title"] +'" name="sel"> <img class="photoselectfor_img" src="/'+ images["title"] +'" data-id="'+ images["id"] +'" width="100%" alt=""></label> </div> </div>';
                                $('#new_image').append(output);
                            }else{
                                console.log('not_uploded');
                            }
                        }
                    });
                });

                function take_desc(id){
                    var obj = getObjects(all_images, 'id', id);
                    if(obj != null){
                        $('#alt_text').val(obj[0]['alt_text']);
                        $('#caption_text').val(obj[0]['caption_text']);
                        $('#update_detail').val(obj[0]['id']);
                    }
                }


                $('#update_detail').click(function (e) {
                    e.preventDefault();
                    $('#not_updetd').hide();
                    var alt_text = $('#alt_text').val();
                    var caption_text = $('#caption_text').val();
                    var image_id = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: "/admin/update/image/"+image_id,
                        data: {
                            alt_text: alt_text,
                            caption_text: caption_text,
                        },
                        dataType: "json",
                        success: function (response) {
                            if(response.status){
                                console.log(response.status);
                                $('#not_updetd').hide();
                                $('#yest_updetd').show().delay(2000).fadeOut();

                            }else{
                                $('#not_updetd').show().delay(2000).fadeOut();
                            }
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                });


                function getObjects(obj, key, val) {
                    var objects = [];
                    for (var i in obj) {
                        if (!obj.hasOwnProperty(i)) continue;
                        if (typeof obj[i] == 'object') {
                            objects = objects.concat(getObjects(obj[i], key, val));
                        } else if (i == key && obj[key] == val) {
                            objects.push(obj);
                        }
                    }
                    return objects;
                }
            </script>
            <script>
            </script>
            <script>
                $('#select_image').click(function (e) {
                    e.preventDefault();
                    var image = $('input[name="sel"]:checked').attr('title');
                    var image_id = $('input[name="sel"]:checked').val();
                    if(image != null){
                        var alt_text = $('#alt_text').val();
                        var caption_text = $('#caption_text').val();
                        $('#ads_image').val(image_id);
                        $('#ads_alt_image').val(alt_text);
                        $('#ads_caption_image').val(caption_text);
                        $('#image_show').removeAttr('src');
                        $('#image_show').attr('src', '/'+image);
                    }
                });
            </script>
        @endsection

        {{-- end Model Image Library --}}
@endsection

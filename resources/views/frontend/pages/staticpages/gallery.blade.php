@extends('frontend.layouts.hf')

@section('content')

<div id="tabs" class="project-tab">
    <div class="container">
        <div class="row">
            <a class="col-12 p-0 black">
            </a>
        </div>
        <div class="row card card-body">
            <div class="accordion" id="accordionExample1">
                <h2 class="text-center" style="color:black;font-size:20px; padding:0">Image Gallery</h2>
                <div class="card">
                    <div class="row">
                        <form class="col-md-3" action="">
                            <div class="form-group">
                                <label for="route">Bus Route</label>
                                <select class="form-control" name="route" id="route">
                                    @foreach ($routes as $route)
                                        <option value="{{ $route->id }}"
                                            @if(isset($_GET['route']))
                                                {{ $_GET['route'] == $route->id ? 'selected' : '' }}
                                            @endif
                                            >{{ $route->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info btn-lg btn-block">Filter</button>
                        </form>
                        <div class="col-md-9 col-12 news-cate-menu">
                            <div class=" pagegsection">
                                <div class="lightbox-gallery">
                                    <div class=""><hr>
                                        <div class="row photos">
                                            @isset($gallery)
                                                @foreach($gallery as $gallerys)
                                                    @foreach (json_decode($gallerys->filename) as $image)
                                                        <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="{{ asset( 'frontend/images/gallery/' . $image ) }}" data-lightbox="photos"><img class="img-fluid" src="{{ asset( 'frontend/images/gallery/' . $image ) }}" width="100%"></a></div>
                                                    @endforeach
                                                @endforeach
                                                <div class="col-12">
                                                    {{ $gallery->links() }}
                                                </div>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

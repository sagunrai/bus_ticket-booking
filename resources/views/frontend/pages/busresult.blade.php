@extends('frontend.layouts.hf')

@section('style')
    <style>
        .sn-head-container{
            position: relative;
            width: 200px;
            text-align: center;
            display: flex;
            flex-wrap: wrap;
        }
        .sn-htext{
            display: inline-block;
            margin: auto;
            background: #fff;
            padding: 5px 10px;
            border-bottom: solid 2px;

        }
        .sn-b_r_c{
            box-shadow: 0 3px 10px rgb(92 92 92);
            border: solid 2px #dbdbdb;
            background-color: #dbdbdb;
            margin: 10px 0;
            border-radius: 10px;
        }
        .sn-b_r_c:hover{
            box-shadow: 0 3px 10px rgb(92 92 92);
            border: solid 2px #c34141;
            margin: 10px 0;
        }
        .sn-sub-row{
            /* padding: 10px 0; */
        }
        .sn-btn{
            cursor: pointer;
            border-bottom: solid 2px black;
            padding-bottom: 2px;

        }
        .sn-checked{
            color: rgb(255, 166, 0);
        }
        .sn-sub-row div.col-md-3, .col-md-3 div.col-md-12{
            padding-top: 20px;
        }
    </style>
@endsection

@section('content')

    @include('frontend.layouts.search-filter')

    <div class="container">
        <div class="card card-body mb-5 " style="border:none;">
            <div class="row">
                {{-- <div class="col-12">
                    <div class="container" style="border-right: 2px solid rgb(90, 90, 90)">
                        <form action="{{ route('busresult') }}" method="get" class="row">
                            <input type="text" class="d-none" value="{{ $_GET['date'] }}" name="date">
                            <div class="form-group">
                                <label for="">Operators</label>
                                <select class="form-control" name="operator" id="">
                                    @php
                                        $users = DB::table('users')->where('role','Operator')->where('status','active')->get();
                                        // $users = DB::table('users')->where('status','active')->get();
                                    @endphp
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-block btn-danger" type="submit">Filter</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                @isset($buses)
                    <div class="col-12">
                        @foreach ($buses as $buslist)
                        <div class="row sn-b_r_c">
                            <div class="col-md-3">
                                <div class="SOME-CONTENT-IMAGE">
                                    <img src="{{ asset($buslist->image) }}" alt="" width="100%" class="image-justify">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-9">

                                        <div class="row sn-sub-row">
                                            <div class="col-md-3 col-6">{{ $buslist->name }}</div>
                                            <div class="col-md-3 col-6"><a class="sn-btn" data-toggle="modal" data-target="#bookingPolicy{{ $loop->index }}">Booking Policy</a></div>
                                            <div class="col-md-3 col-6">{{ \carbon\Carbon::parse($buslist->departuretime )->format('h:i A');}}</div>
                                            <div class="col-md-3 col-6">{{ \carbon\Carbon::parse($buslist->arrivaltime )->format('h:i A');}}</div>
                                        </div>
                                        <div class="row sn-sub-row">
                                            <div class="col-md-3 col-6">{{ $buslist->bustypename ? $buslist->bustypename->name : '' }}</div>
                                            <div class="col-md-3 col-6"><a class="sn-btn" data-toggle="modal" data-target="#amneties{{ $loop->index }}">Amneties</a> </div>
                                            <?php
                                                $fromto = explode('To',$buslist->busroutename ? $buslist->busroutename->name : '');
                                                if(!isset($fromto[1])){
                                                    $fromto = explode('to',$buslist->busroutename ? $buslist->busroutename->name : '');
                                                }
                                            ?>
                                            @if(isset($fromto[1]))
                                                <div class="col-md-3 col-6">{{ $fromto[0] }}</div>
                                                <div class="col-md-3 col-6">{{ $fromto[1] }}</div>
                                            @endif
                                        </div>
                                        <div class="row sn-sub-row">
                                            <div class="col-md-3 col-6"><a class="sn-btn" data-toggle="modal" data-target="#moreImages{{ $loop->index }}">More Images</a></div>
                                            @php
                                                $rating = App\Http\Controllers\BusRatingController::getRating($buslist->id);
                                                $in_percent = ($rating / 5) * 100;
                                            @endphp
                                            <div class="col-md-3 col-6">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if(($rating > $i) && ($rating < $i+1))
                                                        <i class="fa fa-star-half sn-checked" aria-hidden="true"></i>
                                                    @elseif($rating > $i)
                                                        <i class="fa fa-star sn-checked" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    @endif

                                                @endfor
                                                <br>
                                                <span>( {{ $rating }} Star )</span>
                                            </div>
                                            <div class="col-md-3 col-6"> <a class="sn-btn" data-toggle="modal" data-target="#boardingPoints{{ $loop->index }}">Boarding Points</a> </div>
                                            <div class="col-md-3 col-6"><a class="sn-btn" data-toggle="modal" data-target="#dropingPoints{{ $loop->index }}">Drooping Points</a></div>
                                        </div>
                                    </div>
                                    <?php
                                        $total_seats = App\Http\Controllers\BookingController::totalSeats($buslist->id);
                                        $selected_seats = App\Http\Controllers\BookingController::countSelectedSeats($buslist->id);
                                        $available_seats = $total_seats - $selected_seats;
                                    ?>
                                    <div class="col-md-3 d-flex py-2 px-3" style="flex-wrap: wrap;">
                                        <div class="col-md-12 col-6">
                                            Available <span class="badge badge-info">{{ $available_seats }} Seats</span>
                                        </div>
                                        <div class="col-md-12 col-6 m-auto">
                                            Rs. {{ $buslist->after_discount }}
                                        </div>
                                        <div class="col-md-12 col-6 mx-auto">

                                            @php
                                                $date = '';
                                                if(isset($_GET['date'])){
                                                    $date =  $_GET['date'];
                                                }
                                            @endphp



                                            @auth
                                                {{-- @if ($buslist->booking_closing_time < $buslist->departuretime)
                                                    <a href="javascript:void(0);"><input type="submit" value="Not Available"  class="Search-Buses-Buttom bg-dark" style="padding:7px; border-radius: 80px; color:white; margin-right: 5px; padding-left: 20px; padding-right: 20px; border:none; margin-top: 13px;"></a>
                                                @else --}}
                                                    <a href="{{ route('book', $buslist->id) }}?date={{ $date }}"><input type="submit" value="Book Now"  class="Search-Buses-Buttom" style="padding:7px; border-radius: 80px; color:white; margin-right: 5px; padding-left: 20px; padding-right: 20px; border:none; margin-top: 13px;"></a>
                                                {{-- @endif --}}
                                            @else
                                                <a href="javascript:void(0)" onclick="openLoginForm()""><input type="submit" value="Book Now"  class="Search-Buses-Buttom" style="padding:7px; border-radius: 80px; color:white; margin-right: 5px; padding-left: 20px; padding-right: 20px; border:none; margin-top: 13px;"></a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="bookingPolicy{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Booking Policy</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{!! $buslist->booking_policy !!}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="amneties{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Amneties</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @php
                                                $amneties = explode(',',$buslist->amneties);
                                            @endphp
                                            @foreach ($amneties as $item)
                                                <li><span class="badge badge-dark">{{ $item }}</span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="moreImages{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">More Images</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row photos">
                                            @isset($buslist->gallery)
                                                @foreach($buslist->gallery as $gallerys)
                                                    @foreach (json_decode($gallerys->filename) as $image)
                                                        <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="{{ asset( 'frontend/images/gallery/' . $image ) }}" data-lightbox="photos"><img class="img-fluid" src="{{ asset( 'frontend/images/gallery/' . $image ) }}" width="100%"></a></div>
                                                    @endforeach
                                                @endforeach
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="boardingPoints{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Boarding Points</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @foreach ($buslist->points()->where('point_type','boarding_point')->get() as $item)
                                                <li class="list-group-item">{{ $item->point }} -  <span class="badge badge-dark"> {{ $item->time }} </span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="dropingPoints{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Droping Points</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @foreach ($buslist->points()->where('point_type','dropping_point')->get() as $item)
                                                <li class="list-group-item">{{ $item->point }} -  <span class="badge badge-dark"> {{ $item->time }} </span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $buses->links() }}
                @else
                    <div class="col-12">
                        <div class="col-12 px-1">
                            <div class="jumbotron text-center py-2 mt-3 my-2">
                                <h1 class="display-6">No result found in this route</h1>
                                <hr class="my-2">
                                <p >Please view some other route.</p>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="sn-head-container mx-auto">
                                <h5 class="sn-htext">Available Routes</h5>
                            </div>
                        </div>
                        @foreach ($buses_available as $buslist)
                        <div class="row sn-b_r_c">
                            <div class="col-md-3">
                                <div class="SOME-CONTENT-IMAGE">
                                    <img src="{{ asset($buslist->image) }}" alt="" width="100%" class="image-justify">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-9">

                                        <div class="row sn-sub-row">
                                            <div class="col-md-3 col-6">{{ $buslist->name }}</div>
                                            <div class="col-md-3 col-6"><a class="sn-btn" data-toggle="modal" data-target="#bookingPolicy{{ $loop->index }}">Booking Policy</a></div>
                                            <div class="col-md-3 col-6">{{ \carbon\Carbon::parse($buslist->departuretime )->format('h:i A');}}</div>
                                            <div class="col-md-3 col-6">{{ \carbon\Carbon::parse($buslist->arrivaltime )->format('h:i A');}}</div>
                                        </div>
                                        <div class="row sn-sub-row">
                                            <div class="col-md-3 col-6">{{ $buslist->bustypename ? $buslist->bustypename->name : '' }}</div>
                                            <div class="col-md-3 col-6"><a class="sn-btn" data-toggle="modal" data-target="#amneties{{ $loop->index }}">Amneties</a> </div>
                                            <?php
                                                $fromto = explode('To',$buslist->busroutename ? $buslist->busroutename->name : '');
                                                if(!isset($fromto[1])){
                                                    $fromto = explode('to',$buslist->busroutename ? $buslist->busroutename->name : '');
                                                }
                                            ?>
                                            @if(isset($fromto[1]))
                                                <div class="col-md-3 col-6">{{ $fromto[0] }}</div>
                                                <div class="col-md-3 col-6">{{ $fromto[1] }}</div>
                                            @endif
                                        </div>
                                        <div class="row sn-sub-row">
                                            <div class="col-md-3 col-6"><a class="sn-btn" data-toggle="modal" data-target="#moreImages{{ $loop->index }}">More Images</a></div>
                                            @php
                                                $rating = App\Http\Controllers\BusRatingController::getRating($buslist->id);
                                                $in_percent = ($rating / 5) * 100;
                                            @endphp
                                            <div class="col-md-3 col-6">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if(($rating > $i) && ($rating < $i+1))
                                                        <i class="fa fa-star-half sn-checked" aria-hidden="true"></i>
                                                    @elseif($rating > $i)
                                                        <i class="fa fa-star sn-checked" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    @endif

                                                @endfor
                                                <br>
                                                <span>( {{ $rating }} Star )</span>
                                            </div>
                                            <div class="col-md-3 col-6"> <a class="sn-btn" data-toggle="modal" data-target="#boardingPoints{{ $loop->index }}">Boarding Points</a> </div>
                                            <div class="col-md-3 col-6"><a class="sn-btn" data-toggle="modal" data-target="#dropingPoints{{ $loop->index }}">Drooping Points</a></div>
                                        </div>
                                    </div>
                                    <?php
                                        $total_seats = App\Http\Controllers\BookingController::totalSeats($buslist->id);
                                        $selected_seats = App\Http\Controllers\BookingController::countSelectedSeats($buslist->id);
                                        $available_seats = $total_seats - $selected_seats;
                                    ?>
                                    <div class="col-md-3 d-flex py-2 px-3" style="flex-wrap: wrap;">
                                        <div class="col-md-12 col-6">
                                            Available <span class="badge badge-info">{{ $available_seats }} Seats</span>
                                        </div>
                                        <div class="col-md-12 col-6 m-auto">
                                            Rs. {{ $buslist->after_discount }}
                                        </div>
                                        <div class="col-md-12 col-6 mx-auto">

                                            @php
                                                $date = '';
                                                if(isset($_GET['date'])){
                                                    $date =  $_GET['date'];
                                                }
                                            @endphp
                                            @auth
                                                @if ($buslist->booking_closing_time < $buslist->departuretime)
                                                    <a href="javascript:void(0);"><input type="submit" value="Not Available"  class="Search-Buses-Buttom bg-dark" style="padding:7px; border-radius: 80px; color:white; margin-right: 5px; padding-left: 20px; padding-right: 20px; border:none; margin-top: 13px;"></a>
                                                @else
                                                    <a href="{{ route('book', $buslist->id) }}?date={{ $date }}"><input type="submit" value="Book Now"  class="Search-Buses-Buttom" style="padding:7px; border-radius: 80px; color:white; margin-right: 5px; padding-left: 20px; padding-right: 20px; border:none; margin-top: 13px;"></a>
                                                @endif
                                            @else
                                                <a href="javascript:void(0)" onclick="openLoginForm()""><input type="submit" value="Book Now"  class="Search-Buses-Buttom" style="padding:7px; border-radius: 80px; color:white; margin-right: 5px; padding-left: 20px; padding-right: 20px; border:none; margin-top: 13px;"></a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="bookingPolicy{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Booking Policy</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{!! $buslist->booking_policy !!}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="amneties{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Amneties</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @php
                                                $amneties = explode(',',$buslist->amneties);
                                            @endphp
                                            @foreach ($amneties as $item)
                                                <li><span class="badge badge-dark">{{ $item }}</span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="moreImages{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">More Images</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row photos">
                                            @isset($buslist->gallery)
                                                @foreach($buslist->gallery as $gallerys)
                                                    @foreach (json_decode($gallerys->filename) as $image)
                                                        <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="{{ asset( 'frontend/images/gallery/' . $image ) }}" data-lightbox="photos"><img class="img-fluid" src="{{ asset( 'frontend/images/gallery/' . $image ) }}" width="100%"></a></div>
                                                    @endforeach
                                                @endforeach
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="boardingPoints{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Boarding Points</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @foreach ($buslist->points()->where('point_type','boarding_point')->get() as $item)
                                                <li class="list-group-item">{{ $item->point }} -  <span class="badge badge-dark"> {{ $item->time }} </span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="dropingPoints{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Droping Points</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @foreach ($buslist->points()->where('point_type','dropping_point')->get() as $item)
                                                <li class="list-group-item">{{ $item->point }} -  <span class="badge badge-dark"> {{ $item->time }} </span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection

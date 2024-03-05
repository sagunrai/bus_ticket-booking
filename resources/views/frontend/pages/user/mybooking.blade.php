@extends('frontend.layouts.hf')
@section('style')
    <style>
        .sn-dropdown:hover > .sn-dropdown-menu{
            /* display: block; */
        }
    </style>
@endsection
@section('content')

<div class="container mt-5">



    <div class="row">
        <div class="col-12">
            <form action="" class="row">
                <div class="form-group col-md-4">
                    <label for="day">Select Day</label>
                    <input name="day" class="form-control" id="day"
                    <?php
                        if(isset($_GET['day'])){
                            echo 'value="'.$_GET['day'].'"';
                        }else{
                            echo 'value="'.now()->format('Y-m-d').'"';
                        }
                    ?>
                    type="date">
                </div>
                <div class="col-md-4 form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="all" <?php
                            if(isset($_GET['type'])){
                                echo $_GET['type'] == 'all' ? 'selected' : '';
                            }
                        ?> >All</option>
                        <option value="active" <?php
                            if(isset($_GET['type'])){
                                echo $_GET['type'] == 'active' ? 'selected' : '';
                            }
                        ?>>Active</option>
                        <option value="inactive" <?php
                            if(isset($_GET['type'])){
                                echo $_GET['type'] == 'inactive' ? 'selected' : '';
                            }
                        ?>>Inative</option>
                        <option value="cancelled" <?php
                            if(isset($_GET['type'])){
                                echo $_GET['type'] == 'cancelled' ? 'selected' : '';
                            }
                        ?>>Cancelled</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-block btn-info btn-sm ">Filter</button>
                </div>
            </form>
        </div>
    </div>

    @isset($bookings)

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 text-center p-2"> My Bookings </h5>
                        {{--  <a href="{{ url('/admin/add-users')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add User</a>  --}}
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td>Tiket N.</td>
                                            <td>Path</td>
                                            <td>BusName</td>
                                            <td>Seats</td>
                                            <td>Date</td>
                                            <td>Booked on</td>
                                            <td>Status</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->ticket_number }}</td>
                                                    <td>{{ $booking->busnameforpasger ? ($booking->busnameforpasger->busroutename ? $booking->busnameforpasger->busroutename->name : '') : '' }}</td>
                                                    <td>{{ $booking->busnameforpasger ? $booking->busnameforpasger->name : '' }}</td>
                                                    <td>
                                                        @php
                                                            $bustype = $booking->busnameforpasger ? $booking->busnameforpasger->bustypename : '';
                                                            // dd($bustype);
                                                            if($bustype){
                                                                $map = explode('|', $booking->map);
                                                                $names = json_decode($bustype->seat_names, true);
                                                                if($names){
                                                                    foreach($map as $m){
                                                                        echo '<span class="d-inline-block mx-1 p-1 bg-dark text-light">' . $names[$m] . '</span>';
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                    </td>
                                                    <td><span class="badge badge-info">{{ $booking->bookingdate }}</span></td>
                                                    <td><span class="badge text-dark">{{ $booking->created_at->format('Y-m-d h:i A') }}</span></td>
                                                    <td><span class="badge badge-{{ ($booking->status == 'cancelled' ? 'danger' : '') . ($booking->status == 'inactive' ? 'info' : '') . ($booking->status == 'active' ? 'success' : '') }}">{{ $booking->status }}</span></td>
                                                    <td>

                                                        @php
                                                            $booked_date = \carbon\Carbon::parse($booking->bookingdate);
                                                            if($booked_date > now()){
                                                                if($booking->status != 'cancelled'){
                                                                    $available = $booked_date;
                                                                }
                                                            }
                                                        @endphp
                                                        <div class="dropdown open sn-dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle sn-dropdown-btn" type="button" tri-id="sn-triggred-id{{ $loop->index }}">
                                                                        Action
                                                                    </button>
                                                            <div class="dropdown-menu  sn-dropdown-menu" id="sn-triggred-id{{ $loop->index }}">
                                                                <a class="dropdown-item" target="_blank" href="{{ route('print.booking',$booking->id) }}">View Ticket</a>
                                                                <a class="dropdown-item" href="{{ route('sms.booking',$booking->id) }}">SMS Ticket</a>
                                                                <a class="dropdown-item" href="{{ route('email.booking',$booking->id) }}">Email Ticket</a>
                                                                @isset($available)
                                                                    <a class="dropdown-item" href="{{ route('cance.booking',$booking->id) }}">Cancel Ticket</a>
                                                                @endisset
                                                            </div>
                                                        </div>
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

    @endisset

</div>
@endsection
@section('scripts')
    <script>
        $('.sn-dropdown-btn').click(function (e) {
            e.preventDefault();
            var triId = $(this).attr('tri-id');
            $("#" + triId).toggle();
        });
    </script>
@endsection

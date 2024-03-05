@extends('backend.layout.master')
@section('title', 'Bookings')
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

    @php
        $buses = DB::table('buses')->get();
    @endphp
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-12">
                <form action="" class="row">
                    <div class="form-group col-md-4">
                        <label for="bus">Select Bus</label>
                        <select name="bus" class="form-control" id="bus">
                            <option value="">-- Select Bus --</option>
                            @foreach ($buses as $bus)
                                <option value="{{ $bus->id }}"
                                    <?php
                                        if(isset($_GET['bus'])){
                                            echo $_GET['bus'] == $bus->id ? 'selected' : '';
                                        }
                                    ?>
                                    >{{ $bus->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="all" <?php
                                if(isset($_GET['status'])){
                                    echo $_GET['status'] == 'all' ? 'selected' : '';
                                }
                            ?> >All</option>
                            <option value="active" <?php
                                if(isset($_GET['status'])){
                                    echo $_GET['status'] == 'active' ? 'selected' : '';
                                }
                            ?>>Active</option>
                            <option value="inactive" <?php
                                if(isset($_GET['status'])){
                                    echo $_GET['status'] == 'inactive' ? 'selected' : '';
                                }
                            ?>>Inative</option>
                            <option value="cancelled" <?php
                                if(isset($_GET['status'])){
                                    echo $_GET['status'] == 'cancelled' ? 'selected' : '';
                                }
                            ?>>Cancelled</option>
                        </select>
                    </div>
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
                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-info btn-sm ">Search</button>
                    </div>
                </form>
            </div>
        </div>


        @isset($bookings)

            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 text-center p-2"> All Passangers </h5>
                            {{--  <a href="{{ url('/admin/add-users')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add User</a>  --}}
                        </div>
                        <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <td>SN</td>
                                                <td>Ticket N.</td>
                                                <td>Route</td>
                                                <td>Bus Name</td>
                                                {{-- <td>Bus No.</td> --}}
                                                <td>Booked Date</td>
                                                <td>Journey Date</td>
                                                <td>Departure </td>
                                                <td>Boarding Points</td>
                                                <td>Seat No.</td>
                                                <td>Total Seats</td>
                                                <td>Total Price</td>
                                                <td>Paid By</td>
                                                <td>Name</td>
                                                <td>Email</td>
                                                <td>Phone</td>
                                                <td>Gender</td>
                                                <td>Remarks</td>
                                                <td>Status</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($bookings)
                                                @foreach ($bookings as $booking)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $booking->ticket_number }}</td>
                                                        <td>{{ $booking->busnameforpasger ? ($booking->busnameforpasger->busroutename ? $booking->busnameforpasger->busroutename->name : '') : '' }}</td>
                                                        <td>{{ $booking->busnameforpasger ? ($booking->busnameforpasger->name) : '' }}</td>
                                                        {{-- <td>{{ $booking->busnameforpasger ? ($booking->busnameforpasger->bus_no) : '' }}</td> --}}
                                                        <td><span class="badge">{{ $booking->created_at->format('Y-m-d h:i A') }}</span></td>
                                                        <td><span class="badge badge-info">{{ $booking->bookingdate }}</span></td>
                                                        <td>{{ $booking->busnameforpasger ? ($booking->busnameforpasger->departuretime) : '' }}</td>
                                                        <td>{{ $booking->boading_point }}</td>
                                                        <td>
                                                            @php
                                                                $count = 0;
                                                                $map = explode('|', $booking->map);
                                                                $names = json_decode($bustype->seat_names, true);
                                                                if($names){
                                                                    foreach($map as $m){
                                                                        $count++;
                                                                        if(strlen($m) < 4){
                                                                            if(isset($names[$m])){
                                                                                echo '<span class="d-inline-block mx-1 p-1 bg-dark text-light">' . $names[$m] . '</span>';
                                                                            }else{
                                                                                echo '<span class="d-inline-block mx-1 p-1 bg-dark text-light">NAN</span>';
                                                                            }
                                                                        }else{
                                                                            echo '<span class="d-inline-block mx-1 p-1 bg-dark text-light">NAN</span>';
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                        </td>
                                                        <td>{{ $count }}</td>
                                                        <td>{{ $booking->payment_amount }}</td>
                                                        <td>{{ $booking->payment_from }}</td>
                                                        <td>{{ $booking->pname }}</td>
                                                        <td>{{ $booking->pemail }}</td>
                                                        <td>{{ $booking->pphone }}</td>
                                                        <td>{{ $booking->pgender }}</td>
                                                        <td>{{ $booking->remark }}</td>
                                                        <td><span class="badge badge-{{ ($booking->status == 'cancelled' ? 'danger' : '') . ($booking->status == 'inactive' ? 'info' : '') . ($booking->status == 'active' ? 'success' : '') }}">{{ $booking->status }}</span></td>
                                                        <td>
                                                            <div class="dropdown open">
                                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="drop_triger{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                            Action
                                                                        </button>
                                                                <div class="dropdown-menu" aria-labelledby="drop_triger{{ $loop->index }}">
                                                                    <a class="dropdown-item" target="_blank" href="{{ route('user.booking.show',$booking->id) }}">View Ticket</a>
                                                                    <a class="dropdown-item" href="{{ route('user.booking.sms',$booking->id) }}">SMS Ticket</a>
                                                                    <a class="dropdown-item" href="{{ route('user.booking.email',$booking->id) }}">Email Ticket</a>
                                                                    <a class="dropdown-item" href="{{ route('user.booking.cancel',$booking->id) }}">Cancel Ticket</a>
                                                                </div>
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
                <div class="col-md-4 ml-auto">

                    @php
                        $names = json_decode($bustype->seat_names, true);
                        $rows = $bustype->n_row;
                        $cols = $bustype->n_col;
                        $col_count = 0;
                    @endphp
                    <div class="my-4">
                        @for ($i = 1; $i <= $rows; $i++)
                            <div class="sn-row">
                                @for ($j = 1; $j <= $cols; $j++)
                                    @php
                                        $row_cols = explode('|',$bustype->map);
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
                                        $selected = false;
                                        foreach($selected_seats as $st){
                                            if($st == $col_count){
                                                $selected = true;
                                            }
                                        }

                                        $sn_name = '';
                                        if($names){
                                            if($pp == 1){
                                                if(isset($names[$col_count])){
                                                    $sn_name = $names[$col_count];
                                                }
                                            }
                                        }
                                    @endphp
                                    <div class="sn-col" sn-count="{{ $selected  ? 3 : '' }}" >{{ $sn_name }}</div>
                                @endfor
                            </div>
                        @endfor

                        {{-- <select name="row_col[]" style="display: none" id="sn-row-col" multiple></select> --}}
                    </div>
                </div>
            </div>
        @endisset
    </div>

@endsection

@extends('backend.layout.master')
    @isset($bus)
        @section('title', $bus->name . ' - ('. $_GET['day'] .')')
    @else
        @section('title', 'Digital Chalani')
    @endisset
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
                            <option value="all"
                            <?php
                                if(isset($_GET['bus'])){
                                    echo $_GET['bus'] == 'all' ? 'selected' : '';
                                }
                            ?>
                            >-- All --</option>
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
                        <label for="status">Method</label>
                        <select name="type" id="status" class="form-control">
                            <option value="all" <?php
                                if(isset($_GET['type'])){
                                    echo $_GET['type'] == 'all' ? 'selected' : '';
                                }
                            ?> >All</option>
                            <option value="khalti" <?php
                                if(isset($_GET['type'])){
                                    echo $_GET['type'] == 'khalti' ? 'selected' : '';
                                }
                            ?>>Khalti</option>
                            <option value="esewa" <?php
                                if(isset($_GET['type'])){
                                    echo $_GET['type'] == 'esewa' ? 'selected' : '';
                                }
                            ?>>Esewa</option>
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
                    <h4>{{ Str::ucfirst($bus->name) }} - {{ $_GET['day'] }}</h4>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <td>SN</td>
                                    <td>Ticket N.</td>
                                    <td>Route</td>
                                    <td>Bus Name</td>
                                    <td>Booked Date</td>
                                    <td>Total Seats</td>
                                    <td>Total Price</td>
                                    <td>Remarks</td>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($bookings)
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $booking->ticket_number }}</td>
                                            <td>{{ $booking->busnameforpasger ? ($booking->busnameforpasger->busroutename ? $booking->busnameforpasger->busroutename->name : '') : '' }}</td>
                                            <td>{{ $booking->busnameforpasger ? $booking->busnameforpasger->name : '' }}</td>
                                            <td><span class="badge">{{ $booking->created_at->format('Y-m-d h:i A') }}</span></td>
                                            <td>
                                                @php
                                                    $bus = $booking->busnameforpasger;
                                                    $count = 0;
                                                    if(isset($bus)){
                                                        $bustype = $bus->bustypename;
                                                        if(isset($bustype)){
                                                            $map = explode('|', $booking->map);
                                                            $names = json_decode($bustype->seat_names, true);
                                                            if($names){
                                                                foreach($map as $m){
                                                                    $count++;
                                                                }
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                {{ $count }}
                                            </td>
                                            <td>{{ $booking->payment_amount }}</td>
                                            <td>{{ $booking->remark }}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endisset
    </div>

@endsection

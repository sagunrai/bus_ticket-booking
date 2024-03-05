@extends('frontend.layouts.hf')

@section('content')

<div class="container">



    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 text-center p-2"> My Booking ({{ $booking->bookingdate }}) </h5>
                    {{--  <a href="{{ url('/admin/add-users')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add User</a>  --}}
                </div>
                <div class="card-body">
                    @isset($booking)
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>

                                    @php
                                        $booked_date = \carbon\Carbon::parse($booking->bookingdate);
                                        if($booked_date > now()){
                                            if($booking->status != 'cancelled'){
                                                $available = $booked_date;
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td>Ticket N.</td>
                                        <td>Path</td>
                                        <td>BusName</td>
                                        <td>Seats</td>
                                        <td>Date</td>
                                        <td>Booked on</td>
                                        <td>Type</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $booking->ticket_number }}</td>
                                        <td>{{ $booking->busnameforpasger ? ($booking->busnameforpasger->busroutename ? $booking->busnameforpasger->busroutename->name : '') : '' }}</td>
                                        <td>{{ $booking->busnameforpasger ? $booking->busnameforpasger->name : '' }}</td>
                                        <td>
                                            @php
                                                $bustype = $booking->busnameforpasger ? $booking->busnameforpasger->bustypename : '';
                                                // dd($bustype);
                                                $map = explode('|', $booking->map);
                                                $names = json_decode($bustype->seat_names, true);
                                                $count = 0;
                                                if($names){
                                                    foreach($map as $m){
                                                        $count += 1;
                                                        echo '<span class="sn-badge">' . $names[$m] . '</span>';
                                                    }
                                                }
                                            @endphp
                                        </td>
                                        <td><span class="badge badge-danger">{{ $booking->bookingdate }}</span></td>
                                        <td><span class="badge text-dark">{{ $booking->created_at->format('Y-m-d h:i A') }}</span></td>
                                        <td><span class="badge badge-{{ ($booking->status == 'cancelled' ? 'danger' : '') . ($booking->status == 'inactive' ? 'info' : '') . ($booking->status == 'active' ? 'success' : '') }}">{{ $booking->status }}</span></td>

                                        @isset($available)
                                            <td>
                                                <a id="cancel_booking" href="{{ route('cance.booking',$booking->id) }}" class="btn btn-danger">Cancel</a>
                                                <a id="print_booking" href="{{ route('print.booking',$booking->id) }}" class="btn btn-info">Print</a>
                                                <a id="print_booking" href="{{ route('email.booking',$booking->id) }}" class="btn btn-dark">Email</a>
                                            </td>
                                        @else
                                            <td>
                                                <a id="print_booking" href="{{ route('print.booking',$booking->id) }}" class="btn btn-info">Print</a>
                                                <a id="print_booking" href="{{ route('email.booking',$booking->id) }}" class="btn btn-dark">Email</a>
                                            </td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
    <script>
        $('#cancel_booking').click(function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            if(confirm('Are you sure want to cancel your booking! it can not be undone later!')){
                window.location.href=href;
            }
        });
    </script>
@endsection

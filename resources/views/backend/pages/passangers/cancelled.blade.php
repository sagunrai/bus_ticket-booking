@extends('backend.layout.master')
@section('title', 'All Users')
@section('main-content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                                        <td>Cancelled On</td>
                                        <td>Refund</td>
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
                                                        $bus = $booking->busnameforpasger;
                                                        $bustype = $bus ? $bus->bustypename : null;
                                                        if($bustype)
                                                            $names = json_decode($bustype->seat_names, true);
                                                        else
                                                            $names = [];

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
                                                <td>{{ \carbon\Carbon::parse($booking->cancelled_time)->format('Y-m-d h:i a') }}</td>
                                                <td>
                                                    @if ($booking->refund)

                                                        <span class="badge badge-info">{{ \carbon\Carbon::parse($booking->refund_time)->format('Y-m-d h:i a') }}</span>
                                                    @else
                                                        <a class="btn btn-info btn-sm" href="{{ route('user.booking.refund',$booking->id) }}" role="button">No</a>
                                                    @endif
                                                </td>
                                                <td><span class="badge badge-{{ ($booking->status == 'cancelled' ? 'danger' : '') . ($booking->status == 'inactive' ? 'info' : '') . ($booking->status == 'active' ? 'success' : '') }}">{{ $booking->status }}</span></td>
                                                <td>
                                                    <div class="dropdown open">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="drop_triger{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                    Action
                                                                </button>
                                                        <div class="dropdown-menu" aria-labelledby="drop_triger{{ $loop->index }}">
                                                            <a class="dropdown-item" target="_blank" href="{{ route('user.booking.show',$booking->id) }}">View Ticket</a>
                                                            <a class="dropdown-item" href="{{ route('user.booking.email',$booking->id) }}">Email Ticket</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

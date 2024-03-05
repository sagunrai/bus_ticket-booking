@extends('frontend.layouts.hf')
@section('style')
    <style>
        .sn-card-cp{
            background-color: #ffffff;
            box-shadow: 0 2px 6px #adadad;
            padding: 15px;
            border-radius: 10px;
            margin:
        }
    </style>
@endsection
@section('content')

<div class="container">



    <div class="row">
        <div class="col-12">
            <div class="sn-card-cp">

                <p class="m-0">
                    <a href="{{ route('my.bookings.list') }}" class="btn btn-primary text-light btn-block ">
                        My Bookings <i class="fa fa-list" aria-hidden="true"></i>
                    </a>
                </p>
            </div>
        </div>
        <div class="col-12">
            <div class="sn-card-cp">

                <p class="m-0">
                    <a class="btn btn-primary text-light btn-block "  data-toggle="collapse" data-target="#emailTicket" aria-expanded="false"
                            aria-controls="emailTicket">
                        Email Ticket <i class="fas fa-angle-down    "></i>
                    </a>
                </p>
                    @error('email')
                    <div class="alert alert-danger alert-dismissible py-2 fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                    @enderror
                    @error('ticket_number')
                    <div class="alert alert-danger alert-dismissible py-2 fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                    @enderror
                <div class="collapse" id="emailTicket">
                    <form action="{{ route('post.email.booking') }}" method="post" class="d-flex pt-3">
                        @csrf
                        <input type="text" name="ticket_number" class="form-control" placeholder="Ticket Number">
                        <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email">
                        <button type="submit" class="btn btn-dark ">Send</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

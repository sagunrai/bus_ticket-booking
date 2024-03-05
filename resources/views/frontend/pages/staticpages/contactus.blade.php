@extends('frontend.layouts.hf')

@section('content')

<div id="tabs" class="project-tab mt-4">
    <div class="container">
        <div class="row">
            <a class="col-12 p-0 black">
            </a>
        </div>
        <div class="row card card-body">
                <div class="accordion" id="accordionExample1">
                    <div class="">
                        <div class="" id="collapseExample">

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('front.feedback.store') }}" method="post" class="sn-contact-form mx-auto">
                                        @csrf

                                        <div class="col-12 popularop">
                                            <h1>Complaint / Suggestion</h1>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" aria-describedby="helpId">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="comment">Comment</label>
                                                    <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Your Comment"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-danger btn-sm btn-block">Submit Comment</button>
                                    </form>
                                </div>
                                {{-- <div class="col-md-4">
                                    <b>24/7 Customer service:</b> <br />
                                    Phone: +977-9828102545<br />
                                    E-mail: <a href="mailto:help@eastbus.com">help@eastbus.com</a><br />
                                    Whatsapp/Viber: +977-9828102545<br />
                                    <br /><br />
                                    <b>Head Office:</b><br />
                                    eastbus Pvt Ltd, <br />
                                    Kalanki, Kathmandu<br />
                                    Phone: +977-9802700003<br />
                                    Whatsapp/Viber: +977-9802700003<br />
                                    <a href="mailto:eastbus@gmail.com">eastbus@gmail.com</a><br />


                                    <br /><br />
                                    <b>Branch Office Birgunj:</b><br />
                                    Birgunj, link-road<br />
                                    Phone: +977-9828102535<br />
                                    Whatsapp/Viber: +977-9828102535<br />
                                    <a href="mailto:bigunj@eastbus.com">birgunj@eastbus.com</a><br />


                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  </div>
@endsection
{{-- @section('scripts')
<script src="{{ asset('maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js') }}"></script>
@endsection --}}

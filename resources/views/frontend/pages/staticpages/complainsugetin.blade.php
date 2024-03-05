@extends('frontend.layouts.hf')

@section('content')

    <div class="container d-flex">
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

@endsection

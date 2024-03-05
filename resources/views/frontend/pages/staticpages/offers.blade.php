@extends('frontend.layouts.hf')
@section('style')
    <style>
        .sn-card{
            padding: 10px;
            box-shadow: 0 2px 6px rgb(172, 172, 172);
        }
    </style>
@endsection
@section('content')

<div id="tabs" class="project-tab">
    <div class="container">
        <div class="row">
            @foreach ($offers as $offer)
                <div class="col-md-4 col-6">
                    <div class="sn-card">
                        <img src="{{ asset($offer->image) }}" alt="" srcset="" width="100%">
                        <p class="px-3">{{ $offer->text }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
  </div>
@endsection

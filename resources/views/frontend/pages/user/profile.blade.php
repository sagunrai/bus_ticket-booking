@extends('frontend.layouts.hf')

@section('style')

    <style>
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        }
        html,
        body {
        background-color: #fafafa;
        }
        .sidebar-dark{
            display: none;
        }
        .dashboard-wrapper{
            margin-left:0px !important;
        }
        .box-surface {
        margin: 100px 0;
        box-shadow: 0 2px 4px 0 rgb(0 0 0/25%);
        background-color: white;
        }
        .row-padding {
        padding: 20px;
        }
        .pos-center {
        position: relative;
        padding: 40px 0;
        }
        .nisha-wrap input{
        width: 100%;
        padding: 0 15px;
        height: 50px;
        background: #fff;
        border: 1px solid #e5e5e5;
        color: black;
        font-size: 14px;
        line-height: 42px;
        box-shadow: 0 0px 4px 0 rgb(0 0 0 / 15%);
        }

        .card {
            width: 350px;
            background-color: #efefef;
            border: none;
            cursor: pointer;
            transition: all 0.5s
        }

        .image img {
            transition: all 0.5s
        }

        /* .card:hover .image img {
            transform: scale(1.5)
        } */

        .btn {
            height: 170px;
            width: 170px;
        }

        .name {
            font-size: 22px;
            font-weight: bold
        }

        .idd {
            font-size: 14px;
            font-weight: 600
        }

        .idd1 {
            font-size: 12px
        }

        .number {
            font-size: 22px;
            font-weight: bold
        }

        .follow {
            font-size: 12px;
            font-weight: 500;
            color: #444444
        }

        .btn1 {
            height: 40px;
            width: 150px;
            border: none;
            background-color: #000;
            color: #aeaeae;
            font-size: 15px
        }

        .text span {
            font-size: 13px;
            color: #545454;
            font-weight: 500
        }

        .icons i {
            font-size: 19px
        }

        hr .new1 {
            border: 1px solid
        }

        .join {
            font-size: 14px;
            color: #a0a0a0;
            font-weight: bold
        }

        .date {
            background-color: #ccc
        }
    </style>

@endsection

@section('content')


<div class="container">
    @error('name')
    <div class="alert alert-danger" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
    @error('email')
    <div class="alert alert-danger" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
    @error('image')
    <div class="alert alert-danger" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <div class="box-surface">

            <div class="d-flex mt-2 text-center"> <button class="btn1 btn-dark">Profile - Information</button> </div>
      <div class="row row-padding">
        <div class="col-md-5 col-12 text-center pos-center p-0" style="background-color:#dce0e3"><div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
                <div class="card p-4">
                    <div class=" image d-flex flex-column justify-content-center align-items-center"> <button class="btn btn-secondary"> <img src="{{ asset($profile->image) }}" height="140" width="140" /></button> <span class="name mt-3">{{ $profile->name }}</span> <span class="idd">{{ $profile->email }}</span>
                        <div class="d-flex flex-row justify-content-center align-items-center gap-2"> <span class="idd1">{{ $profile->phone }}</span> <span></span> </div>
                        <!--<div class="d-flex flex-row justify-content-center align-items-center mt-3"> <span class="number">1069 <span class="follow">Followers</span></span> </div>-->
                        {{-- <div class=" d-flex mt-2"> <button class="btn1 btn-dark">Available</button> </div> --}}
                        <!--<div class="text mt-3"> <span>Eleanor Pena is a creator of minimalistic x bold graphics and digital artwork.<br><br> Artist/ Creative Director by Day #NFT minting@ with FND night. </span> </div>-->
                        <!--<div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> <span><i class="fa fa-twitter"></i></span> <span><i class="fa fa-facebook-f"></i></span> <span><i class="fa fa-instagram"></i></span> <span><i class="fa fa-linkedin"></i></span> </div>-->
                        <div class=" px-2 rounded mt-4 date "> <span class="join">Joined {{ $profile->created_at }}</span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-12">
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="row p-2">
                <div row="col-md-12 mx-auto" style="width: 100%;">
                  <div class="form-group nisha-wrap">
                    <input type="text" class="form-control" name="name" value="{{ $profile->name }}" placeholder="Name">
                  </div>
                </div>
                <div row="col-md-12 mx-auto" style="width: 100%;">
                    <div class="form-group nisha-wrap">
                      <input type="email" class="form-control" name="email" value="{{ $profile->email }}" placeholder="Email">
                    </div>
                  </div>
                  <div row="col-md-12 mx-auto" style="width: 100%;">
                      <div class="form-group nisha-wrap">
                        <input type="text" class="form-control" name="phone" value="{{ $profile->phone }}" placeholder="Phone">
                      </div>
                    </div>
                    <div row="col-md-12 mx-auto" style="width: 100%;">
                      <div class="form-group nisha-wrap">
                        <input type="file" class="form-control" name="image" value="{{ $profile->image }}">
                      </div>
                    </div>
                    <div row="col-md-12 mx-auto" style="width: 100%;">
                      <div class="form-group nisha-wrap">
                        <select class="form-control" name="gender">
                            <option value="male" {{ $profile->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $profile->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                      </div>
                    </div>
              </div>
              <button type="submit" class="btn btn-primary" style="height:50px!important;"> Update </button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

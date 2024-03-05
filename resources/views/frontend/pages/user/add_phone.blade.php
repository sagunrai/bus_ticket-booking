@extends('frontend.layouts.hf')


@section('content')
<div class="alert_container" id="alert_container">
</div>

    <div class="container py-4">
        <div class="jumbotron mb-0">
            <p class="lead"> Add Phone Number</p>
            <hr class="mb-4">
            <div class="row">
                <form action="" method="post" class="row">
                    <div class="form-group">
                        <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                        <input type="text"class="form-control" name="phone_number" id="phone_number" aria-describedby="helpId" placeholder="Enter your phone">
                        <button type="button" class="btn btn-success" id="resend_code" >Add Phone</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#resend_code').click(function (e) {
            e.preventDefault();
            var phone_number = $('#phone_number').val();
            $.ajax({
                type: "post",
                url: "{{ route('user.phone.add') }}",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'phone' : phone_number,
                },
                dataType: "json",
                success: function (response) {
                    if(response.status){
                        var output = ' <div class="alert alert-success alert-dismissible jx-alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Success</strong> : '+ response.message +' </div> ';
                        $('#alert_container').append(output);
                        $('.jx-alert-error').fadeOut(5000);
                        window.location.reload(true);
                    }else{
                        var output = ' <div class="alert alert-success alert-dismissible jx-alert-error"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Error</strong> : '+ response.message +' </div> ';
                        $('#alert_container').append(output);
                        $('.jx-alert-error').fadeOut(5000);
                    }
                }
            });
        });
    </script>
@endsection

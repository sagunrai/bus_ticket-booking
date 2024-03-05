@extends('frontend.layouts.hf')


@section('content')
<div class="alert_container" id="alert_container">
</div>

    <div class="container py-4">
        <div class="jumbotron mb-0">
            <p class="lead"> Vefiry Phone Number</p>
            <hr class="mb-4">
            <div class="row">
                <form action="" method="post" class="row">
                    <div class="form-group">
                    <label for="">Code Sent From eastbus <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control" name="" id="p_code" aria-describedby="helpId" placeholder="Enter 5 digit code sent on your phone">
                    <small id="helpId" class="form-text my-2 text-muted">Wait 2 minute before resend. <a class="btn btn-dark btn-sm py-0" href="javascript:void(0);" id="resend_code" role="button"> <i class="fas fa-redo    "></i> Resend</a></small>

                    <button class="btn btn-success" id="verify_code" type="button">Vefiry</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $('#verify_code').click(function (e) {
        e.preventDefault();
        var p_code = $('#p_code').val();
        $.ajax({
            type: "post",
            url: "{{ route('user.phone.verify') }}",
            data: {
                '_token' : '{{ csrf_token() }}',
                'code' : p_code,
            },
            dataType: "json",
            success: function (response) {
                if(response.status){
                    var output = ' <div class="alert alert-success alert-dismissible jx-alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Success</strong> : '+ response.message +' </div> ';
                    $('#alert_container').append(output);
                    $('.jx-alert').fadeOut(5000);

                    window.location.href = '{{ route('homepage') }}';
                }else{
                    var output = ' <div class="alert alert-success alert-dismissible jx-alert-error"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Error</strong> : '+ response.message +' </div> ';
                    $('#alert_container').append(output);
                    $('.jx-alert-error').fadeOut(5000);
                }
            }
        });
    });
</script>
<script>
    $('#resend_code').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{ route('user.phone.verification.send') }}",
            data: {
                '_token' : '{{ csrf_token() }}'
            },
            dataType: "json",
            success: function (response) {
                if(response.status){
                    var output = ' <div class="alert alert-success alert-dismissible jx-alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Success</strong> : '+ response.message +' </div> ';
                    $('#alert_container').append(output);
                    $('.jx-alert').fadeOut(5000);
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

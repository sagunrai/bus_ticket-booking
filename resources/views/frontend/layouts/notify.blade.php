
<style>
    .alert_container{
        width: 300px;
        position: fixed;
        right: 25px;
        top: 20px;
        z-index: 99999999;
    }
    #alert_box{
        background-color: rgb(20, 154, 67);
        color:#fff;
    }
    #alert_box_sec{
        z-index: 99999999;
        background-color: rgb(154, 20, 20);
        color:#fff;
    }
    .jx-alert-error{
        z-index: 99999999;
        background-color: rgb(154, 20, 20);
        color:#fff;
    }.d_none{
        display: none;
    }
</style>

<div class="alert_container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" id="alert_box">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{session('success')}}
        </div>
    @endif
    @if(session('status'))
        <div class="alert alert-success alert-dismissible" id="alert_box">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{session('status')}}
        </div>
    @endif


    @if(session('error'))
        <div class="alert alert-success alert-dismissible" id="alert_box_sec">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error</strong> : {{session('error')}}
        </div>
    @endif
</div>

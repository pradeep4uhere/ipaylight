@extends('Admin.layouts.Admin.dashboard')
@section('content')
<!--Show Message Start Here-->
@if ($errors->any())
    <div class="alert alert-danger">
        <div>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
</div>
    </div>
@endif

<!--Show Message Ends Here-->
<?php if($userProfile->role == 'retailer'){ ?>
@include('Retailer.Profile.ProfileHeaderSummery')
<?php  }elseif ($userProfile->role == 'distributor') {?>
    @include('Distributor.Profile.ProfileHeaderSummery')
<?php }else{ ?>
<?php } ?>

<!--begin::details View-->
@include('Admin.Retailer.' .$element)
<!--end::details View-->
@endsection
                        
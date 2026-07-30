@extends('Distributor.layouts.Distributor.dashboard')
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
<!--begin::Navbar-->
@include('SuperDistributor.Profile.ProfileHeader')
<!--end::Navbar-->

<!--begin::details View-->
@include('SuperDistributor.Profile.' .$element)
<!--end::details View-->
@endsection
                        
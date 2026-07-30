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
<!--begin::Navbar-->
@include('Admin.Profile.ProfileHeader')
<!--end::Navbar-->

<!--begin::details View-->
@include('Admin.Profile.' .$element)
<!--end::details View-->
@endsection
                        
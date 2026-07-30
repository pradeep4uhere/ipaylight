@extends(getAuthRoleLayout())
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
<!--begin::Navbar-->
@if(isSuperDistributor())
@include('SuperDistributor.Profile.ProfileHeader',['userProfile'=>$userProfile])
@else
@include('Customer.Profile.ProfileHeader',['userProfile'=>$userProfile])
@endif
<!--end::Navbar-->
<!--begin::details View-->
@include($elements)
<!--end::details View-->
<!--begin::Row-->
<!--end::Row-->
@endsection
                        
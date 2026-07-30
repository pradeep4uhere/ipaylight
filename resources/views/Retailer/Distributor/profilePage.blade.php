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
@include('Retailer.Profile.ProfileHeaderSummery')
<!--end::Navbar-->
<!--begin::details View-->
<!--begin::Row-->
<div id="loaderDiv">
@include($element)
</div>
<!--end::details View-->
<!--begin::Row-->
<!--end::Post-->
@endsection
                        
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


<div class="row g-5 g-xl-10">
<!--begin::Col-->
<div class="col-xl-4">
    @include('Customer.Announcement.leftSide')
</div>
<div class="col-xl-8">
@include('Customer.Announcement.'.$element)
</div>
</div>
@endsection
                        
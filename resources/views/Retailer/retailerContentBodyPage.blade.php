@extends('Retailer.layouts.dashboard')
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
<div id="loaderDiv">
@include($element)
</div>
@endsection
                        
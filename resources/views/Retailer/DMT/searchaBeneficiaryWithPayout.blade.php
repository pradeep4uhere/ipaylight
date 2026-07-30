@extends('Retailer.layouts.payout_listing')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="bodyContent">
    <div class="alert alert-danger" style="display:none" id="errorMessage"></div>
    @include('Retailer.DMT.contact_search_view_with_payout',['data'=>$data])
</div>
	

@endsection
                        
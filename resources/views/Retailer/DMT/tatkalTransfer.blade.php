@extends('Retailer.layouts.dmt_listing')
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
    @include('Retailer.DMT.contact_search_view',['data'=>$data])
</div>
	

@endsection
                        
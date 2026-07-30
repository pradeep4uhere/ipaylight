@extends('layouts.guestUser')
@section('content')
<!--begin::Wrapper-->
<style>
.shadow{
	
box-shadow: -3px 22px 46px -23px rgba(0,0,0,0.75)!important;
-webkit-box-shadow: -3px 22px 46px -23px rgba(0,0,0,0.75) !important;
-moz-box-shadow: -3px 22px 46px -23px rgba(0,0,0,0.75)!important;
}
</style>

<div class="row gy-0 mb-6 mb-xl-12">

<div class="card mb-12">
	<!--begin::Hero body-->
	<div class="card-body flex-column p-5">
		<!--begin::Hero content-->
		<div class="d-flex align-items-center h-lg-300px p-5 p-lg-15">
			<!--begin::Wrapper-->
			<div class="d-flex flex-column align-items-start justift-content-center flex-equal me-5">
				<!--begin::Title-->
				<h1 class="fw-bolder fs-4 fs-lg-1 text-gray-800 mb-5 mb-lg-10">We Help You With FAQs?</h1>
				<!--end::Title-->
			
			</div>
			<!--end::Wrapper-->
			<!--begin::Wrapper-->
			<div class="flex-equal d-flex justify-content-center align-items-end ms-5">
				<!--begin::Illustration-->
				<img src="assets/media/illustrations/sketchy-1/20.png" alt="" class="mw-100 mh-125px mh-lg-275px mb-lg-n12">
				<!--end::Illustration-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Hero content-->
		<!--begin::Hero nav-->
		<div class="card-rounded bg-light d-flex flex-stack flex-wrap p-5">
			<!--begin::Nav-->
			<ul class="nav flex-wrap border-transparent fw-bolder">
			    <li class="nav-item my-1 bg-light-primary me-2">
					<a class="btn btn-color-gray-600 btn-active-white btn-active-color-primary fw-boldest fs-8 fs-lg-base nav-link px-3 px-lg-8 mx-1 text-uppercase" href="{{route('page.help')}}">All</a>
				</li>
				@foreach($mastercategories as $k=>$v)
				<!--begin::Nav item-->
				<li class="nav-item my-1 bg-light-primary me-2">
					<a class="btn btn-color-gray-600 btn-active-white btn-active-color-primary fw-boldest fs-8 fs-lg-base nav-link px-3 px-lg-8 mx-1 text-uppercase" href="{{route('page.helpwithcat',['category'=>$k])}}">{{$k}}</a>
				</li>
				@endforeach
				<!--end::Nav item-->
			</ul>
			<!--end::Nav-->
		</div>
		<!--end::Hero nav-->
	</div>
	<!--end::Hero body-->
</div>
<!--begin::Post-->
<div class="row gy-0 mb-6 mb-xl-12">
@foreach($categories as $k=>$itemArr)
@foreach($itemArr as $kk=>$subCategoryArr)
<div class="col-md-6 mb-5">
<div class="card card-md-stretch me-xl-3 mb-md-0 mb-6">
	<!--begin::Body-->
	<div class="card-body p-10 p-lg-15">
		<!--begin::Header-->
		<div class="d-flex flex-stack mb-7">
			<!--begin::Title-->
			<h1 class="fw-bolder text-gray-800 fs-5">{{$kk}}</h1>
			<!--end::Title-->
			<!--begin::Section-->
			<div class="d-flex align-items-center">
				<!--begin::Link-->
				<a href="#" class="text-primary fw-bold me-1 fs-6">{{$k}}</a>
				<!--begin::Link-->
				<!--begin::Arrow-->
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
				<span class="svg-icon svg-icon-2 svg-icon-primary">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
						<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
					</svg>
				</span>
				<!--end::Svg Icon-->
				<!--end::Arrow-->
			</div>
			<!--end::Section-->
		</div>
		<!--end::Header-->
		<!--begin::Accordion-->
		<!--begin::Section-->
		@foreach($subCategoryArr as $kkk=>$item)
		<div class="m-0">
			<!--begin::Heading-->
			<div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_support_{{$k}}_{{$kk}}_{{$kkk}}">
				<!--begin::Icon-->
				<div class="ms-n1 me-5">
				   <span class="svg-icon toggle-on svg-icon-primary svg-icon-2">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
						</svg>
					</span>
					<!--end::Svg Icon-->
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
					<span class="svg-icon toggle-off svg-icon-2">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"></path>
						</svg>
					</span>
					<!--end::Svg Icon-->
				</div>
				<!--end::Icon-->
				<!--begin::Section-->
				
				<div class="d-flex align-items-center flex-wrap">
					<!--begin::Title-->
					
					<h3 class="text-gray-800 fw-bold cursor-pointer me-3 mb-0 fs-6">{{$item['title']}}</h3>
					<!--end::Title-->
					
				</div>
				<!--end::Section-->
			</div>
			<!--end::Heading-->
			<!--begin::Body-->
			<div id="kt_support_{{$k}}_{{$kk}}_{{$kkk}}" class="collapse  fs-6 ms-10">
			
				<!--begin::Block-->
				<div class="mb-4">
					@if($item['banner']!='')
					<div class="mb-5 mt-5 border border-dashed shadow" style="">
						<?php $imagePath = asset('storage/faq/'.$item['banner']); ?>
						 <img src="{{$imagePath}}" alt="image" style="width: 100%"/>
					</div>
					@endif
					<!--begin::Text-->
					<span class="text-muted fw-bold fs-7">{!!$item['content']!!}</span>
					<!--end::Text-->
				</div>
				<!--end::Block-->
				
			</div>
			<!--end::Content-->
		</div>
		@endforeach
		<!--end::Body-->
		<!--end::Accordion-->
	</div>
	<!--end::Body-->
</div>
</div>
@endforeach
@endforeach
</div>
@endsection
                        
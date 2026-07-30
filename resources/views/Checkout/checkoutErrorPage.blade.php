@extends('layouts.default')
@section('content')
<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="{{env('APP_URL')}}" class="mb-12">
                    <img alt="Logo" src="logo.svg" class="h-50px" />
					</a>
					<!--end::Logo-->
                    
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                       <img src="assets/media/something_went_wrong.webp" alt="" class="me-3 rounded-1" height="420px">
                         <a href="/checkout/{{$checkoutDetails['link_text']}}"  class="btn btn-lg btn-primary w-100 mb-5">Return to Initiate Payment</a>
                    </div>
                </div>
            </div>
</div>

@endsection
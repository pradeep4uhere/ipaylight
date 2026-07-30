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
                         <button id="rzp-button1" class="btn btn-lg btn-primary w-100 mb-5">Make Payment&nbsp;{{$checkoutDetails['order_details']['amount']/100}}</button>
                    </div>
                </div>
            </div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "{{$checkoutDetails['key_id']}}", // Enter the Key ID generated from the Dashboard
    "amount": "{{$checkoutDetails['order_details']['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "{{env('APP_NAME')}}",
    "description": "{{$checkoutDetails['description']}}",
    "image": "{{$checkoutDetails['image']}}",
    "order_id": "{{$checkoutDetails['order_details']['id']}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "callback_url": "{{$checkoutDetails['callback_url']}}?ltid={{encryptString($checkoutDetails['last_transaction_id'])}}&uid={{encryptString($checkoutDetails['user_id'])}}&gateway=Razorpay",
    "prefill": {
        "name": "{{$checkoutDetails['customer_name']}}",
        "email": "{{$checkoutDetails['customer_email']}}",
        "contact": "{{$checkoutDetails['customer_mobile']}}"
    },
    "notes": {
        "user_id": "{{$checkoutDetails['user_id']}}",
        "link_text": "{{$checkoutDetails['link_text']}}",
        "gateway_id": "{{$checkoutDetails['gateway_id']}}",
    
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
@endsection
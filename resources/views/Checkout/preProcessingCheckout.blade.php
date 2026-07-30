@extends('layouts.default')
@section('content')
@include('Checkout.orderConfirmationElement')
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
document.getElementById('make_payment_button').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
@endsection
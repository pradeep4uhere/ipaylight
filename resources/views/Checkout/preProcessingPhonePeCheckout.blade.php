@extends('layouts.default')
@section('content')
@include('Checkout.orderConfirmationElement')
<?php $url = $checkoutDetails['order_details']['data']['instrumentResponse']['redirectInfo']['url']; ?>
<script>
document.getElementById('make_payment_button').onclick = function(e){
    e.preventDefault();
    var url= "{{$url}}";
    window.location = url;
}
</script>]
@endsection
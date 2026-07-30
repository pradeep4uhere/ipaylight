@extends('layouts.default')
@section('content')
@include('Checkout.orderConfirmationElement')
<?php 
if($checkoutDetails['order_details']['status']=='SUCCESS'){
    if($checkoutDetails['order_details']['order_staus']=='ACTIVE'){
        $url = $checkoutDetails['order_details']['paymentLink']; 
    }else{
        $url = "";
    }
}else{
    $url = "";
}
?>
<script>
document.getElementById('make_payment_button').onclick = function(e){
    e.preventDefault();
    var url= "{{$url}}";
    window.location = url;
}
</script>]
@endsection
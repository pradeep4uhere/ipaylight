@extends('layouts.default')
@section('content')
@include('Checkout.orderConfirmationElement')
<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
<script>
      const cashfree = Cashfree({
        mode: "{{$checkoutDetails['payment_mode']}}" //or production
      });
      document.getElementById("make_payment_button").addEventListener("click", () => {
        cashfree.checkout({
          paymentSessionId: "{{$checkoutDetails['order_details']['payment_session_id']}}"
        });
      });
</script>
@endsection
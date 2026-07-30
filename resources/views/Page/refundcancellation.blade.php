
@extends('layouts.Frontend.default')
@section('content')
<!-- Start Navbar Area -->
@include('elements.Frontend.frontend_header')
<!-- End Navbar Area -->
<!-- End Navbar Area -->
<div class="page-title-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <h2>{{$pagetitle}}</h2>
            </div>
        </div>
    </div>
    <div class="shape1"><img src="frontend/assets/img/shape1.png" alt="shape"></div>
    <div class="shape2 rotateme"><img src="frontend/assets/img/shape2.svg" alt="shape"></div>
    <div class="shape3"><img src="frontend/assets/img/shape3.svg" alt="shape"></div>
    <div class="shape4"><img src="frontend/assets/img/shape4.svg" alt="shape"></div>
    <div class="shape5"><img src="frontend/assets/img/shape5.png" alt="shape"></div>
    <div class="shape6 rotateme"><img src="frontend/assets/img/shape4.svg" alt="shape"></div>
    <div class="shape7"><img src="frontend/assets/img/shape4.svg" alt="shape"></div>
    <div class="shape8 rotateme"><img src="frontend/assets/img/shape2.svg" alt="shape"></div>
</div>
<div class="terms-conditions-area ptb-80">
            <div class="container">
                <div class="terms-conditions-content">
                    <h4>Service Delivery</h4>
                    <P>Customer Service must be contacted within 30 days of transaction date.</P>
                    <p>Upon completion of payment, the guest/wallet user will within a few hours, receive a confirmation email with a transaction ID number and Payment Details by email/SMS or can access it by logging into the personal portal, that is valid for utilisation for service PLEASE DO MAKE A NOTE OF THE TRANSACTION ID PROVIDED BY THE PAYMENT GATEWAY BEFORE PROCEEDING WITH THE PAYMENTS</p>
                    <h4>Refund Policy</h4>
                    <p>All sales/services are final and there will be no refund or exchange permitted. Please be advised that You are responsible for the purchase and all charges that result from those purchases. However, in a case where a transaction has been completed by you on the Site, and money has been charged to your card or bank account but has not delivered within 15 days of your completion of the transaction then you may inform us by sending us an email on info@xsilica.com or post us a message on the contact us page. In such a scenario you will be entitled to a full refund. We request you to include in the email the following details -Transaction date and Order Number. PayG shall investigate the incident and if it is found that money was indeed charged to your card or bank account without delivery then you will be refunded the money within 7 working days from the date of the receipt of your email.</p>
                    <h4>Dispute and resolution policy</h4>
                    <p>In case of any dispute Customer/Merchant can reach to Help Desk over the mail with the details. PayG will try to provide an amicable solution to both the parties subject to dispute. PayG Decision will be final in case of any Dispute.</p>
                    <h4>Cancellation policy</h4>
                    <p>Each Merchant/service provider has its own refund and cancellation policy, as a result of which we adhere to the same. Also, refunds will be done only through the Original Mode of Payment.</p>
                    <h4>Refund Policy and process</h4>
                    <p>The reservations which are applicable for refund as per the cancellation policy specified in each booking will be entitled for refund (if applicable) and will be refunded within 15 working days from the date of cancellation request after the deduction of payment gateway processing charges.</p>
                    <p>Last updated: June 6th, 2024 at 3:00 pm</p>
                </div>
            </div>
        </div>
@endsection
                
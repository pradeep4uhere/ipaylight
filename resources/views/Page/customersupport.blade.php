
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
<div class="ml-services-area ptb-80 ptb-80">
            <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 text-section wow animate__animated animate__fadeInUp " data-wow-delay="0.5s">
                    <img src="frontend/assets/img/customer_support.svg"/>
                </div>
                <div class="col-lg-8 col-md-12 text-section ">
                    <div class="terms-conditions-content">
                        <h4>Customer Support</h4>
                        <P>Exceptional Customer Support: Your Satisfaction, Our Priority. Reach out for assistance, information, and solutions tailored to your needs.</P>
                        <p>At Paygenius, we pride ourselves on delivering exceptional customer support services from 9 AM to 6 PM, ensuring your financial needs are addressed promptly and efficiently. Our knowledgeable and friendly support team is equipped to assist with a wide range of inquiries, from service-related questions and transaction assistance to account information and other concerns. Understanding the value of your time, we are dedicated to providing the highest level of assistance during these hours. Contact us to experience seamless and professional support, and let us help you navigate your financial journey with confidence and ease.</p>
                        <p>For any support please contact us –</p>
                        <p>Call us at - +91 9142562743 (Mon. to Sat. between 09:00 am to 08:00 pm. IST)</p>
                        <p>Write us at- helpdesk@paygenius.in</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
                
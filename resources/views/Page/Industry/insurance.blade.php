
@extends('layouts.default')
@section('content')
<!-- Start Navbar Area -->
@include('elements.header')
<style>
.page-title-area {
    position: relative;
    z-index: 1;
    background: transparent url(../../assets/img/banner-bg1.jpg) right top no-repeat;
    padding-top: 102px;
    padding-bottom: 125px;
    text-align: center;
}
</style>
<!-- End Navbar Area -->
<div class="page-title-area" >
    <div class="d-table"  style="background-color:#ff1614; color:#FFF">
        <div class="d-table-cell" >
            <div class="container" >
            <div class="row h-100 justify-content-center align-items-center">
				<div class="col-lg-8">
                    <h2 style="color:#FFF">Efficient Payment Solutions in the Insurance Industry</h2>
                    <p style="color:#FFF">Insurance companies often use payment gateways as a critical component of their operations to facilitate premium collections, claim settlements, and other financial transactions.</p>
                    <a href="#" class="btn btn-danger">Get Started</a>
                </div>
                <div class="col-lg-4">
                <img src="frontend/assets/img/insurance.svg" alt="shape" height="400px">
                </div>
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
<div class="terms-conditions-area ptb-0">


            <div class="ml-services-area ptb-80">
			
			<div class="container">
			<div class="section-title">
					<h2>Features that make Paygenius Stand out</h2>
					<div class="bar"></div>
					<p>Here's How Payment Gateways Are Used In The Education Industry</p>
				</div>
				
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/analytics.svg" alt="image" height="200px">
                            </div>
                            <h3><a href="single-services.html">Security You Can Trust</a></h3>
                            <p>Your customers' data is precious, and we treat it as such. Paygenius is committed to the highest levels of security and compliance with industry standards, including PCI DSS.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/lowfee.svg" alt="image" height="229px">
                            </div>
                            <h3><a href="single-services.html">Low Transaction Fee</a></h3>
                            <p>Experience cost-effective transactions with Paygenius's low fees, maximizing your profits and streamlining your payment processes effortlessly.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/multiple.svg" alt="image" height="229px">>
                            </div>
                            <h3><a href="#">Global Reach, Local Expertise</a></h3>
                            <p>With Paygenius, you can expand your horizons. We support multiple currencies and payment methods, making it easy to cater to customers worldwide.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/processing.svg" alt="image" height="229px">
                            </div>
                            <h3><a href="#">Seamless Payment Processing</a></h3>
                            <p>In today's digital world, customers expect to be able to make payments quickly and securely. It is essential for any online business that wants to succeed.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/quick.svg" alt="image" height="229px">
                            </div>
                            <h3><a href="#">Quick Settlement and Payouts </a></h3>
                            <p>Paygenius, the best payment service provider in India, offers multiple payment methods to give your customers the flexibility to pay the way they want to.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/ecommerce_store.svg" alt="image" height="229px">
                            </div>
                            <h3><a href="single-services.html">Multiple Payment Options</a></h3>
                            <p>Paygenius provides a user-friendly and efficient payment processing system to Customers, enabling businesses to accept payments securely and smoothly.</p>
                        </div>
                    </div>
                </div>
			</div>

			<div class="shape1"><img src="frontend/assets/img/shape1.png" alt="shape"></div>
			<div class="shape2 rotateme"><img src="frontend/assets/img/shape2.svg" alt="shape"></div>
			<div class="shape3"><img src="frontend/assets/img/shape3.svg" alt="shape"></div>
			<div class="shape4"><img src="frontend/assets/img/shape4.svg" alt="shape"></div>
			<div class="shape6 rotateme"><img src="frontend/assets/img/shape4.svg" alt="shape"></div>
			<div class="shape7"><img src="frontend/assets/img/shape4.svg" alt="shape"></div>
			<div class="shape8 rotateme"><img src="frontend/assets/img/shape2.svg" alt="shape"></div>
		</div>

            
        </div>
      

        	<!-- Start Ready To Talk Area -->
            @include('Page.bottomBanner')

		<!-- End Ready To Talk Area -->
@endsection
                
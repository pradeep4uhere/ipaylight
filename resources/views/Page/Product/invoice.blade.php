
@extends('layouts.Frontend.default')
@section('content')
<!-- Start Navbar Area -->
@include('elements.Frontend.frontend_header')
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

<div class="services-details-area ptb-80">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 services-details">
                        <div class="agency-about-content">
							<h3>Invoice Payment</h3>
                            <div class="bar"></div>
							<p>Welcome to Paygenius Payment Solutions Pvt Ltd's Invoice solution. Our Invoice solutions feature is designed to streamline your invoicing process and make it easy for your customers to pay their invoices securely and conveniently.</p>
						</div>
					</div>

					<div class="col-lg-6 services-details-image">
						<img src="frontend/assets/img/invoice.jpeg" class="wow animate__ animate__fadeInUp animated" alt="image" style="visibility: visible; animation-name: fadeInUp;">
					</div>
				</div>
			</div>
		</div>
			<div class="shape2 rotateme"><img src="frontend/assets/img/shape2.svg" alt="shape"></div>
			<div class="shape3"><img src="frontend/assets/img/shape3.svg" alt="shape"></div>
			<div class="shape6 rotateme"><img src="frontend/assets/img/shape4.svg" alt="shape"></div>
			<div class="shape7"><img src="frontend/assets/img/shape4.svg" alt="shape"></div>
            <div class="shape8 rotateme"><img src="frontend/assets/img/shape2.svg" alt="shape"></div>
		</div>


        <div class="services-area-two ptb-80 bg-f9f6f6">
    <div class="container">
        <div class="bg-dedede about-inner-area">
        <div class="container ">
            <div class="row">
            <div class="col-lg-12 col-md-12 text-section ">
                <h3>Key Features of Our Invoice Payment</h3>
                <div class="bar"></div>
                <div class="about-text">
                    <p>Paygenius Payment Solutions Pvt Ltd is a pioneering leader in the invoice automated processing, dedicated to transforming the way businesses handle transactions. With a deep understanding of the unique challenges faced by modern businesses, we offer innovative  solutions tailored to meet the needs of e-commerce platforms, shopping carts, ERP and CRM systems, and more.</p>
                </div>
                <div>
                <div class="col-lg-12 col-md-6 col-sm-6">
					
                    <ul>
                    <li><p>Customizable Invoices: Create and customize professional-looking invoices with your branding, logo, and payment details.</p></li>
                    <li><p>Automated Invoicing: Set up recurring invoices and automate the invoicing process, saving you time and effort.</p></li>
                    <li><p>Multiple Payment Options: Accept payments through various methods, including credit/debit cards, bank transfers, digital wallets, and more.</p></li>
                    <li><p>Real-Time Tracking: Track the status of your invoices in real-time, with instant notifications when payments are made.</p></li>
                    <li><p>Automatic Payment Reconciliation: Automatically reconcile payments with invoices, reducing manual reconciliation efforts and minimizing errors.</p></li>
                    <li><p>Customizable Payment Terms: Set flexible payment terms and due dates to suit your business needs and accommodate your customers.</p></li>
                    <li><p>Customer Portal: Provide customers with access to a dedicated portal where they can view and manage their invoices and payments.</p></li>
                    <li><p>Integration with Accounting Software: Seamlessly integrate with popular accounting software to streamline your financial management processes.</p></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>


</div>


<div class="services-area-two ptb-80 bg-ffffff">
<div class="blog-area ptb-80">
			<div class="container">
				<div class="section-title">
					<h2>How it Works</h2>
					<div class="bar"></div>
					<p>Log in to the Paygenius dashboard and generate a payment link by entering the required details such as amount, description, and customer information.</p>
				</div>

				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="single-blog-post">
							
							<div class="blog-post-content">
								<h3><a href="single-blog.html">Create Invoice</a></h3>
								<p>Generate and customize invoices with your branding and payment details.</p>
							</div>
						</div>
					</div>
                    <div class="col-lg-3 col-md-6">
						<div class="single-blog-post">

							<div class="blog-post-content">
								<h3><a href="single-blog.html">Send Invoice</a></h3>
								<p>Send the invoice to your customer via email or through your preferred communication channel.</p>
							</div>
						</div>
					</div>
                    <div class="col-lg-3 col-md-6">
						<div class="single-blog-post">

							<div class="blog-post-content">
								<h3><a href="single-blog.html">Customer Pays</a></h3>
								<p>Customers receive the invoice and can make payments securely using the provided payment link or through the customer portal</p>
							</div>
						</div>
					</div>
                    <div class="col-lg-3 col-md-6">
						<div class="single-blog-post">

							<div class="blog-post-content">
								<h3><a href="single-blog.html">Track Payments</a></h3>
								<p>Monitor the status of your invoices in real-time and receive instant notifications when payments are made.</p>
							</div>
						</div>
					</div>

					
					

					
                    
				</div>
			</div>
		</div>
    </div>
	@include('Page.bottomBanner')

@endsection
                
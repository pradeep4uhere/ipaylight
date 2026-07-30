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
							<h3>Payout APIs</h3>
                            <div class="bar"></div>
							<p>At Paygenius Payment Solutions Pvt Ltd, we understand the importance of efficient and reliable payout processes for businesses. Our Payout APIs offer a robust solution for managing and disbursing payments to vendors, employees, and partners, ensuring smooth financial operations and enhanced business efficiency.</p>
						</div>
					</div>

					<div class="col-lg-6 services-details-image">
						<img src="frontend/assets/img/api.png" class="wow animate__ animate__fadeInUp animated" alt="image" style="visibility: visible; animation-name: fadeInUp;">
					</div>
				</div>
			</div>
		</div>


   


<div class="services-area-two ptb-80 bg-f9f6f6">
			<div class="container">
				<div class="section-title">
					<h2>Why Choose Our Payout APIs?</h2>
					<div class="bar"></div>
					<p>Our Payout APIs offer a robust solution for managing and disbursing payments to vendors, employees, and partners, ensuring smooth financial operations and enhanced business efficiency.</p>
				</div>

				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-services-box">
							<div class="icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
							</div>
							<h3><a href="single-project.html">Automated Payouts</a></h3>
							<p>Simplify your payout processes with automated disbursements, reducing manual work and minimizing errors..</p>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-services-box">
							<div class="icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
							</div>

							<h3><a href="#">Multiple Payment Methods</a></h3>
							<p>Our Payout APIs support various payment methods, including bank transfers, digital wallets, and more, providing flexibility to meet different payout needs.</p>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-services-box">
							<div class="icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
							</div>

							<h3><a href="#">Real-Time Processing</a></h3>
							<p>Experience real-time payout processing, ensuring that your recipients receive their funds quickly and efficiently.</p>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-services-box">
							<div class="icon bg-c679e3">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
							</div>

							<h3><a href="#">Secure Transactions</a></h3>
							<p>Our APIs prioritize security, employing advanced encryption and fraud prevention measures to safeguard your payouts.</p>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-services-box">
							<div class="icon bg-c679e3">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
							</div>

							<h3><a href="#">Detailed Reporting</a></h3>
							<p>Access comprehensive reports and analytics on your payout transactions, helping you maintain transparency and make informed financial decisions.</p>
						</div>
					</div>

					

					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-services-box">
							<div class="icon bg-eb6b3d">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
							</div>

							<h3><a href="#">Easy Integration</a></h3>
							<p>Our Payout APIs are designed for seamless integration with your existing systems, ensuring quick and hassle-free implementation.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
@include('Page.bottomBanner')
@endsection
                
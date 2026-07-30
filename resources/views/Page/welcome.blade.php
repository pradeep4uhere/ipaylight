
@extends('layouts.Frontend.welcome')
@section('content')

		<!-- Start Navbar Area -->
		@include('elements.Frontend.frontend_header')
		<!-- End Navbar Area -->
		<div class="bigdata-analytics-banner">
            <div class="container">
                <div class="bigdata-analytics-content" >
                    <h1 class="tlt">Fast and Secure Banking Services</h1>
                    <p data-wow-delay="0.9s" class="wow animate__animated animate__fadeInUp">Fast and secure banking services ensure quick transactions and robust protection, providing customers with reliable and efficient financial solutions.</p>
                    <a href="contact.html" class="btn btn-primary">Get Started</a>
                </div>
            </div>

            <div class="banner-boxes-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-banner-boxes">
								<div class="icon">
									<i class="flaticon-idea"></i>
								</div>
                                <h3>Multiple Payment Option</h3>
                                <p>Our banking services offer multiple secure payment options, including credit and debit cards, to ensure safe and convenient transactions. With advanced security measures and user-friendly interfaces.</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-banner-boxes">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                                </div>
                                <h3>Low Platefrom Fee</h3>
                                <p>Experience cost-effective transactions with Paygenius's low fees. Maximize your profits and streamline your payment processes effortlessly with our affordable and efficient banking services.</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                            <div class="single-banner-boxes">
								<div class="icon">
									<i class="flaticon-software"></i>
								</div>
                                <h3>Verified Retailers</h3>
                                <p>Verified Retailers Assurance ensures you shop with confidence, knowing that all transactions with approved merchants are secure, reliable, and protected, providing peace of mind for your purchases.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		
		@include('Page.slider')

		<div class="ml-services-area ptb-80">
			
			<div class="container">
			<div class="section-title">
					<h2>Features that make Paygenius Stand out</h2>
					<div class="bar"></div>
					<p>Ensuring robust protection against security risks and fraud to safeguard your assets and information.</p>
				</div>
				
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
						
							<div class="image">
                                <img src="frontend/assets/img/analytics.svg" alt="image" height="280px">
                            </div>
                            <h3><a href="single-services.html">Analytics Management</a></h3>
                            <p>Paygenius Analytics Management helps businesses make better decisions by providing valuable insights from payment data, which leads to improved performance and strategic growth.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/lowfee.svg" alt="image">
                            </div>
                            <h3><a href="single-services.html">Low Platform Fee</a></h3>
                            <p>Experience cost-effective payment with Paygenius's low fees, maximizing your profits and streamlining your business increase effortlessly.</p>
                        </div>
                    </div>
<!-- 
                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/e-wallet.svg" alt="image">
                            </div>
                            <h3><a href="#">Manage E Wallet</a></h3>
                            <p>Effortlessly oversee and control E-Wallet transactions with Paygenius's Manage E-Wallet feature, ensuring a streamlined and secure digital payment experience.</p>
                        </div>
                    </div> -->

                    <!-- <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/processing.svg" alt="image">
                            </div>
                            <h3><a href="#">Seamless Payment Processing</a></h3>
                            <p>In today's digital world, customers expect to be able to make payments quickly and securely. It is essential for any online business that wants to succeed.</p>
                        </div>
                    </div> -->

                    <!-- <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/quick.svg" alt="image">
                            </div>
                            <h3><a href="#">Quick Settlement and Payouts </a></h3>
                            <p>Paygenius, the best payment service provider in India, offers multiple payment methods to give your customers the flexibility to pay the way they want to.</p>
                        </div>
                    </div> -->

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/multiple.svg" alt="image">
                            </div>
                            <h3><a href="single-services.html">Multiple Payment Methods</a></h3>
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

		<div class="bigdata-services-area ptb-80 bg-eef6fd">
            <div class="container">
                <div class="section-title">
                    <h2>Services We Can Help You With</h2>
					<div class="bar"></div>
                    <p>Services We Can Help You With include fast and secure banking, multiple payment options, verified retailer assurance, domestic money transfers, Aadhaar-enabled payments, cash management, micro ATMs, gift cards, and bill payments through BBPS.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                        <div class="single-services-box-item">
                            <div class="icon">
                                <img src="assets/img/bigdata-analytics/icon6.png" alt="image">
                            </div>
                            <h3><a href="single-services.html">Domestic Money Transfer</a></h3>
                            <p>Domestic Money Transfer refers to the secure and efficient transfer of funds between individuals or entities within the same country, facilitated by banks, financial institutions, or digital payment platforms. It enables individuals to send money quickly to family, friends.</p>
                            <a href="single-services.html" class="learn-more-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>Learn More</a>
                            <div class="shape"><img src="assets/img/bigdata-analytics/rectangle.png" alt="image"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__fadeInUp" data-wow-delay="0.9s">
                        <div class="single-services-box-item">
                            <div class="icon">
                                <img src="assets/img/bigdata-analytics/icon6.png" alt="image">
                            </div>
                            <h3><a href="single-services.html">Aadhar Enable Payment</a></h3>
                            <p>Aadhaar Enabled Payment System (AEPS) allows secure transactions using your Aadhaar number and biometric authentication, making banking services accessible and convenient for all.</p>
                            <a href="single-services.html" class="learn-more-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>Learn More</a>
                            <div class="shape"><img src="assets/img/bigdata-analytics/rectangle.png" alt="image"></div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__fadeInUp" data-wow-delay="1.5s">
                        <div class="single-services-box-item">
                            <div class="icon">
                                <img src="assets/img/bigdata-analytics/icon6.png" alt="image">
                            </div>
                            <h3><a href="single-services.html">Cash Managment Service</a></h3>
                            <p>Cash Management Service offers efficient handling of cash transactions, optimizing cash flow and enhancing financial control for businesses, ensuring timely deposits and withdrawals with secure processing.</p>
                            <a href="single-services.html" class="learn-more-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>Learn More</a>
                            <div class="shape"><img src="assets/img/bigdata-analytics/rectangle.png" alt="image"></div>
                        </div>
                    </div>
                    
					<div class="col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__fadeInUp" data-wow-delay="2s">
                        <div class="single-services-box-item">
                            <div class="icon">
                                <img src="assets/img/bigdata-analytics/icon6.png" alt="image">
                            </div>
                            <h3><a href="single-services.html">Micro ATM</a></h3>
                            <p>Micro ATMs provide banking services in remote areas, enabling cash withdrawals, deposits, and balance inquiries using a secure and portable device, enhancing financial inclusion for underserved communities.</p>
                            <a href="single-services.html" class="learn-more-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>Learn More</a>
                            <div class="shape"><img src="assets/img/bigdata-analytics/rectangle.png" alt="image"></div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__fadeInUp" data-wow-delay="2.5s">
                        <div class="single-services-box-item">
                            <div class="icon">
                                <img src="assets/img/bigdata-analytics/icon6.png" alt="image">
                            </div>
                            <h3><a href="single-services.html">Gift Card</a></h3>
                            <p>Gift Cards offer a versatile and convenient way to present a monetary gift, allowing recipients to choose their preferred purchases while providing a secure and easy-to-use payment option.</p>
                            <a href="single-services.html" class="learn-more-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>Learn More</a>
                            <div class="shape"><img src="assets/img/bigdata-analytics/rectangle.png" alt="image"></div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__fadeInUp" data-wow-delay="3s">
                        <div class="single-services-box-item">
                            <div class="icon">
                                <img src="assets/img/bigdata-analytics/icon6.png" alt="image">
                            </div>
                            <h3><a href="single-services.html">Bill Payment- BBPS</a></h3>
                            <p>Bill Payment through Bharat Bill Payment System (BBPS) offers a unified and secure platform for paying various bills, providing convenience and reliability for users across multiple service providers.</p>
                            <a href="single-services.html" class="learn-more-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>Learn More</a>
                            <div class="shape"><img src="assets/img/bigdata-analytics/rectangle.png" alt="image"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


		


		<!-- Start Bill Payment Services -->
		@include('Page.BillPayment')
		<!-- End Bill Payment Services -->
		<!-- Start DMT  Services -->
		@include('Page.DMTBanner')
		<!-- End DMT Services -->
		<!-- Start Bill Payment Services -->
		@include('Page.AEPSPayment')
		<!-- End Bill Payment Services -->
		<!-- Start Bill Payment Services -->
		@include('Page.MicroATM')
		<!-- End Bill Payment Services -->
		


		

		<!-- Start Features Area -->
		<div class="features-area ptb-80 bg-f7fafd">
			<div class="container">
				<div class="section-title">
					<h2>Our Features</h2>
					<div class="bar"></div>
					<p>At Paygenius Payment Solution Pvt Ltd, we pride ourselves on offering a comprehensive suite of features designed to meet all your payment processing needs. </p>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInLeft" data-wow-delay="0.9s">
						<div class="single-features">
							<div class="icon">
								<i data-feather="settings"></i>
							</div>

							<h3>Secure Transactions</h3>
							<p>We use advanced encryption and robust security protocols to ensure that all your transactions are protected against fraud and unauthorized access.</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInRight" data-wow-delay="0.9s">
						<div class="single-features">
							<div class="icon">
								<i data-feather="mail"></i>
							</div>

							<h3>Multi Language Support:</h3>
							<p>Our system supports multiple language, allowing you to conduct business globally with ease and efficiency..</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInLeft" data-wow-delay="0.9s">
						<div class="single-features">
							<div class="icon bg-c679e3">
								<i data-feather="grid"></i>
							</div>

							<h3>Seamless Integration</h3>
							<p>Our solutions integrate effortlessly with your existing systems, ensuring a smooth and hassle-free implementation process..</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInRight" data-wow-delay="0.9s">
						<div class="single-features">
							<div class="icon bg-c679e3">
								<i data-feather="info"></i>
							</div>

							<h3>Real-Time Reporting</h3>
							<p>Gain insights into your transactions with our real-time reporting and analytics tools, which help you make informed business decisions.</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInLeft" data-wow-delay="0.9s">
						<div class="single-features">
							<div class="icon bg-eb6b3d">
								<i data-feather="mouse-pointer"></i>
							</div>

							<h3>Automated Payments</h3>
							<p>Our platform offers automation tools for recurring billing and direct debits, reducing manual work and minimizing errors.</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInRight" data-wow-delay="0.9s">
						<div class="single-features">
							<div class="icon bg-eb6b3d">
								<i data-feather="bell"></i>
							</div>

							<h3>24/7 Customer Support</h3>
							<p>Our dedicated support team is available around the clock to assist you with any issues or queries, ensuring uninterrupted service..</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Features Area -->


		<!-- Start Fun Facts Area -->
		<div class="funfacts-area bg-image ptb-80">
			<div class="container">
				<div class="section-title">
					<h2>We always try to understand users expectation</h2>
					<div class="bar"></div>
					<p>we always strive to understand and exceed our users' expectations. We believe that a deep understanding of our customers' needs and goals is the foundation of delivering exceptional payment solutions.</p>
				</div>

				<div class="row">
					<div class="col-lg-3 col-md-3 col-6 col-sm-3">
						<div class="funfact">
							<h3><span class="odometer" data-count="100">00</span>+</h3>
							<p>Client</p>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-6 col-sm-3">
						<div class="funfact">
							<h3><span class="odometer" data-count="200">00</span>+</h3>
							<p>Feedback</p>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-6 col-sm-3">
						<div class="funfact">
							<h3><span class="odometer" data-count="300">00</span>+</h3>
							<p>Retailers</p>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-6 col-sm-3">
						<div class="funfact">
							<h3><span class="odometer" data-count="100">00</span>+</h3>
							<p>Distributors</p>
						</div>
					</div>
				</div>

				

				

				<div class="contact-cta-box">
					<h3>Have any question about us?</h3>
					<p>Don't hesitate to contact us</p>
					<a href="/contactus" class="btn btn-primary">Contact Us</a>
				</div>

			</div>
		</div>
		<!-- End Fun Facts Area -->

		@include('Page.PartnerList')
		<!-- Start Features Area -->
		<div class="ml-services-area  ptb-80">
		<div class="">
			<div class="container">
				<div class="section-title">
					<h2>Agent Dashboard</h2>
					<div class="bar"></div>
					<p>At Paygenius Payment Solution Pvt Ltd, we pride ourselves on offering a comprehensive suite of features designed to meet all your payment processing needs. </p>
				</div>

				<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".95s">
						<div class="single-features">
							<div class="icon">
								<i data-feather="settings"></i>
							</div>

							<h3>Dashboard Reporting ​</h3>
							<p>We use advanced encryption and robust security protocols to ensure that all your transactions are protected against fraud and unauthorized access.</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".95s">
						<div class="single-features">
							<div class="icon">
								<i data-feather="mail"></i>
							</div>

							<h3>Multi Language Support:</h3>
							<p>Our system supports multiple language, allowing you to conduct business globally with ease and efficiency..</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".95s">
						<div class="single-features">
							<div class="icon bg-c679e3">
								<i data-feather="grid"></i>
							</div>

							<h3>Instant Activation</h3>
							<p>Our solutions integrate effortlessly with your existing systems, ensuring a smooth and hassle-free implementation process..</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".95s">
						<div class="single-features">
							<div class="icon bg-c679e3">
								<i data-feather="info"></i>
							</div>

							<h3>Real-Time Reporting</h3>
							<p>Gain insights into your transactions with our real-time reporting and analytics tools, which help you make informed business decisions.</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".95s">
						<div class="single-features">
							<div class="icon bg-eb6b3d">
								<i data-feather="mouse-pointer"></i>
							</div>

							<h3>Real Time Order Track</h3>
							<p>Stay updated with our Real-Time Order Tracking feature, ensuring you always know the status of your purchase. Enjoy peace of mind with live updates from checkout to delivery.</p>
						</div>
					</div>
					
					
					
					<div class="col-lg-6 col-md-6 col-sm-6 wow animate__animated animate__fadeInUp" data-wow-delay=".95s">
						<div class="single-features">
							<div class="icon bg-eb6b3d">
								<i data-feather="bell"></i>
							</div>

							<h3>24/7 Customer Support</h3>
							<p>Our 24/7 Customer Support is here to assist you any time, day or night. Get quick and reliable help whenever you need it.</p>
						</div>
					</div>


				</div>
			</div>
		</div>
		</div>
		<!-- End Features Area -->

		<!-- Start Ready To Talk Area -->
		@include('Page.bottomBanner')
		<!-- End Ready To Talk Area -->

		<!-- Start Partner Area -->
		
		<!-- End Partner Area -->

		<div class="ml-services-area ptb-80">
			
			<div class="container">
			<div class="section-title">
					<h2>Security Risk & Fraud </h2>
					<div class="bar"></div>
					<p>Ensuring robust protection against security risks and fraud to safeguard your assets and information.</p>
				</div>
				
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/services-image/1.png" alt="image">
                            </div>
                            <h3><a href="single-services.html">IT Professionals</a></h3>
                            <p>Empowering IT professionals to mitigate security risks and prevent fraud, ensuring the safety and integrity of your systems.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/services-image/2.png" alt="image">
                            </div>
                            <h3><a href="single-services.html">Fraud Detection and Prevention</a></h3>
                            <p>Implementing systems and controls to identify and prevent fraudulent activities, such as financial fraud, payment fraud, and account takeover.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/services-image/3.png" alt="image">
                            </div>
                            <h3><a href="#">Continuous Monitoring </a></h3>
                            <p>Utilizing advanced monitoring tools and threat intelligence to proactively identify and mitigate emerging security threats and vulnerabilities before they can be exploited.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/services-image/4.png" alt="image">
                            </div>
                            <h3><a href="#">Security &amp; Surveillance</a></h3>
                            <p>Security and surveillance encompass the implementation of measures, technologies, and systems to protect assets, monitor activities, and prevent unauthorized access or incidents in various environments.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/services-image/5.png" alt="image">
                            </div>
                            <h3><a href="#">Automatic Optimization </a></h3>
                            <p>Automatic optimization refers to the process of enhancing system performance, efficiency, or functionality through automated algorithms, tools, or processes without manual intervention.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6">
                        <div class="single-ml-services-box">
                            <div class="image">
                                <img src="frontend/assets/img/services-image/6.png" alt="image">
                            </div>
                            <h3><a href="single-services.html">Data Breach Response Planning</a></h3>
                            <p>Developing protocols and procedures for efficiently detecting, containing, and responding to data breaches to minimize damage and comply with regulatory requirements.</p>
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

@endsection
                
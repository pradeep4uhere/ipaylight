<footer class="footer-area bg-f7fafd">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<div class="logo black-logo">
								<a href="/"><h1><img src="{{asset('logo.svg')}}" height="55px" wifth="100px"/></h1></a>
							</div>
							<div class="logo white-logo">
								<a href="/"><h1><img src="{{asset('logo.svg')}}" height="55px" wifth="100px"/></h1></a>
							</div>
							<p>At Paygenius, we transcend the role of a traditional financial institution, acting as a catalyst for inclusive growth and empowerment. Our vision is to empower every Indian with accessible and affordable banking and financial services through innovative fintech solutions.</p>
						</div>
					</div>

					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget pl-5">
							<h3>Company</h3>
							<ul class="list">
								<li><a href="{{route('page.action', ['page_slug' => 'aboutus'])}}">Home</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'aboutus'])}}">About Us</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'payment-gateway-apis'])}}">Retailer</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'payment-gateway-apis'])}}">Distributor</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'store-page'])}}">API Services</a></li>
								<li><a href="{{route('page.action', ['page_slug' => 'store-page'])}}">Contact Us</a></li>
							</ul>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-footer-widget pl-5">
							<h3>Product & Services</h3>
							<ul class="list">
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'domestic_money_transfer'])}}" class="nav-link @if($page_slug=='mlm-software') active @endif">Domestic Money Transfer</a></li>
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'aadhaar_enabled_payment_system'])}}" class="nav-link @if($page_slug=='b2b-software') active @endif">Aadhaar Enabled Payment System</a></li>
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'gift_card'])}}" class="nav-link @if($page_slug=='b2c-software') active @endif">Gift Cards</a></li>
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'bill_payment'])}}" class="nav-link @if($page_slug=='store-page') active @endif">Bill Payments : BBPS </a></li>
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'micro_atm'])}}" class="nav-link @if($page_slug=='invoice-payment') active @endif">Micro ATM</a></li>
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'cash_managment_service'])}}" class="nav-link @if($page_slug=='invoice-payment') active @endif">Cash Management Service</a></li>
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'aadhaar_pay'])}}" class="nav-link @if($page_slug=='invoice-payment') active @endif">Aadhaar Pay</a></li>
							</ul>
						</div>
					</div>

					

					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<h3>Address</h3>
							
							<ul class="footer-contact-info">
								<li><i data-feather="map-pin"></i>B-23 Sector-63, Noida, Uttar Pradesh (India) </li>
								<li><i data-feather="mail"></i> Email: <a href="mailto:hello@startp.com">info@Paygenius.in</a></li>
								<li><i data-feather="phone-call"></i> Phone: <a href="tel:+ (321) 984 754">+91-9142562743</a></li>
							</ul>
							
						</div>
					</div>
					<div class="col-lg-12 col-md-12 text-center text-9" style="margin-top:30px">
					<a href="{{route('page.action', ['page_slug' => 'privacy-policy'])}}" style="border: solid 1px #dedede;padding: 2px 5px 2px 5px;background: aliceblue;font-size: 12px;">Privacy Policy</a>&nbsp;&nbsp;
					<a href="{{route('page.action', ['page_slug' => 'terms-conditions'])}}" style="border: solid 1px #dedede;padding: 2px 5px 2px 5px;background: aliceblue;font-size: 12px;">Terms & Condition</a>&nbsp;&nbsp;
					<a href="{{route('page.action', ['page_slug' => 'refund-cancellation'])}}" style="border: solid 1px #dedede;padding: 2px 5px 2px 5px;background: aliceblue;font-size: 12px;">Refund & Cancellation</a>&nbsp;&nbsp;
					<a href="{{route('page.action', ['page_slug' => 'customer-support'])}}" style="border: solid 1px #dedede;padding: 2px 5px 2px 5px;background: aliceblue;font-size: 12px;">Customer Support</a>&nbsp;&nbsp;
					<a href="{{route('page.action', ['page_slug' => 'customer-registration'])}}" style="border: solid 1px #dedede;padding: 2px 5px 2px 5px;background: aliceblue;font-size: 12px;">Customer Registration</a>&nbsp;&nbsp;
					<a href="{{route('page.action', ['page_slug' => 'refund-cancellation'])}}" style="border: solid 1px #dedede;padding: 2px 5px 2px 5px;background: aliceblue;font-size: 12px;">Pricing Costing</a>&nbsp;&nbsp;
					<a href="{{route('page.action', ['page_slug' => 'refund-cancellation'])}}" style="border: solid 1px #dedede;padding: 2px 5px 2px 5px;background: aliceblue;font-size: 12px;">Customer Grievance</a>
					</div>
					<div class="col-lg-12 col-md-12">
						<div class="copyright-area text-9" style="margin-top: 41px !important">
							<p>Copyright @<script>document.write(new Date().getFullYear())</script> Paygenius Payment Solutions Pvt Ltd</a></p>
						</div>
					</div>
				</div>
				
			</div>

			<img src="frontend/assets/img/map.png" class="map" alt="map">
			<div class="shape1"><img src="frontend/assets/img/shape1.png" alt="shape"></div>
			<div class="shape8 rotateme"><img src="frontend/assets/img/shape2.svg" alt="shape"></div>
		</footer>
		<!-- End Footer Area -->
<header id="header" class="headroom navbar-color-white">
			<div class="startp-responsive-nav">
                <div class="container">
                    <div class="startp-responsive-menu">
                        <div class="logo black-logo">
                            <a href="{{route('home')}}">
							<img src="{{asset('logo.svg')}}" height="55px" wifth="100px"/>
                            </a>
                        </div>
						<div class="logo white-logo">
                            <a href="{{route('home')}}">
							<img src="{{asset('logo_white.svg')}}" height="55px" wifth="100px"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

			<div class="startp-nav">
				<div class="container">
					<nav class="navbar navbar-expand-md navbar-light">
						<a class="navbar-brand black-logo" href="{{route('home')}}"><h2><img src="{{asset('logo.svg')}}" height="55px" wifth="100px"/></h2></a>
						<a class="navbar-brand white-logo" href="{{route('home')}}"> <img src="{{asset('logo_white.svg')}}" height="55px" wifth="100px"/></a>

						<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
							<ul class="navbar-nav nav ml-auto">
								<li class="nav-item"><a href="{{route('home')}}" class="nav-link active">Home</a></li>
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'aboutus'])}}" class="nav-link">About Us</a></li>
								
								
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'shop'])}}" class="nav-link"> Product & Service <i data-feather="chevron-down"></i></a>
									<ul class="dropdown_menu">
									<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'domestic_money_transfer'])}}" class="nav-link @if($page_slug=='mlm-software') active @endif">Domestic Money Transfer</a></li>
									<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'aadhaar_enabled_payment_system'])}}" class="nav-link @if($page_slug=='b2b-software') active @endif">Aadhaar Enabled Payment</a></li>
									<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'gift_card'])}}" class="nav-link @if($page_slug=='b2c-software') active @endif">Gift Cards</a></li>
									<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'bill_payment'])}}" class="nav-link @if($page_slug=='store-page') active @endif">Bill Payments : BBPS </a></li>
									<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'micro_atm'])}}" class="nav-link @if($page_slug=='invoice-payment') active @endif">Micro ATM</a></li>
									<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'cash_managment_service'])}}" class="nav-link @if($page_slug=='invoice-payment') active @endif">Cash Management Service</a></li>
									<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'aadhaar_pay'])}}" class="nav-link @if($page_slug=='invoice-payment') active @endif">Aadhaar Pay</a></li>
									</ul>
								</li>
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'shop'])}}" class="nav-link"> Work With Us<i data-feather="chevron-down"></i></a>
									<ul class="dropdown_menu">
										<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'superdistributor'])}}" class="nav-link">Super Distributor</a></li>
										<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'distributor'])}}" class="nav-link">Distributor</a></li>
										<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'retailer'])}}" class="nav-link">Retailer</a></li>
										<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'api-services'])}}" class="nav-link">API Service</a></li>
									</ul>
								</li>
							
								<li class="nav-item"><a href="{{route('page.action', ['page_slug' => 'contact_us'])}}" class="nav-link">Contact Us</a></li>
							</ul>
						</div>

						<div class="others-option">
							<a href="{{route('login')}}" class="btn btn-primary">Sing In</a>
						</div>
					</nav>
				</div> 
			</div>

			
		</header>
<!--
		=============================================
				Theme Main Menu
		==============================================
		-->
		<header class="theme-main-menu menu-overlay menu-style-four white-vr sticky-menu">
			<div class="inner-content position-relative">
				<div class="top-header">
					<div class="d-flex align-items-center justify-content-between">
						<div class="logo order-lg-0">
							<a href="index.html" class="d-flex align-items-center">
								<img src="{{ asset('icon_logo.png') }}" alt="" width="250xp">
							</a>
						</div>
						<!-- logo -->
						<div class="right-widget d-none d-md-block ms-auto ms-lg-0 me-3 me-lg-0 order-lg-3">
							<a href="contact.html" class="btn-twelve tran3s">Get Started</a>
						</div> <!--/.right-widget-->
						<nav class="navbar navbar-expand-lg p0 order-lg-2">
							<button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse"
								data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
								aria-label="Toggle navigation">
								<span></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNav">
								<ul class="navbar-nav align-items-lg-center">
									<li class="d-block d-lg-none"><div class="logo"><a href="index.html" class="d-block"><img src="images/logo/logo_01.svg" alt=""></a></div></li>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="{{route('home')}}" role="button" data-bs-toggle="dropdown"
											data-bs-auto-close="outside" aria-expanded="false">Home
										</a>

									</li>
									<li class="nav-item dropdown mega-dropdown-sm">
							        	<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Services
										</a>
						                <ul class="dropdown-menu">
							                <li class="row gx-4">
												<div class="col-lg-4">
													<div class="menu-column">
														<ul class="style-none mega-dropdown-list">
															<li><a href="{{route('page.action', ['page_slug' => 'payment-gateways'])}}" class="dropdown-item"><span>Payment Gateway</span></a></li>
															<li><a href="{{route('page.action', ['page_slug' => 'payout-solutions'])}}" class="dropdown-item"><span>Payout Solutions</span></a></li>
														</ul>
													</div> <!--/.menu-column -->
												</div>


											</li>
						                </ul>
						            </li>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="{{route('page.action', ['page_slug' => 'about-us'])}}" role="button" data-bs-toggle="dropdown"
											data-bs-auto-close="outside" aria-expanded="false">About
										</a>

									</li>

									<li class="nav-item">
										<a class="nav-link" href="{{route('page.action', ['page_slug' => 'contact-us'])}}" role="button">Contact Us</a>
									</li>
									<li class="d-md-none ps-2 pe-2"><a href="#" class="btn-twelve w-100 mt-15 tran3s">Get Started</a></li>
								</ul>
							</div>
						</nav>
					</div>
				</div> <!--/.top-header-->
			</div> <!-- /.inner-content -->
		</header>
		<!-- /.theme-main-menu -->

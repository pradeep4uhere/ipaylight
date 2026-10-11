@extends('layouts.Frontend.ipaylight_page')
@props(['title'])
@section('content')
		<!--
		=============================================
			Inner Banner
		==============================================
		-->
		<div class="inner-banner-one pt-225 lg-pt-200 md-pt-150 pb-100 md-pb-70 position-relative" style="background-image: url(images/media/img_32.jpg);">
			<div class="container position-relative">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<h1 class="hero-heading d-inline-block position-relative me-xxl-4 me-lg-5"> Payment Gateway for Indian Businesses <img src="images/shape/shape_26.svg" alt=""></h1>
					</div>
                    <div class="col-xl-4 col-lg-5 ms-auto">
                        <p class="text-white text-lg mb-70 lg-mb-40">Accept online payments on your website, app or social store. ipaylight supports UPI, debit and credit cards, net banking and wallets, all through one secure checkout.</p>
                        <ul class="style-none d-inline-flex pager">
                            <li><a href="#">Home</a></li>
                            <li>/</li>
                            <li>Services</li>
                        </ul>
                    </div>
				</div>
			</div>
		</div>
		<!-- /.inner-banner-one -->


	<!--
		=============================================
			BLock Feature One
		==============================================
		-->
		<div class="block-feature-one position-relative light-bg-deep mt-100 lg-mt-60 pt-120 lg-pt-60 pb-130 lg-pb-60">
			<div class="container">
				<div class="position-relative">
					<div class="title-one text-center mb-40 lg-mb-10">
                        <h2>Our Services</h2>
                        <p class="text-lg mt-20">Inciddnt ut labore et dolor magna aliu. ad mim venam, quis nostru </p>
                    </div>
                    <!-- /.title-one -->
					<div class="row">
						<div class="col-lg-4 col-md-6 d-flex wow fadeInUp">
							<div class="card-style-two vstack tran3s w-100 mt-30">
								<img src="images/lazy.svg" data-src="images/icon/icon_06.svg" alt="" class="lazy-img icon me-auto">
								<h4 class="fw-bold mt-30 mb-25">Many Payment Modes</h4>
								<p class="mb-20">Let customers pay with UPI, cards, net banking or wallets.</p>
								<a href="service-details.html" class="arrow-btn tran3s mt-auto stretched-link"><img src="images/lazy.svg" data-src="images/icon/icon_09.svg" alt="" class="lazy-img"></a>
							</div>
							<!-- /.card-style-two -->
						</div>
						<div class="col-lg-4 col-md-6 d-flex wow fadeInUp" data-wow-delay="0.1s">
							<div class="card-style-two vstack tran3s w-100 mt-30">
								<img src="images/lazy.svg" data-src="images/icon/icon_07.svg" alt="" class="lazy-img icon me-auto">
								<h4 class="fw-bold mt-30 mb-25">High Success Rate</h4>
								<p class="mb-20">Smart routing sends each payment through the best bank route.</p>
								<a href="service-details.html" class="arrow-btn tran3s mt-auto stretched-link"><img src="images/lazy.svg" data-src="images/icon/icon_09.svg" alt="" class="lazy-img"></a>
							</div>
							<!-- /.card-style-two -->
						</div>
						<div class="col-lg-4 col-md-6 d-flex wow fadeInUp" data-wow-delay="0.2s">
							<div class="card-style-two vstack tran3s w-100 mt-30">
								<img src="images/lazy.svg" data-src="images/icon/icon_08.svg" alt="" class="lazy-img icon me-auto">
								<h4 class="fw-bold mt-30 mb-25">Easy Integration</h4>
								<p class="mb-20">Use ready plugins for WooCommerce and Shopify [confirm], or our REST APIs.</p>
								<a href="service-details.html" class="arrow-btn tran3s mt-auto stretched-link"><img src="images/lazy.svg" data-src="images/icon/icon_09.svg" alt="" class="lazy-img"></a>
							</div>
							<!-- /.card-style-two -->
						</div>

					</div>
				</div>
			</div>
            <img src="images/lazy.svg" data-src="images/shape/shape_05.svg" alt="" class="lazy-img shapes shape_01">
            <img src="images/lazy.svg" data-src="images/shape/shape_05.svg" alt="" class="lazy-img shapes shape_02">
		</div>
		<!-- /.block-feature-one -->



@endsection

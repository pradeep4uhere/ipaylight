
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

<div class="agency-about-area ptb-80">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="agency-about-img">
                            <img src="frontend/assets/img/store.jpeg" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="agency-about-content">
                            <span class="sub-title">Welcome to Our Store</span>
                            <h2>Store Page</h2>
                            <div class="bar"></div>
                            <p>Discover the best in payment solutions with Paygenius Payment Solutions Pvt Ltd. We offer a range of products designed to simplify and secure your financial operations, ensuring seamless transactions and enhanced business efficiency. Explore our offerings and find the perfect solution for your business needs.</p>
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


@include('Page.bottomBanner')
@endsection
                
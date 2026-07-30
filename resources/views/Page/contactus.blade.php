
@extends('layouts.Frontend.default')
@section('content')
<!-- Start Navbar Area -->
@include('elements.Frontend.frontend_header')
<!-- End Navbar Area -->
<!-- End Navbar Area -->
<div class="page-title-area" style="padding-top:102px;padding-bottom:1px;">
<div class="contact-analytics-banner">
    <div class="container">
        <div class="contact-analytics-content" >
            <h1 class="tlt">Contact Us</h1>
            <h4 style="color:#fff" data-wow-delay="0.9s" class="wow animate__animated animate__fadeInUp">Get Qucik Ressponse within 24 Hours.</h4>
            <a href="contact.html" class="btn btn-primary">&nbsp;r</a>
        </div>
    </div>
</div>
</div>
<div class="contact-info-area">
            <div class="container  ptb-80">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                    <div class="section-title">
					<h2>Contact Us</h2>
					<div class="bar"></div>

				</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-info-box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            </div>
                            <h3>Mail Here</h3>
                            <p><a href="mailto:hello@startp.com">info@paygneius.in</a></p>
                            <p><a href="mailto:info@startp.com">support@paygneius.in</a></p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-info-box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </div>
                            <h3>Visit Here</h3>
                            <p>Paygenius Payment Solutions Pvt Ltd</p>
                            <p>B-23 Sector 63, Noida, 201301, (UP), India</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                        <div class="contact-info-box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            </div>
                            <h3>Call Here</h3>
                            <p><a href="tel:+123 456 7890">+91-9142562743</a></p>
                            <p><a href="tel:+241 452 4526">+91-9716145194</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="map">
        <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Paygenius%20Payment%20Soulutions%20Pvt%20LtdB-23%20Sec-%2063%20City-2%2C%20&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

		</div>

        <div class="ml-services-area ptb-80">
            <div class="container">
                <div class="section-title">
                    <h2>Get In Touch With Us</h2>
                    <div class="bar"></div>
                    <p>Anything On your Mind. We’ll Be Glad To Assist You!</p>
                </div>

                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <img src="frontend/assets/img/1.png" alt="image">
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <form id="contactForm" novalidate="true">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" required="" data-error="Please enter your name" placeholder="Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
										<input type="email" name="email" id="email" class="form-control" required="" data-error="Please enter your email" placeholder="Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="phone_number" id="phone_number" required="" data-error="Please enter your number" class="form-control" placeholder="Phone">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
										<input type="text" name="msg_subject" id="msg_subject" class="form-control" required="" data-error="Please enter your subject" placeholder="Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="5" required="" data-error="Write your message" placeholder="Your Message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="btn btn-primary disabled">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Ready To Talk Area -->
		@include('Page.bottomBanner')
		<!-- End Ready To Talk Area -->
        @endsection
                
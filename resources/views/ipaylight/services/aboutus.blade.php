
@extends('layouts.Frontend.ipaylight_page')
@props(['title'])

@section('content')

    <!-- =============================================
         Inner Banner
    ============================================== -->
    <div class="inner-banner-two light-bg text-center pt-200 md-pt-150 pb-85 lg-pb-50 position-relative">
        <div class="container position-relative">
            <div class="row">
                <div class="col-xl-8 m-auto">
                    <ul class="style-none d-inline-flex justify-content-center pager">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>/</li>
                        <li>About Us</li>
                    </ul>

                    <h1 class="hero-heading">About iPaylight</h1>

                    <p class="text-lg">
                        iPaylight is a payment infrastructure platform operated by
                        Ipaylight Technologies Pvt. Ltd. We help businesses simplify
                        payment collection and payouts through technology-driven
                        solutions designed to support their digital payment needs.
                    </p>
                </div>
            </div>
        </div>

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/assets/ils_01.svg') }}"
             alt=""
             class="lazy-img shapes shape_01">

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/assets/ils_02.svg') }}"
             alt=""
             class="lazy-img shapes shape_02">

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_03">

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_04">
    </div>
    <!-- /.inner-banner-two -->


    <!-- =============================================
         Block Feature Ten - Our Mission
    ============================================== -->
    <div class="block-feature-ten position-relative mt-150 lg-mt-80 pb-100 lg-pb-60">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-lg-8 wow fadeInUp">
                    <div class="title-one mb-50 lg-mb-20">
                        <h2>Our Mission</h2>
                    </div>
                </div>
            </div>

            <div class="line-wrapper position-relative">
                <div class="row gx-lg-5">

                    <div class="col-xl-12 col-md-12 wow fadeInUp">
                        <div class="card-style-sixteen d-flex mt-60 lg-mt-40 mb-60 lg-mb-10">

                            <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_62.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </div>

                            <div class="text">
                                <p class="m0">
                                    Our mission is to make digital payments simpler,
                                    more accessible and efficient for businesses.
                                    We aim to help organisations manage payment
                                    collection and payouts with practical technology,
                                    transparent processes and a focus on reliability.
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_01">
    </div>
    <!-- /.block-feature-ten -->


    <!-- =============================================
         Block Feature Six - What We Do
    ============================================== -->
    <div class="block-feature-six bg-two position-relative pt-150 lg-pt-60 pb-120 lg-pb-40">
        <div class="container">

            <div class="row gx-lg-5">

                <div class="col-lg-4 wow fadeInLeft">
                    <div class="title-one">
                        <h2>What We Do</h2>
                    </div>

                    <p class="text-lg text-dark mt-40 md-mt-20 mb-35 md-mb-30">
                        We provide technology-driven payment solutions that help
                        businesses manage collections, payouts and payment-related
                        operations through a simpler workflow.
                    </p>

                    <a href="{{ url('/contact-us') }}"
                       class="btn-eleven d-inline-flex align-items-center md-mb-60">

                        <span class="text">TALK TO SALES</span>

                        <div class="icon tran3s rounded-circle d-flex align-items-center">
                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_27.svg') }}"
                                 alt=""
                                 class="lazy-img">
                        </div>
                    </a>
                </div>


                <div class="col-lg-8">
                    <div class="row">

                        <!-- Payment Gateway -->
                        <div class="col-md-6 d-flex wow fadeInUp">
                            <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">

                                <div class="icon d-flex align-items-center">
                                    <img src="{{ asset('images/lazy.svg') }}"
                                         data-src="{{ asset('images/icon/icon_68.svg') }}"
                                         alt=""
                                         class="lazy-img">
                                </div>

                                <h4 class="fw-bold mt-30 mb-20">
                                    Payment Gateway for Websites and Apps
                                </h4>

                                <a href="{{ url('/services') }}"
                                   class="stretched-link"
                                   aria-label="Explore payment gateway services"></a>
                            </div>
                        </div>


                        <!-- Bulk Payouts -->
                        <div class="col-md-6 d-flex wow fadeInUp"
                             data-wow-delay="0.1s">

                            <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30 active">

                                <div class="icon d-flex align-items-center">
                                    <img src="{{ asset('images/lazy.svg') }}"
                                         data-src="{{ asset('images/icon/icon_69.svg') }}"
                                         alt=""
                                         class="lazy-img">
                                </div>

                                <h4 class="fw-bold mt-30 mb-20">
                                    Bulk Payouts to Bank Accounts and UPI
                                </h4>

                                <a href="{{ url('/services') }}"
                                   class="stretched-link"
                                   aria-label="Explore bulk payout services"></a>
                            </div>
                        </div>


                        <!-- UPI and Bank Transfers -->
                        <div class="col-md-6 d-flex wow fadeInUp"
                             data-wow-delay="0.2s">

                            <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">

                                <div class="icon d-flex align-items-center">
                                    <img src="{{ asset('images/lazy.svg') }}"
                                         data-src="{{ asset('images/icon/icon_70.svg') }}"
                                         alt=""
                                         class="lazy-img">
                                </div>

                                <h4 class="fw-bold mt-30 mb-20">
                                    UPI, QR Code and Bank Transfer Solutions
                                </h4>

                                <a href="{{ url('/services') }}"
                                   class="stretched-link"
                                   aria-label="Explore payment transfer solutions"></a>
                            </div>
                        </div>


                        <!-- APIs and Reconciliation -->
                        <div class="col-md-6 d-flex wow fadeInUp"
                             data-wow-delay="0.3s">

                            <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">

                                <div class="icon d-flex align-items-center">
                                    <img src="{{ asset('images/lazy.svg') }}"
                                         data-src="{{ asset('images/icon/icon_71.svg') }}"
                                         alt=""
                                         class="lazy-img">
                                </div>

                                <h4 class="fw-bold mt-30 mb-20">
                                    APIs, Dashboards and Payment Reconciliation
                                </h4>

                                <a href="{{ url('/services') }}"
                                   class="stretched-link"
                                   aria-label="Explore payment APIs and dashboards"></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_11.svg') }}"
             alt=""
             class="lazy-img shapes shape_01">

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_12.svg') }}"
             alt=""
             class="lazy-img shapes shape_02">
    </div>
    <!-- /.block-feature-six -->


    <!-- =============================================
         Why iPaylight
    ============================================== -->
    <div class="block-feature-ten position-relative mt-150 lg-mt-80 pb-100 lg-pb-60">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-lg-8 wow fadeInUp">
                    <div class="title-one mb-50 lg-mb-20">
                        <h2>Our Approach</h2>
                    </div>
                </div>
            </div>

            <div class="line-wrapper position-relative">
                <div class="row gx-lg-5">

                    <div class="col-xl-12 col-md-12 wow fadeInUp">
                        <div class="card-style-sixteen d-flex mt-30 mb-30">

                            <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_62.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </div>

                            <div class="text">
                                <h4 class="fw-bold mb-20">Business-Focused Solutions</h4>
                                <p class="m0">
                                    We focus on understanding business payment requirements
                                    and providing solutions that fit operational needs,
                                    whether a business is collecting payments or managing
                                    payouts.
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="col-xl-12 col-md-12 wow fadeInUp">
                        <div class="card-style-sixteen d-flex mt-30 mb-30">

                            <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_62.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </div>

                            <div class="text">
                                <h4 class="fw-bold mb-20">Technology and Integration</h4>
                                <p class="m0">
                                    We aim to simplify payment operations through digital
                                    tools, integration capabilities and information that
                                    helps businesses manage their payment activities.
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="col-xl-12 col-md-12 wow fadeInUp">
                        <div class="card-style-sixteen d-flex mt-30 mb-30">

                            <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_62.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </div>

                            <div class="text">
                                <h4 class="fw-bold mb-20">A Focus on Reliability</h4>
                                <p class="m0">
                                    We recognise the importance of dependable payment
                                    processes and work towards making payment-related
                                    activities easier to manage and reconcile.
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_01">
    </div>
    <!-- /.block-feature-ten -->


    <!-- =============================================
         Contact CTA
    ============================================== -->
    <div class="block-feature-six bg-two position-relative pt-80 lg-pt-60 pb-80 lg-pb-40">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-8 wow fadeInUp">
                    <div class="title-one">
                        <h2>Let's Discuss Your Payment Requirements</h2>
                    </div>

                    <p class="text-lg text-dark mt-30">
                        Looking for payment collection or payout solutions for
                        your business? Connect with our team to discuss your
                        requirements.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end mt-30 mt-lg-0">
                    <a href="{{ url('/contact-us') }}"
                       class="btn-eleven d-inline-flex align-items-center">

                        <span class="text">CONTACT US</span>

                        <div class="icon tran3s rounded-circle d-flex align-items-center">
                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_27.svg') }}"
                                 alt=""
                                 class="lazy-img">
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection


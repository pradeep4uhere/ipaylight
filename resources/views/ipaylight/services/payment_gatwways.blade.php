@extends('layouts.Frontend.ipaylight_page')
@props(['title'])

@section('content')

    <!-- =============================================
         Inner Banner
    ============================================== -->
    <div class="inner-banner-one pt-225 lg-pt-200 md-pt-150 pb-100 md-pb-70 position-relative"
         style="background-image: url('{{ asset('images/media/img_32.jpg') }}');">

        <div class="container position-relative">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <h1 class="hero-heading d-inline-block position-relative me-xxl-4 me-lg-5">
                        Payment Gateway for Indian Businesses
                        <img src="{{ asset('images/shape/shape_26.svg') }}" alt="">
                    </h1>
                </div>

                <div class="col-xl-4 col-lg-5 ms-auto">
                    <p class="text-white text-lg mb-70 lg-mb-40">
                        Simplify online payment collection with iPaylight.
                        Explore payment options for websites, applications and
                        digital businesses through a streamlined checkout experience.
                    </p>

                    <ul class="style-none d-inline-flex pager">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>/</li>
                        <li>Services</li>
                        <li>/</li>
                        <li>Payment Gateway</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- /.inner-banner-one -->


    <!-- =============================================
         Our Services
    ============================================== -->
    <div class="block-feature-one position-relative light-bg-deep mt-100 lg-mt-60 pt-120 lg-pt-60 pb-130 lg-pb-60">

        <div class="container">
            <div class="position-relative">

                <div class="title-one text-center mb-40 lg-mb-10">
                    <h2>Payment Solutions for Modern Businesses</h2>

                    <p class="text-lg mt-20">
                        Manage online payments through technology designed to
                        simplify checkout, payment tracking and everyday operations.
                    </p>
                </div>

                <div class="row">

                    <!-- Payment Modes -->
                    <div class="col-lg-4 col-md-6 d-flex wow fadeInUp">
                        <div class="card-style-two vstack tran3s w-100 mt-30">

                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_06.svg') }}"
                                 alt="Payment options"
                                 class="lazy-img icon me-auto">

                            <h4 class="fw-bold mt-30 mb-25">Multiple Payment Options</h4>

                            <p class="mb-20">
                                Support customer payment preferences through
                                available payment methods such as UPI, debit
                                and credit cards, net banking and wallets,
                                subject to your enabled payment configuration.
                            </p>

                            <a href="{{ url('/contact-us') }}"
                               class="arrow-btn tran3s mt-auto stretched-link"
                               aria-label="Enquire about payment options">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_09.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </a>
                        </div>
                    </div>


                    <!-- Payment Management -->
                    <div class="col-lg-4 col-md-6 d-flex wow fadeInUp"
                         data-wow-delay="0.1s">

                        <div class="card-style-two vstack tran3s w-100 mt-30">

                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_07.svg') }}"
                                 alt="Payment management"
                                 class="lazy-img icon me-auto">

                            <h4 class="fw-bold mt-30 mb-25">Payment Tracking</h4>

                            <p class="mb-20">
                                Track payment activity using available transaction
                                information and reporting tools to support
                                reconciliation and day-to-day payment operations.
                            </p>

                            <a href="{{ url('/contact-us') }}"
                               class="arrow-btn tran3s mt-auto stretched-link"
                               aria-label="Enquire about payment tracking">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_09.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </a>
                        </div>
                    </div>


                    <!-- Integration -->
                    <div class="col-lg-4 col-md-6 d-flex wow fadeInUp"
                         data-wow-delay="0.2s">

                        <div class="card-style-two vstack tran3s w-100 mt-30">

                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_08.svg') }}"
                                 alt="Payment integration"
                                 class="lazy-img icon me-auto">

                            <h4 class="fw-bold mt-30 mb-25">Integration Support</h4>

                            <p class="mb-20">
                                Connect payment functionality with your business
                                website or application using the integration
                                methods and technical documentation available
                                for your account.
                            </p>

                            <a href="{{ url('/contact-us') }}"
                               class="arrow-btn tran3s mt-auto stretched-link"
                               aria-label="Enquire about integration">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_09.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_01">

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_02">
    </div>
    <!-- /.block-feature-one -->


    <!-- =============================================
         Payment Gateway Overview
    ============================================== -->
    <div class="block-feature-ten position-relative mt-150 lg-mt-80 pb-100 lg-pb-60">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6 wow fadeInLeft">
                    <div class="title-one mb-30">
                        <h2>A Simpler Way to Accept Online Payments</h2>
                    </div>

                    <p class="text-lg mb-25">
                        A convenient checkout experience can help businesses
                        manage customer payments across their digital channels.
                        iPaylight aims to simplify the payment process through
                        payment infrastructure and integration options.
                    </p>

                    <p class="mb-25">
                        Whether you operate an online store, a service platform
                        or a business application, the right payment setup can
                        help bring payment collection and transaction management
                        into a more organised workflow.
                    </p>

                    <a href="{{ url('/contact-us') }}"
                       class="btn-eleven d-inline-flex align-items-center">

                        <span class="text">DISCUSS YOUR REQUIREMENTS</span>

                        <div class="icon tran3s rounded-circle d-flex align-items-center">
                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_27.svg') }}"
                                 alt=""
                                 class="lazy-img">
                        </div>
                    </a>
                </div>


                <div class="col-lg-6 wow fadeInRight mt-50 mt-lg-0">

                    <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">

                        <div class="icon d-flex align-items-center">
                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_68.svg') }}"
                                 alt=""
                                 class="lazy-img">
                        </div>

                        <h4 class="fw-bold mt-30 mb-20">
                            Convenient Customer Checkout
                        </h4>

                        <p class="mb-0">
                            Give customers access to the payment methods enabled
                            for your business and provide a clear path from
                            checkout to payment confirmation.
                        </p>
                    </div>


                    <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">

                        <div class="icon d-flex align-items-center">
                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_69.svg') }}"
                                 alt=""
                                 class="lazy-img">
                        </div>

                        <h4 class="fw-bold mt-30 mb-20">
                            Organised Transaction Management
                        </h4>

                        <p class="mb-0">
                            Use the transaction information and reporting
                            facilities available in your setup to support
                            payment monitoring and reconciliation.
                        </p>
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
         Who Can Benefit
    ============================================== -->
    <div class="block-feature-one position-relative light-bg-deep mt-100 lg-mt-60 pt-120 lg-pt-60 pb-130 lg-pb-60">

        <div class="container">

            <div class="title-one text-center mb-40 lg-mb-10">
                <h2>Who Can Benefit from Our Payment Solutions?</h2>

                <p class="text-lg mt-20">
                    Payment infrastructure can support different types of
                    businesses with online collection requirements.
                </p>
            </div>

            <div class="row">

                <!-- Ecommerce -->
                <div class="col-lg-4 col-md-6 d-flex wow fadeInUp">
                    <div class="card-style-two vstack tran3s w-100 mt-30">

                        <img src="{{ asset('images/lazy.svg') }}"
                             data-src="{{ asset('images/icon/icon_06.svg') }}"
                             alt=""
                             class="lazy-img icon me-auto">

                        <h4 class="fw-bold mt-30 mb-25">E-commerce Businesses</h4>

                        <p class="mb-20">
                            Support online order payments through a checkout
                            experience aligned with your business requirements.
                        </p>
                    </div>
                </div>


                <!-- Service Businesses -->
                <div class="col-lg-4 col-md-6 d-flex wow fadeInUp"
                     data-wow-delay="0.1s">

                    <div class="card-style-two vstack tran3s w-100 mt-30">

                        <img src="{{ asset('images/lazy.svg') }}"
                             data-src="{{ asset('images/icon/icon_07.svg') }}"
                             alt=""
                             class="lazy-img icon me-auto">

                        <h4 class="fw-bold mt-30 mb-25">Service Providers</h4>

                        <p class="mb-20">
                            Facilitate online payment collection for eligible
                            services, bookings and customer transactions.
                        </p>
                    </div>
                </div>


                <!-- Digital Platforms -->
                <div class="col-lg-4 col-md-6 d-flex wow fadeInUp"
                     data-wow-delay="0.2s">

                    <div class="card-style-two vstack tran3s w-100 mt-30">

                        <img src="{{ asset('images/lazy.svg') }}"
                             data-src="{{ asset('images/icon/icon_08.svg') }}"
                             alt=""
                             class="lazy-img icon me-auto">

                        <h4 class="fw-bold mt-30 mb-25">Digital Platforms</h4>

                        <p class="mb-20">
                            Explore payment integration options for websites,
                            applications and digital business workflows,
                            subject to platform and merchant eligibility.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_01">

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_02">

    </div>
    <!-- /.block-feature-one -->


    <!-- =============================================
         How It Works
    ============================================== -->
    <div class="block-feature-ten position-relative mt-150 lg-mt-80 pb-100 lg-pb-60">

        <div class="container">

            <div class="title-one text-center mb-50 lg-mb-20">
                <h2>How Payment Gateway Integration Works</h2>

                <p class="text-lg mt-20">
                    A typical onboarding and integration journey.
                    The exact process depends on your business and account setup.
                </p>
            </div>

            <div class="row gx-lg-5">

                <div class="col-lg-4 col-md-6 wow fadeInUp">
                    <div class="card-style-sixteen d-flex mt-30 mb-30">

                        <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_62.svg') }}"
                                 alt=""
                                 class="lazy-img">
                        </div>

                        <div class="text">
                            <h4 class="fw-bold mb-20">01. Share Requirements</h4>

                            <p class="m0">
                                Tell us about your business model, website,
                                application and payment collection needs.
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 wow fadeInUp"
                     data-wow-delay="0.1s">

                    <div class="card-style-sixteen d-flex mt-30 mb-30">

                        <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_62.svg') }}"
                                 alt=""
                                 class="lazy-img">
                        </div>

                        <div class="text">
                            <h4 class="fw-bold mb-20">02. Review and Integrate</h4>

                            <p class="m0">
                                Complete the applicable onboarding checks and
                                integrate using the payment methods and technical
                                resources made available to your business.
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 wow fadeInUp"
                     data-wow-delay="0.2s">

                    <div class="card-style-sixteen d-flex mt-30 mb-30">

                        <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_62.svg') }}"
                                 alt=""
                                 class="lazy-img">
                        </div>

                        <div class="text">
                            <h4 class="fw-bold mb-20">03. Test and Go Live</h4>

                            <p class="m0">
                                Test the configured payment flow and proceed
                                to production once the required checks and
                                activation steps have been completed.
                            </p>
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
         Frequently Asked Questions
    ============================================== -->
    <div class="block-feature-one position-relative light-bg-deep mt-100 lg-mt-60 pt-120 lg-pt-60 pb-130 lg-pb-60">

        <div class="container">

            <div class="title-one text-center mb-40 lg-mb-10">
                <h2>Frequently Asked Questions</h2>

                <p class="text-lg mt-20">
                    Find answers to common questions about payment gateway services.
                </p>
            </div>

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="card-style-two w-100 mt-30">
                        <h4 class="fw-bold mb-20">
                            1. What is a payment gateway?
                        </h4>

                        <p class="mb-0">
                            A payment gateway is technology that helps businesses
                            accept and process online payment requests through
                            supported payment methods and payment processing partners.
                        </p>
                    </div>


                    <div class="card-style-two w-100 mt-30">
                        <h4 class="fw-bold mb-20">
                            2. Which payment methods can I offer my customers?
                        </h4>

                        <p class="mb-0">
                            Available methods may include UPI, debit and credit
                            cards, net banking and wallets. The methods available
                            to you depend on your approved account configuration
                            and service availability.
                        </p>
                    </div>


                    <div class="card-style-two w-100 mt-30">
                        <h4 class="fw-bold mb-20">
                            3. Can I integrate a payment gateway into my website?
                        </h4>

                        <p class="mb-0">
                            Integration options depend on the platform you use
                            and the technical resources available for your account.
                            Contact our team to discuss your website or application.
                        </p>
                    </div>


                    <div class="card-style-two w-100 mt-30">
                        <h4 class="fw-bold mb-20">
                            4. How can I track my payment transactions?
                        </h4>

                        <p class="mb-0">
                            Transaction tracking and reconciliation options depend
                            on the reporting facilities provided with your
                            payment setup. Your onboarding team can explain
                            the options available to your account.
                        </p>
                    </div>


                    <div class="card-style-two w-100 mt-30">
                        <h4 class="fw-bold mb-20">
                            5. How can I get started with iPaylight?
                        </h4>

                        <p class="mb-0">
                            Contact our team with your business details and
                            payment requirements. We can discuss the applicable
                            onboarding process, available services and integration
                            requirements.
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_01">

    </div>
    <!-- /.block-feature-one -->


    <!-- =============================================
         Contact CTA
    ============================================== -->
    <div class="block-feature-ten position-relative mt-100 lg-mt-60 pb-100 lg-pb-60">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-8 wow fadeInUp">

                    <div class="title-one">
                        <h2>Ready to Discuss Your Payment Requirements?</h2>
                    </div>

                    <p class="text-lg mt-30">
                        Connect with iPaylight to discuss payment collection,
                        integration options and the requirements of your business.
                    </p>

                </div>

                <div class="col-lg-4 text-lg-end mt-30 mt-lg-0">

                    <a href="{{ url('/contact-us') }}"
                       class="btn-eleven d-inline-flex align-items-center">

                        <span class="text">CONTACT OUR TEAM</span>

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

        <img src="{{ asset('images/lazy.svg') }}"
             data-src="{{ asset('images/shape/shape_05.svg') }}"
             alt=""
             class="lazy-img shapes shape_01">

    </div>
    <!-- /.block-feature-ten -->

@endsection


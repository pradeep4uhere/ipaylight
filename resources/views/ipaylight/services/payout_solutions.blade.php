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
                        <li>Services</li>
                        <li>/</li>
                        <li>Payout Solutions</li>
                    </ul>

                    <h1 class="hero-heading">Business Payout Solutions</h1>

                    <p class="text-lg">
                        Simplify business disbursements with payout solutions
                        designed to help you send money to vendors, employees,
                        partners and customers through supported bank transfer
                        and UPI channels.
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
         Payout Features
    ============================================== -->
    <div class="block-feature-ten position-relative mt-150 lg-mt-80 pb-100 lg-pb-60">

        <div class="container">

            <div class="row align-items-center">
                <div class="col-lg-8 wow fadeInUp">

                    <div class="title-one mb-50 lg-mb-20">
                        <h2>Complete Payout Solutions for Your Business</h2>
                    </div>

                </div>
            </div>

            <div class="line-wrapper position-relative">
                <div class="row gx-lg-5">

                    <!-- Bulk Payouts -->
                    <div class="col-xl-4 col-md-6 wow fadeInUp">
                        <div class="card-style-sixteen d-flex mt-60 lg-mt-40 mb-60 lg-mb-10">

                            <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_62.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </div>

                            <div class="text">
                                <h4 class="fw-bold mb-20 sm-mb-10">
                                    Bulk Payouts
                                </h4>

                                <p class="m0">
                                    Manage multiple disbursements through
                                    supported file uploads or API integrations,
                                    subject to your account configuration.
                                </p>
                            </div>

                        </div>
                    </div>


                    <!-- Bank Transfers -->
                    <div class="col-xl-4 col-md-6 wow fadeInUp"
                         data-wow-delay="0.1s">

                        <div class="card-style-sixteen d-flex mt-60 lg-mt-40 mb-60 lg-mb-10">

                            <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_63.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </div>

                            <div class="text">
                                <h4 class="fw-bold mb-20 sm-mb-10">
                                    Bank and UPI Transfers
                                </h4>

                                <p class="m0">
                                    Send payouts through supported transfer
                                    methods, including bank transfers and UPI,
                                    according to service availability.
                                </p>
                            </div>

                        </div>
                    </div>


                    <!-- Account Verification -->
                    <div class="col-xl-4 col-md-6 wow fadeInUp"
                         data-wow-delay="0.2s">

                        <div class="card-style-sixteen d-flex mt-60 lg-mt-40 mb-60 lg-mb-10">

                            <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/lazy.svg') }}"
                                     data-src="{{ asset('images/icon/icon_63.svg') }}"
                                     alt=""
                                     class="lazy-img">
                            </div>

                            <div class="text">
                                <h4 class="fw-bold mb-20 sm-mb-10">
                                    Beneficiary Verification
                                </h4>

                                <p class="m0">
                                    Use available beneficiary and bank-account
                                    verification facilities to help check
                                    recipient details before initiating payouts.
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
         How Payouts Work
    ============================================== -->
    <div class="block-feature-six bg-two position-relative pt-150 lg-pt-60 pb-120 lg-pb-40">

        <div class="container">

            <div class="row gx-lg-5">

                <div class="col-lg-4 wow fadeInLeft">

                    <div class="title-one">
                        <h2>How Our Payout Process Works</h2>
                    </div>

                    <p class="text-lg text-dark mt-40 md-mt-20 mb-35 md-mb-30">
                        Manage your payout workflow through a structured
                        process, from account funding to transaction tracking.
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

                        <!-- Add Funds -->
                        <div class="col-md-6 d-flex wow fadeInUp">
                            <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">

                                <div class="icon d-flex align-items-center">
                                    <img src="{{ asset('images/lazy.svg') }}"
                                         data-src="{{ asset('images/icon/icon_68.svg') }}"
                                         alt=""
                                         class="lazy-img">
                                </div>

                                <h4 class="fw-bold mt-30 mb-20">
                                    01. Fund Your Account
                                </h4>

                                <p>
                                    Arrange payout funding according to your
                                    account setup and the applicable funding
                                    process.
                                </p>

                            </div>
                        </div>


                        <!-- Beneficiaries -->
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
                                    02. Add Beneficiaries
                                </h4>

                                <p>
                                    Add recipient details using the supported
                                    dashboard workflow or API integration.
                                </p>

                            </div>
                        </div>


                        <!-- Initiate Payout -->
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
                                    03. Initiate Payouts
                                </h4>

                                <p>
                                    Submit individual or bulk payout requests
                                    through the payment methods enabled
                                    for your account.
                                </p>

                            </div>
                        </div>


                        <!-- Tracking -->
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
                                    04. Track Transactions
                                </h4>

                                <p>
                                    Review the available payout status and
                                    transaction details to support monitoring
                                    and reconciliation.
                                </p>

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
         Business Benefits
    ============================================== -->
    <div class="block-feature-one position-relative light-bg-deep mt-100 lg-mt-60 pt-120 lg-pt-60 pb-130 lg-pb-60">

        <div class="container">

            <div class="title-one text-center mb-40 lg-mb-10">

                <h2>Why Businesses Use Payout Solutions</h2>

                <p class="text-lg mt-20">
                    Organise business disbursements with tools designed
                    to support recurring payments and operational workflows.
                </p>

            </div>

            <div class="row">

                <!-- Operational Efficiency -->
                <div class="col-lg-4 col-md-6 d-flex wow fadeInUp">
                    <div class="card-style-two vstack tran3s w-100 mt-30">

                        <img src="{{ asset('images/lazy.svg') }}"
                             data-src="{{ asset('images/icon/icon_06.svg') }}"
                             alt=""
                             class="lazy-img icon me-auto">

                        <h4 class="fw-bold mt-30 mb-25">
                            Simplified Operations
                        </h4>

                        <p class="mb-20">
                            Organise multiple payout requests through a
                            consolidated workflow instead of managing
                            every payment separately.
                        </p>

                    </div>
                </div>


                <!-- Bulk Processing -->
                <div class="col-lg-4 col-md-6 d-flex wow fadeInUp"
                     data-wow-delay="0.1s">

                    <div class="card-style-two vstack tran3s w-100 mt-30">

                        <img src="{{ asset('images/lazy.svg') }}"
                             data-src="{{ asset('images/icon/icon_07.svg') }}"
                             alt=""
                             class="lazy-img icon me-auto">

                        <h4 class="fw-bold mt-30 mb-25">
                            Bulk Payment Management
                        </h4>

                        <p class="mb-20">
                            Manage recurring disbursements for eligible
                            recipients, such as vendors, employees
                            and business partners.
                        </p>

                    </div>
                </div>


                <!-- Reconciliation -->
                <div class="col-lg-4 col-md-6 d-flex wow fadeInUp"
                     data-wow-delay="0.2s">

                    <div class="card-style-two vstack tran3s w-100 mt-30">

                        <img src="{{ asset('images/lazy.svg') }}"
                             data-src="{{ asset('images/icon/icon_08.svg') }}"
                             alt=""
                             class="lazy-img icon me-auto">

                        <h4 class="fw-bold mt-30 mb-25">
                            Transaction Visibility
                        </h4>

                        <p class="mb-20">
                            Use available transaction records and payout
                            statuses to assist with payment monitoring
                            and reconciliation.
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
         Payout Use Cases
    ============================================== -->
    <div class="block-feature-ten position-relative mt-150 lg-mt-80 pb-100 lg-pb-60">

        <div class="container">

            <div class="title-one text-center mb-50 lg-mb-20">
                <h2>Business Payout Use Cases</h2>

                <p class="text-lg mt-20">
                    Payout workflows can support different business
                    disbursement requirements.
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
                            <h4 class="fw-bold mb-20">Vendor Payments</h4>

                            <p class="m0">
                                Manage payments to suppliers and business
                                vendors through supported payout channels.
                            </p>
                        </div>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 wow fadeInUp"
                     data-wow-delay="0.1s">

                    <div class="card-style-sixteen d-flex mt-30 mb-30">

                        <div class="icon tran3s rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/lazy.svg') }}"
                                 data-src="{{ asset('images/icon/icon_63.svg') }}"
                                 alt=""
                                 class="lazy-img">
                        </div>

                        <div class="text">
                            <h4 class="fw-bold mb-20">Employee Payments</h4>

                            <p class="m0">
                                Organise eligible employee reimbursements,
                                incentives and other business disbursements.
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
                            <h4 class="fw-bold mb-20">Partner Payments</h4>

                            <p class="m0">
                                Coordinate eligible partner commissions,
                                incentives and other approved payouts.
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
    <div class="block-feature-six bg-two position-relative pt-120 lg-pt-60 pb-120 lg-pb-40">

        <div class="container">

            <div class="title-one text-center mb-50 lg-mb-20">
                <h2>Frequently Asked Questions</h2>

                <p class="text-lg mt-20">
                    Learn more about business payouts and the available workflow.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">
                        <h4 class="fw-bold mb-20">
                            1. What are payout solutions?
                        </h4>

                        <p class="mb-0">
                            Payout solutions help businesses send money to
                            recipients such as vendors, employees and partners
                            through supported bank transfer or digital payment
                            channels.
                        </p>
                    </div>


                    <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">
                        <h4 class="fw-bold mb-20">
                            2. Can I make bulk payouts?
                        </h4>

                        <p class="mb-0">
                            Bulk payouts may be available through supported
                            file uploads or API integrations, depending on
                            your account configuration and service eligibility.
                        </p>
                    </div>


                    <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">
                        <h4 class="fw-bold mb-20">
                            3. Which payout methods are supported?
                        </h4>

                        <p class="mb-0">
                            Available methods may include bank transfers
                            and UPI. Specific transfer rails, limits and
                            availability depend on your enabled services
                            and payment partners.
                        </p>
                    </div>


                    <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">
                        <h4 class="fw-bold mb-20">
                            4. How can I track a payout?
                        </h4>

                        <p class="mb-0">
                            You can use the payout status and transaction
                            information provided through your configured
                            dashboard or integration, where available.
                        </p>
                    </div>


                    <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">
                        <h4 class="fw-bold mb-20">
                            5. What are the payout charges?
                        </h4>

                        <p class="mb-0">
                            Applicable fees may depend on the payout method,
                            transaction type and commercial terms agreed
                            for your account. Contact our team for the
                            current pricing applicable to your business.
                        </p>
                    </div>


                    <div class="card-style-eight rounded-5 vstack tran3s w-100 mb-30">
                        <h4 class="fw-bold mb-20">
                            6. How can I get started?
                        </h4>

                        <p class="mb-0">
                            Contact our team with your business requirements
                            to discuss onboarding, account funding, supported
                            payout methods and technical integration.
                        </p>
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
         Contact CTA
    ============================================== -->
    <div class="block-feature-ten position-relative mt-100 lg-mt-60 pb-100 lg-pb-60">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-8 wow fadeInUp">

                    <div class="title-one">
                        <h2>Ready to Simplify Your Business Payouts?</h2>
                    </div>

                    <p class="text-lg mt-30">
                        Discuss your payout volume, recipient requirements
                        and integration needs with the iPaylight team.
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


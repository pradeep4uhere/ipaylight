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
                            <img src="frontend/assets/img/dashboard_new.png" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="agency-about-content">
                            <span class="sub-title">Fraud & Risk Management</span>
                            <h2>Fraud & Risk Management</h2>
                            <div class="bar"></div>
                            <p>At Paygenius Payment Solutions Pvt Ltd, we understand that safeguarding your business against fraud and managing risk is crucial in today’s digital landscape. Our comprehensive Fraud & Risk Management solutions are designed to protect your business from fraudulent activities, ensure the security of transactions, and maintain the trust of your customers.</p>
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

<div class="services-area-two ptb-80 bg-f9f6f6">
    <div class="container">
        <div class="bg-dedede about-inner-area">
        <div class="container ">
            <div class="row">
            
            <div class="col-lg-4 col-md-12 image-section">
                <img src="{{asset('/assets/img/fraud.jpeg')}}" alt="#">
            </div>
            <div class="col-lg-8 col-md-12 text-section ">
                <h3>Key Features of Our Fraud & Risk Management</h3>
                <div class="bar"></div>
                <div class="about-text">
                    <p>Paygenius Payment Solutions Pvt Ltd is a pioneering leader in the payment processing industry, dedicated to transforming the way businesses handle transactions. With a deep understanding of the unique challenges faced by modern businesses, we offer innovative and comprehensive payment solutions tailored to meet the needs of e-commerce platforms, shopping carts, ERP and CRM systems, and more.</p>
                </div>
                <div>
                <div class="col-lg-12 col-md-6 col-sm-6">
					
                    <ul>
                    <li><p>Advanced Fraud Detection: Utilize cutting-edge algorithms and machine learning to detect and prevent fraudulent activities in real-time, minimizing the risk of financial loss.</p></li>
                    <li><p>Transaction Monitoring: Continuously monitor transactions for suspicious activity, using a combination of automated systems and expert analysis to identify potential threats.</p></li>
                    <li><p>Risk Scoring: Assign risk scores to transactions based on various criteria, enabling you to quickly assess and respond to potential risks.</p></li>
                    <li><p>Customizable Rules Engine: Create and implement custom rules tailored to your business needs, allowing you to fine-tune fraud detection and prevention strategies.</p></li>
                    <li><p>Multi-Layered Security: Employ multiple layers of security measures, including encryption, tokenization, and secure authentication, to protect sensitive information and reduce vulnerabilities.</p></li>
                    <li><p>Chargeback Management: Streamline the chargeback process with tools that help you track, manage, and dispute chargebacks effectively, reducing the impact on your business.</p></li>
                    <li><p>Compliance and Regulatory Support: Ensure compliance with industry standards and regulations, such as PCI DSS, GDPR, and AML, to maintain the integrity of your operations and avoid legal issues.</p></li>
                    <li><p>Real-Time Alerts: Receive instant notifications of suspicious activities, enabling you to take immediate action to mitigate risks.</p></li>
                    <li><p>Comprehensive Reporting: Access detailed reports and analytics on fraud and risk management activities, helping you stay informed and make data-driven decisions.</p></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@include('Page.bottomBanner')

@endsection
                
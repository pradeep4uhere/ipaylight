
@extends('layouts.Frontend.ipaylight_page')

@props(['title' => 'Privacy Policy'])

@section('content')

{{-- Inner Banner --}}
<div class="inner-banner-two light-bg text-center pt-200 md-pt-150 pb-85 lg-pb-50 position-relative">
    <div class="container position-relative">
        <div class="row">
            <div class="col-xl-9 m-auto">
                <ul class="style-none d-inline-flex justify-content-center pager flex-wrap">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="mx-2">/</li>
                    <li>Legal</li>
                    <li class="mx-2">/</li>
                    <li>Privacy Policy</li>
                </ul>

                <h1 class="hero-heading">Privacy Policy</h1>

                <p class="text-lg">
                    At iPaylight, operated by Ipaylight Technologies Pvt. Ltd.,
                    we respect your privacy and are committed to handling
                    personal and business information responsibly when you
                    use our website and payment-related services.
                </p>

                <p class="mt-3">
                    <small>Last updated: 11 October 2026</small>
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
</div>


{{-- Privacy Policy Content --}}
<div class="block-feature-ten position-relative mt-100 lg-mt-60 pb-100 lg-pb-60">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 mb-4">
                <div class="card-style-eight rounded-4 p-4">
                    <h4 class="fw-bold mb-3">On this page</h4>

                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#introduction">1. Introduction</a></li>
                        <li class="mb-2"><a href="#scope">2. Scope</a></li>
                        <li class="mb-2"><a href="#information">3. Information We Collect</a></li>
                        <li class="mb-2"><a href="#usage">4. How We Use Information</a></li>
                        <li class="mb-2"><a href="#payments">5. Payment Information</a></li>
                        <li class="mb-2"><a href="#cookies">6. Cookies</a></li>
                        <li class="mb-2"><a href="#sharing">7. Information Sharing</a></li>
                        <li class="mb-2"><a href="#security">8. Data Security</a></li>
                        <li class="mb-2"><a href="#retention">9. Data Retention</a></li>
                        <li class="mb-2"><a href="#rights">10. Your Privacy Rights</a></li>
                        <li class="mb-2"><a href="#children">11. Children's Privacy</a></li>
                        <li class="mb-2"><a href="#transfers">12. Data Transfers</a></li>
                        <li class="mb-2"><a href="#third-party">13. Third-Party Links</a></li>
                        <li class="mb-2"><a href="#changes">14. Policy Updates</a></li>
                        <li class="mb-2"><a href="#contact">15. Contact Us</a></li>
                    </ul>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9">
                <div class="title-one mb-5">
                    <h2>Your Privacy Matters</h2>

                    <p class="text-lg mt-3">
                        This Privacy Policy explains how iPaylight may collect,
                        use, disclose, store and protect information when you
                        visit our website, contact us, register for our
                        services or use our payment technology solutions.
                    </p>

                    <p>
                        Please read this policy carefully to understand
                        our privacy practices.
                    </p>
                </div>

                <div class="legal-content">

                    {{-- 1 --}}
                    <section id="introduction" class="mb-5">
                        <h3 class="fw-bold mb-3">1. Introduction</h3>

                        <p>
                            iPaylight is a payment infrastructure platform
                            operated by Ipaylight Technologies Pvt. Ltd.
                            ("iPaylight", "Company", "we", "our" or "us").
                        </p>

                        <p>
                            We provide technology and related services that
                            may support digital payment collection, payouts,
                            payment integrations, APIs, dashboards and
                            transaction reconciliation for eligible businesses.
                        </p>

                        <p>
                            We recognise that privacy and the protection of
                            personal information are important. We aim to
                            process information in a lawful, fair and
                            transparent manner and apply appropriate
                            safeguards based on the nature of the information
                            and the services provided.
                        </p>

                        <p>
                            This policy should be read together with our
                            Terms and Conditions and any additional privacy
                            notices or agreements applicable to a particular
                            service.
                        </p>
                    </section>

                    {{-- 2 --}}
                    <section id="scope" class="mb-5">
                        <h3 class="fw-bold mb-3">2. Scope of This Policy</h3>

                        <p>This policy applies, as relevant, to information
                            processed in connection with:</p>

                        <ul>
                            <li>Visitors to our website.</li>
                            <li>Businesses and merchants enquiring about our services.</li>
                            <li>Merchant representatives and authorised account users.</li>
                            <li>Customers whose payment information is processed through an applicable service.</li>
                            <li>Individuals contacting our support or sales teams.</li>
                            <li>Developers using our APIs, integration tools or documentation.</li>
                        </ul>

                        <p>
                            Some information may be processed by banks,
                            payment aggregators or other service providers
                            under their own privacy policies and legal
                            responsibilities.
                        </p>

                        <p>
                            Where iPaylight processes personal information
                            on behalf of a merchant or another organisation,
                            the relevant contractual arrangements and
                            applicable law will determine the respective
                            responsibilities of the parties.
                        </p>
                    </section>

                    {{-- 3 --}}
                    <section id="information" class="mb-5">
                        <h3 class="fw-bold mb-3">3. Information We Collect</h3>

                        <p>
                            The information we collect depends on how you
                            interact with our website and services.
                            We seek to collect information relevant to
                            the purposes described in this policy.
                        </p>

                        <h5 class="fw-bold mt-4 mb-2">3.1 Personal and Contact Information</h5>

                        <p>We may collect information such as:</p>

                        <ul>
                            <li>Name and business designation.</li>
                            <li>Business email address and telephone number.</li>
                            <li>Business name, address and website.</li>
                            <li>Information submitted through contact, sales or support forms.</li>
                            <li>Communication and support request details.</li>
                        </ul>

                        <h5 class="fw-bold mt-4 mb-2">3.2 Business and Verification Information</h5>

                        <p>
                            For merchant onboarding or compliance purposes,
                            we may collect relevant business registration
                            details, tax information, authorised
                            representative details, verification documents
                            and business bank account information.
                        </p>

                        <p>
                            The specific documents requested depend on the
                            service, applicable law and the requirements
                            of relevant payment or financial partners.
                        </p>

                        <h5 class="fw-bold mt-4 mb-2">3.3 Transaction Information</h5>

                        <p>
                            Where relevant to a service, information may
                            include transaction references, payment amounts,
                            timestamps, transaction status, payment method,
                            refund details, payout instructions and
                            reconciliation records.
                        </p>

                        <p>
                            The information available to iPaylight depends
                            on the payment integration and the role we
                            perform in the transaction.
                        </p>

                        <h5 class="fw-bold mt-4 mb-2">3.4 Technical Information</h5>

                        <p>
                            When you access our website or technology
                            services, we may collect technical information,
                            including:
                        </p>

                        <ul>
                            <li>IP address and general connection information.</li>
                            <li>Browser type, operating system and device information.</li>
                            <li>Pages viewed, referring URLs and interaction data.</li>
                            <li>Access timestamps, diagnostic records and error logs.</li>
                            <li>Security events and information needed to investigate suspicious activity.</li>
                        </ul>

                        <h5 class="fw-bold mt-4 mb-2">3.5 Information From Other Sources</h5>

                        <p>
                            Where legally permitted and necessary, we may
                            receive information from merchants, payment
                            partners, verification providers, fraud
                            prevention services and other authorised sources.
                        </p>

                        <p>
                            We do not intend to collect more information
                            than is reasonably necessary for the relevant
                            purpose, subject to legal, contractual and
                            operational requirements.
                        </p>
                    </section>

                    {{-- 4 --}}
                    <section id="usage" class="mb-5">
                        <h3 class="fw-bold mb-3">4. How We Use Your Information</h3>

                        <p>
                            We may use information for the following
                            purposes, where applicable and legally permitted:
                        </p>

                        <ul>
                            <li>Responding to enquiries and providing customer support.</li>
                            <li>Creating, managing and maintaining merchant accounts.</li>
                            <li>Providing payment technology, integration and reporting services.</li>
                            <li>Processing and reconciling transactions through applicable arrangements.</li>
                            <li>Conducting onboarding, identity verification and business checks.</li>
                            <li>Detecting, investigating and preventing fraud, misuse and security incidents.</li>
                            <li>Maintaining, troubleshooting and improving our website and services.</li>
                            <li>Sending important service, security and operational communications.</li>
                            <li>Managing billing, fees and contractual obligations.</li>
                            <li>Complying with applicable laws, lawful requests and regulatory requirements.</li>
                            <li>Establishing, exercising or defending legal claims where necessary.</li>
                        </ul>

                        <p>
                            Where required by applicable law, we will obtain
                            consent or identify another valid legal basis
                            before processing personal information for a
                            particular purpose.
                        </p>

                        <p>
                            We will not use personal information for
                            materially unrelated purposes without an
                            appropriate legal basis or any notice or
                            consent required by law.
                        </p>
                    </section>

                    {{-- 5 --}}
                    <section id="payments" class="mb-5">
                        <h3 class="fw-bold mb-3">5. Payment and Financial Information</h3>

                        <p>
                            Payment-related information requires appropriate
                            safeguards. Depending on the service, iPaylight
                            may process transaction identifiers, payment
                            status, amounts, beneficiary details and
                            information required for reconciliation.
                        </p>

                        <p>
                            Sensitive payment credentials and financial
                            authentication information are handled according
                            to the relevant payment integration, security
                            requirements and applicable law.
                        </p>

                        <p>
                            We do not ask users to disclose passwords,
                            PINs, one-time passwords (OTPs) or other
                            authentication secrets through ordinary
                            email or unsolicited communications.
                        </p>

                        <p>
                            Depending on our role and the applicable
                            integration, certain payment information may
                            be collected or processed directly by a bank,
                            authorised payment aggregator or other
                            payment service provider.
                        </p>

                        <p>
                            Users should review the privacy notices of
                            the relevant payment provider where that
                            provider independently collects or processes
                            their information.
                        </p>
                    </section>

                    {{-- 6 --}}
                    <section id="cookies" class="mb-5">
                        <h3 class="fw-bold mb-3">6. Cookies and Similar Technologies</h3>

                        <p>
                            Our website may use cookies, session storage
                            or similar technologies to support website
                            functionality, maintain sessions, remember
                            preferences, improve performance and protect
                            against security threats.
                        </p>

                        <p>
                            Depending on the tools actually implemented,
                            these technologies may be used for analytics
                            or to understand how visitors interact with
                            our website.
                        </p>

                        <p>
                            Essential cookies may be required for certain
                            website features to function. Where required
                            by law, we will seek consent before using
                            non-essential cookies or similar technologies.
                        </p>

                        <p>
                            You may be able to manage cookies through
                            your browser settings. Blocking certain cookies
                            may affect the availability or functionality
                            of some features.
                        </p>

                        <p>
                            The categories and duration of cookies used
                            should be described in a cookie notice or
                            cookie preference tool if such functionality
                            is implemented on our website.
                        </p>
                    </section>

                    {{-- 7 --}}
                    <section id="sharing" class="mb-5">
                        <h3 class="fw-bold mb-3">7. How We Share Information</h3>

                        <p>
                            We do not treat personal information as a
                            product for sale. We may disclose information
                            where necessary for the purposes described
                            in this policy and as permitted by law.
                        </p>

                        <p>Depending on the circumstances, recipients may include:</p>

                        <ul>
                            <li>
                                <strong>Payment partners:</strong>
                                Banks, authorised payment aggregators,
                                payment networks and relevant transaction
                                processing providers.
                            </li>

                            <li>
                                <strong>Technology providers:</strong>
                                Hosting, infrastructure, security,
                                monitoring, communications and support
                                providers.
                            </li>

                            <li>
                                <strong>Verification and fraud prevention providers:</strong>
                                Providers supporting identity checks,
                                risk assessment and transaction security.
                            </li>

                            <li>
                                <strong>Professional advisers:</strong>
                                Lawyers, auditors, accountants and other
                                advisers where reasonably necessary.
                            </li>

                            <li>
                                <strong>Authorities and regulators:</strong>
                                Where disclosure is required or permitted
                                under applicable law or a lawful request.
                            </li>

                            <li>
                                <strong>Business transfers:</strong>
                                Relevant parties in connection with a
                                merger, restructuring, acquisition or
                                transfer of business, subject to applicable
                                legal safeguards.
                            </li>
                        </ul>

                        <p>
                            We expect service providers handling personal
                            information on our behalf to be subject to
                            appropriate contractual, confidentiality and
                            security obligations, as applicable.
                        </p>

                        <p>
                            We may also share information where necessary
                            to protect users, investigate suspected fraud,
                            enforce our agreements or establish and defend
                            legal claims.
                        </p>
                    </section>

                    {{-- 8 --}}
                    <section id="security" class="mb-5">
                        <h3 class="fw-bold mb-3">8. Data Security</h3>

                        <p>
                            We seek to implement reasonable technical
                            and organisational safeguards designed to
                            protect information against unauthorised
                            access, loss, misuse, alteration and disclosure.
                        </p>

                        <p>
                            Depending on the nature of the service and
                            associated risks, safeguards may include:
                        </p>

                        <ul>
                            <li>Access controls and authentication measures.</li>
                            <li>Secure communication and transmission mechanisms.</li>
                            <li>Monitoring, logging and security reviews.</li>
                            <li>Credential management and restricted system access.</li>
                            <li>Backup and recovery procedures where appropriate.</li>
                            <li>Processes for identifying and responding to security incidents.</li>
                        </ul>

                        <p>
                            No website, network or electronic storage
                            system can be guaranteed to be completely
                            secure. We cannot promise absolute security,
                            but we aim to maintain safeguards appropriate
                            to the information we process.
                        </p>

                        <p>
                            If a personal data breach occurs, we will
                            assess and respond to it in accordance with
                            applicable legal obligations.
                        </p>

                        <p>
                            Users and merchants should protect their
                            passwords, API keys, devices and account
                            credentials and promptly report suspected
                            unauthorised access.
                        </p>
                    </section>

                    {{-- 9 --}}
                    <section id="retention" class="mb-5">
                        <h3 class="fw-bold mb-3">9. Data Retention</h3>

                        <p>
                            We retain personal information only for as
                            long as reasonably necessary for the purposes
                            for which it was collected, unless a longer
                            retention period is required or permitted
                            by applicable law.
                        </p>

                        <p>
                            Retention periods may depend on the type of
                            information, the services provided, contractual
                            requirements, payment-related recordkeeping
                            obligations, dispute resolution and legal
                            requirements.
                        </p>

                        <p>
                            When information is no longer required, we
                            will take appropriate steps to delete it,
                            anonymise it or otherwise handle it in
                            accordance with applicable law and our
                            retention procedures.
                        </p>

                        <p>
                            Certain information may remain in secure
                            backups or records for a limited period
                            before being removed in accordance with
                            applicable procedures.
                        </p>
                    </section>

                    {{-- 10 --}}
                    <section id="rights" class="mb-5">
                        <h3 class="fw-bold mb-3">10. Your Privacy Rights and Choices</h3>

                        <p>
                            Depending on applicable law and the context
                            in which we process your information, you
                            may have rights relating to your personal data.
                            These may include:
                        </p>

                        <ul>
                            <li>Requesting information about personal data processing.</li>
                            <li>Requesting access to or a copy of eligible personal information.</li>
                            <li>Requesting correction or updating of inaccurate information.</li>
                            <li>Requesting erasure where legally applicable.</li>
                            <li>Withdrawing consent where processing is based on consent.</li>
                            <li>Raising a grievance or privacy-related complaint.</li>
                            <li>Exercising other rights available under applicable law.</li>
                        </ul>

                        <p>
                            These rights may be subject to legal exceptions,
                            record-retention obligations, transaction
                            requirements and the rights of other individuals.
                        </p>

                        <p>
                            To protect your information, we may need to
                            verify your identity or authority before
                            responding to a request.
                        </p>

                        <p>
                            Where another organisation controls the
                            relevant processing, we may direct you to
                            that organisation or coordinate with it
                            as appropriate.
                        </p>

                        <p>
                            You may submit a privacy request or grievance
                            using the official contact details published
                            on our website. We will handle eligible
                            requests in accordance with applicable law.
                        </p>
                    </section>

                    {{-- 11 --}}
                    <section id="children" class="mb-5">
                        <h3 class="fw-bold mb-3">11. Children's Privacy</h3>

                        <p>
                            Our merchant-facing payment infrastructure
                            services are intended for businesses and
                            authorised users rather than for independent
                            use by children.
                        </p>

                        <p>
                            We do not knowingly seek to collect children's
                            personal information through our website
                            unless such collection is appropriate for
                            the relevant service and complies with
                            applicable law.
                        </p>

                        <p>
                            If you believe that personal information
                            relating to a child has been submitted
                            inappropriately, please contact us so that
                            we can assess the matter and take appropriate
                            action as required by law.
                        </p>
                    </section>

                    {{-- 12 --}}
                    <section id="transfers" class="mb-5">
                        <h3 class="fw-bold mb-3">12. Data Processing and Transfers</h3>

                        <p>
                            Information may be processed or stored in
                            locations where we or our authorised service
                            providers operate, subject to applicable
                            legal requirements.
                        </p>

                        <p>
                            Where information is transferred across
                            jurisdictions, we will apply safeguards
                            required by applicable law and relevant
                            contractual arrangements.
                        </p>

                        <p>
                            Cross-border transfers of personal data
                            will be handled in accordance with applicable
                            Indian data protection requirements and any
                            other laws that apply to the relevant
                            processing activity.
                        </p>
                    </section>

                    {{-- 13 --}}
                    <section id="third-party" class="mb-5">
                        <h3 class="fw-bold mb-3">13. Third-Party Websites and Services</h3>

                        <p>
                            Our website may contain links to third-party
                            websites, payment providers, documentation
                            or other external services.
                        </p>

                        <p>
                            These third parties may have their own
                            privacy policies, terms and data handling
                            practices. We encourage you to review those
                            policies before providing information to them.
                        </p>

                        <p>
                            The inclusion of a link does not necessarily
                            mean that iPaylight endorses the third party
                            or controls its privacy practices.
                        </p>
                    </section>

                    {{-- 14 --}}
                    <section id="changes" class="mb-5">
                        <h3 class="fw-bold mb-3">14. Changes to This Privacy Policy</h3>

                        <p>
                            We may update this Privacy Policy to reflect
                            changes in our services, information handling
                            practices, technology or applicable legal
                            requirements.
                        </p>

                        <p>
                            Updated versions will be published on this
                            page with a revised last-updated date.
                        </p>

                        <p>
                            Where required by law, we will provide
                            additional notice or obtain consent before
                            implementing changes that require it.
                        </p>

                        <p>
                            We encourage you to review this page
                            periodically to remain informed about our
                            privacy practices.
                        </p>
                    </section>

                    {{-- 15 --}}
                    <section id="contact" class="mb-5">
                        <h3 class="fw-bold mb-3">15. Contact Us and Privacy Grievances</h3>

                        <p>
                            If you have questions about this Privacy
                            Policy, wish to exercise a privacy right
                            or want to raise a complaint concerning
                            personal information, please contact
                            Ipaylight Technologies Pvt. Ltd. using
                            the official contact details published
                            on our website.
                        </p>

                        <div class="card-style-eight rounded-4 p-4 mt-4">
                            <h4 class="fw-bold mb-3">
                                Ipaylight Technologies Pvt. Ltd.
                            </h4>

                            <p>
                                <strong>Website:</strong>
                                <a href="https://ipaylight.com/"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    https://ipaylight.com/
                                </a>
                            </p>

                            <p>
                                <strong>Contact:</strong>
                                Please refer to the official Contact Us
                                page for verified contact details.
                            </p>

                            <p class="mb-0">
                                When submitting a privacy request,
                                please provide sufficient information
                                for us to understand and verify your
                                request. Do not send passwords, OTPs
                                or payment authentication secrets.
                            </p>
                        </div>
                    </section>

                    {{-- Important Notice --}}
                    <div class="alert alert-light border rounded-4 p-4">
                        <h5 class="fw-bold">Privacy Notice</h5>

                        <p class="mb-0">
                            This document is a general Privacy Policy
                            drafting template. Before publication,
                            confirm that it accurately reflects
                            iPaylight's actual data collection,
                            cookies, payment integrations, service
                            providers, retention periods, grievance
                            process and applicable legal obligations.
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


{{-- Page-specific responsive styling --}}
<style>
    .legal-content {
        color: #555;
        font-size: 16px;
        line-height: 1.85;
        overflow-wrap: anywhere;
    }

    .legal-content section {
        scroll-margin-top: 100px;
    }

    .legal-content h3 {
        color: #111;
        font-size: 24px;
        line-height: 1.4;
    }

    .legal-content h5 {
        color: #222;
        font-size: 18px;
        line-height: 1.5;
    }

    .legal-content p {
        margin-bottom: 16px;
    }

    .legal-content ul {
        padding-left: 24px;
        margin-bottom: 20px;
    }

    .legal-content li {
        margin-bottom: 10px;
    }

    .legal-content a,
    .card-style-eight a {
        overflow-wrap: anywhere;
    }

    @media (max-width: 767px) {
        .legal-content {
            font-size: 15px;
            line-height: 1.8;
        }

        .legal-content h3 {
            font-size: 21px;
        }
    }
</style>

@endsection

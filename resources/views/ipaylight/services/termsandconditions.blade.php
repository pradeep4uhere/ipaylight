
@extends('layouts.Frontend.ipaylight_page')

@props(['title' => 'Terms and Conditions'])

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
                    <li>Terms and Conditions</li>
                </ul>

                <h1 class="hero-heading">Terms and Conditions</h1>

                <p class="text-lg">
                    Please read these Terms and Conditions carefully before
                    accessing or using iPaylight's website, payment services,
                    payout solutions, APIs and related business products.
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
{{-- /.inner-banner-two --}}


{{-- Terms and Conditions Content --}}
<div class="block-feature-ten position-relative mt-100 lg-mt-60 pb-100 lg-pb-60">
    <div class="container">

        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card-style-eight rounded-4 p-4">
                    <h4 class="fw-bold mb-3">On this page</h4>

                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#introduction">1. Introduction</a></li>
                        <li class="mb-2"><a href="#definitions">2. Definitions</a></li>
                        <li class="mb-2"><a href="#eligibility">3. Eligibility</a></li>
                        <li class="mb-2"><a href="#services">4. Our Services</a></li>
                        <li class="mb-2"><a href="#account">5. Account and KYC</a></li>
                        <li class="mb-2"><a href="#payments">6. Payments</a></li>
                        <li class="mb-2"><a href="#payouts">7. Payouts</a></li>
                        <li class="mb-2"><a href="#fees">8. Fees and Taxes</a></li>
                        <li class="mb-2"><a href="#refunds">9. Refunds and Disputes</a></li>
                        <li class="mb-2"><a href="#prohibited">10. Prohibited Activities</a></li>
                        <li class="mb-2"><a href="#security">11. Security</a></li>
                        <li class="mb-2"><a href="#privacy">12. Privacy</a></li>
                        <li class="mb-2"><a href="#availability">13. Availability</a></li>
                        <li class="mb-2"><a href="#liability">14. Liability</a></li>
                        <li class="mb-2"><a href="#termination">15. Suspension</a></li>
                        <li class="mb-2"><a href="#law">16. Governing Law</a></li>
                        <li class="mb-2"><a href="#contact">17. Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9">

                <div class="title-one mb-4">
                    <h2>Terms of Use</h2>
                    <p class="text-lg mt-3">
                        These Terms and Conditions govern your access to and
                        use of the iPaylight website and the services made
                        available through it.
                    </p>
                </div>

                <div class="legal-content">

                    {{-- 1. Introduction --}}
                    <section id="introduction" class="mb-5">
                        <h3 class="fw-bold mb-3">1. Introduction</h3>

                        <p>
                            Welcome to iPaylight, a payment infrastructure
                            platform operated by Ipaylight Technologies Pvt. Ltd.
                            ("iPaylight", "Company", "we", "our" or "us").
                        </p>

                        <p>
                            iPaylight provides technology and related services
                            intended to help eligible businesses manage digital
                            payment collection, payouts, payment integrations,
                            transaction reporting and reconciliation.
                        </p>

                        <p>
                            These Terms and Conditions ("Terms") apply to your
                            access to our website, products, dashboards, APIs
                            and related services, where applicable.
                        </p>

                        <p>
                            By accessing our website, registering an account,
                            accepting a service agreement or using a service
                            governed by these Terms, you acknowledge that you
                            have read and understood the applicable provisions.
                        </p>

                        <p>
                            If you do not agree to these Terms, you must not
                            use the services to which they apply.
                        </p>

                        <p>
                            Certain services may be subject to additional
                            agreements, onboarding requirements, product-specific
                            terms or terms imposed by banks, payment networks,
                            payment aggregators and other authorised service
                            providers. Those terms will apply where relevant.
                        </p>
                    </section>

                    {{-- 2. Definitions --}}
                    <section id="definitions" class="mb-5">
                        <h3 class="fw-bold mb-3">2. Definitions</h3>

                        <p>For the purposes of these Terms:</p>

                        <ul>
                            <li>
                                <strong>"Merchant"</strong> means a business,
                                organisation, sole proprietor or other eligible
                                entity that uses or applies to use our services.
                            </li>

                            <li>
                                <strong>"User"</strong> means any individual
                                accessing the website or using our services.
                            </li>

                            <li>
                                <strong>"Services"</strong> means the payment
                                technology, payment integrations, collection
                                solutions, payout facilities, APIs, dashboards,
                                reporting tools and related services made
                                available by iPaylight.
                            </li>

                            <li>
                                <strong>"Payment Partner"</strong> means a bank,
                                authorised payment aggregator, payment network
                                or other third-party provider involved in
                                delivering a service.
                            </li>

                            <li>
                                <strong>"Transaction"</strong> means a payment,
                                collection, refund, payout or other transaction
                                initiated or processed through an applicable
                                service.
                            </li>

                            <li>
                                <strong>"Merchant Account"</strong> means an
                                account or business profile created or enabled
                                for access to applicable merchant services.
                            </li>
                        </ul>
                    </section>

                    {{-- 3. Eligibility --}}
                    <section id="eligibility" class="mb-5">
                        <h3 class="fw-bold mb-3">3. Eligibility</h3>

                        <p>
                            Our merchant services are intended for businesses
                            and organisations that meet the applicable legal,
                            technical, commercial and onboarding requirements.
                        </p>

                        <p>By using the services, you represent that:</p>

                        <ul>
                            <li>
                                You have the legal capacity and authority to
                                accept these Terms.
                            </li>

                            <li>
                                If acting on behalf of an organisation, you
                                are authorised to bind that organisation.
                            </li>

                            <li>
                                Information provided by you is accurate,
                                complete and not misleading.
                            </li>

                            <li>
                                Your business activities and transactions
                                comply with applicable laws and regulations.
                            </li>

                            <li>
                                You will comply with applicable requirements
                                of our Payment Partners.
                            </li>
                        </ul>

                        <p>
                            We may decline an application where onboarding
                            requirements are not met or where permitted by
                            applicable law, contractual obligations or
                            Payment Partner requirements.
                        </p>
                    </section>

                    {{-- 4. Services --}}
                    <section id="services" class="mb-5">
                        <h3 class="fw-bold mb-3">4. Our Services</h3>

                        <p>
                            Depending on eligibility, availability and the
                            applicable service agreement, iPaylight may provide
                            the following technology and payment-related
                            services:
                        </p>

                        <ul>
                            <li>
                                <strong>Payment collection:</strong>
                                Technology integrations that enable eligible
                                merchants to accept payments through supported
                                payment methods.
                            </li>

                            <li>
                                <strong>Payment gateway integration:</strong>
                                Tools and APIs for integrating payment
                                functionality with websites and applications.
                            </li>

                            <li>
                                <strong>Bulk payouts:</strong>
                                Supported workflows for initiating payouts
                                to eligible bank accounts or UPI addresses.
                            </li>

                            <li>
                                <strong>Payment reporting:</strong>
                                Dashboards, transaction records and
                                reconciliation-related tools.
                            </li>

                            <li>
                                <strong>Developer tools:</strong>
                                APIs, integration documentation, technical
                                support and related functionality.
                            </li>
                        </ul>

                        <p>
                            The availability of a payment method or feature
                            depends on the applicable integration, merchant
                            approval, Payment Partner support and other
                            relevant conditions.
                        </p>

                        <p>
                            iPaylight does not represent that every service is
                            available to every business or in every location.
                            The precise scope of services will be determined
                            by the applicable agreement and onboarding approval.
                        </p>
                    </section>

                    {{-- 5. Account and KYC --}}
                    <section id="account" class="mb-5">
                        <h3 class="fw-bold mb-3">5. Account Registration and KYC</h3>

                        <p>
                            Merchants may be required to register an account
                            and provide business, identity, banking, tax and
                            other information relevant to onboarding and
                            ongoing compliance.
                        </p>

                        <p>
                            Where applicable, merchants must complete
                            Know Your Customer (KYC), business verification
                            and other checks required by law or relevant
                            Payment Partners.
                        </p>

                        <p>You agree to:</p>

                        <ul>
                            <li>
                                Provide accurate, current and complete
                                registration and verification information.
                            </li>

                            <li>
                                Update information when relevant details
                                change.
                            </li>

                            <li>
                                Provide supporting documents reasonably
                                required for verification and compliance.
                            </li>

                            <li>
                                Maintain the confidentiality of your account
                                credentials, passwords, API keys and access
                                tokens.
                            </li>

                            <li>
                                Notify us promptly if you suspect unauthorised
                                access or misuse of your account.
                            </li>
                        </ul>

                        <p>
                            We may request additional information or verification
                            documents where required for compliance, fraud
                            prevention, risk assessment or Payment Partner
                            requirements.
                        </p>

                        <p>
                            Incomplete verification may result in delayed
                            onboarding, restricted functionality or suspension
                            of applicable services, subject to applicable law
                            and contractual requirements.
                        </p>
                    </section>

                    {{-- 6. Payments --}}
                    <section id="payments" class="mb-5">
                        <h3 class="fw-bold mb-3">6. Payment Collection and Transactions</h3>

                        <p>
                            Merchants are responsible for the accuracy and
                            legitimacy of the goods, services, invoices and
                            payment instructions associated with their
                            transactions.
                        </p>

                        <p>
                            A transaction may be subject to authorisation,
                            validation, fraud screening, technical processing,
                            settlement procedures and the rules of the
                            applicable Payment Partner.
                        </p>

                        <p>
                            A payment initiation, request or displayed
                            transaction status does not by itself guarantee
                            successful completion or final settlement.
                            Merchants should rely on the applicable confirmed
                            transaction status and reconciliation records.
                        </p>

                        <p>Merchants must:</p>

                        <ul>
                            <li>
                                Provide accurate payment amounts and
                                transaction references.
                            </li>

                            <li>
                                Avoid submitting duplicate or unauthorised
                                payment requests.
                            </li>

                            <li>
                                Verify transaction status before fulfilling
                                orders or providing services where appropriate.
                            </li>

                            <li>
                                Maintain transaction records and supporting
                                documentation.
                            </li>

                            <li>
                                Cooperate with legitimate transaction reviews,
                                disputes and investigations.
                            </li>
                        </ul>

                        <p>
                            Transactions may be declined, delayed, reversed,
                            returned or placed under review in circumstances
                            permitted by applicable law, Payment Partner rules
                            or the relevant service agreement.
                        </p>
                    </section>

                    {{-- 7. Payouts --}}
                    <section id="payouts" class="mb-5">
                        <h3 class="fw-bold mb-3">7. Payout Services</h3>

                        <p>
                            Where payout services are enabled, eligible
                            merchants may be able to submit payment instructions
                            to supported bank accounts, UPI addresses or
                            other supported destinations.
                        </p>

                        <p>
                            Merchants are responsible for verifying recipient
                            details, payout amounts, payment references and
                            the authority to initiate each payout.
                        </p>

                        <p>
                            Payout processing and completion may depend on
                            available balances, account verification, applicable
                            transaction limits, banking hours, payment network
                            availability, risk checks and Payment Partner
                            processing times.
                        </p>

                        <p>
                            We do not guarantee a specific payout completion
                            time unless expressly agreed in writing.
                        </p>

                        <p>
                            Incorrect beneficiary information, insufficient
                            funds, technical failures, compliance reviews or
                            receiving-bank restrictions may result in failed,
                            delayed or returned payouts.
                        </p>

                        <p>
                            You must not use payout services for unlawful
                            transfers, unauthorised disbursements or activities
                            prohibited under applicable law or the relevant
                            service agreement.
                        </p>
                    </section>

                    {{-- 8. Fees and Taxes --}}
                    <section id="fees" class="mb-5">
                        <h3 class="fw-bold mb-3">8. Fees, Charges and Taxes</h3>

                        <p>
                            Applicable service fees, transaction charges,
                            payout charges, subscription charges and other
                            commercial terms will be communicated through the
                            relevant pricing schedule, proposal, order form
                            or service agreement.
                        </p>

                        <p>
                            You agree to pay the applicable charges in
                            accordance with the agreed payment terms.
                            Applicable taxes, including GST where required,
                            may be charged in addition to the stated fees.
                        </p>

                        <p>
                            Fees may vary according to service type, transaction
                            volume, payment method, commercial arrangement and
                            applicable third-party charges.
                        </p>

                        <p>
                            Any changes to applicable pricing will be
                            communicated in accordance with the relevant
                            agreement and applicable law.
                        </p>

                        <p>
                            You are responsible for taxes, duties and other
                            statutory obligations applicable to your business
                            and transactions, except where the law requires
                            otherwise.
                        </p>
                    </section>

                    {{-- 9. Refunds and Disputes --}}
                    <section id="refunds" class="mb-5">
                        <h3 class="fw-bold mb-3">9. Refunds, Reversals and Disputes</h3>

                        <p>
                            Refunds and reversals are subject to the applicable
                            payment method, transaction status, Payment Partner
                            rules, merchant agreement and applicable law.
                        </p>

                        <p>
                            Merchants are responsible for maintaining and
                            communicating their customer refund, cancellation
                            and return policies where applicable.
                        </p>

                        <p>
                            A refund request does not guarantee that the
                            transaction will be refunded or reversed. Processing
                            times may vary depending on the relevant payment
                            network and financial institution.
                        </p>

                        <p>
                            Merchants must respond promptly to legitimate
                            customer complaints, chargebacks, disputes,
                            payment investigations and requests for supporting
                            transaction information.
                        </p>

                        <p>
                            Any refund-related service fees, processing charges
                            or adjustments will be governed by the applicable
                            commercial agreement and Payment Partner rules.
                        </p>

                        <p>
                            Customers should generally contact the relevant
                            merchant regarding the underlying purchase, while
                            transaction-processing issues may also be raised
                            through the appropriate payment support channel.
                        </p>
                    </section>

                    {{-- 10. Prohibited Activities --}}
                    <section id="prohibited" class="mb-5">
                        <h3 class="fw-bold mb-3">10. Prohibited and Restricted Activities</h3>

                        <p>
                            You must not use the website or services to
                            facilitate unlawful, fraudulent, deceptive or
                            unauthorised activities.
                        </p>

                        <p>Prohibited activities include, where applicable:</p>

                        <ul>
                            <li>
                                Money laundering, terrorist financing or
                                transactions intended to conceal unlawful funds.
                            </li>

                            <li>
                                Fraud, impersonation, identity theft or
                                unauthorised use of payment instruments.
                            </li>

                            <li>
                                Transactions involving prohibited goods,
                                services or business activities.
                            </li>

                            <li>
                                Circumvention of applicable sanctions,
                                regulatory restrictions or transaction limits.
                            </li>

                            <li>
                                Use of the services for unauthorised gambling,
                                illegal financial schemes or other unlawful
                                activities.
                            </li>

                            <li>
                                Submission of false, misleading or forged
                                onboarding or transaction information.
                            </li>

                            <li>
                                Unauthorised access to systems, APIs, accounts
                                or other users' information.
                            </li>

                            <li>
                                Malware distribution, security exploitation,
                                interference with service availability or
                                attempts to bypass security controls.
                            </li>

                            <li>
                                Any activity prohibited by applicable law,
                                Payment Partner policies or the relevant
                                merchant agreement.
                            </li>
                        </ul>

                        <p>
                            We may investigate suspected violations and take
                            proportionate action, including restricting
                            transactions, requesting further information,
                            suspending access or terminating services where
                            permitted by law and the applicable agreement.
                        </p>
                    </section>

                    {{-- 11. Security --}}
                    <section id="security" class="mb-5">
                        <h3 class="fw-bold mb-3">11. Security and API Usage</h3>

                        <p>
                            Merchants using dashboards, APIs, webhooks or
                            other integration tools must implement reasonable
                            security measures appropriate to their systems
                            and business operations.
                        </p>

                        <p>You agree to:</p>

                        <ul>
                            <li>
                                Keep API credentials, secret keys and access
                                tokens confidential.
                            </li>

                            <li>
                                Avoid exposing secret credentials in public
                                repositories, browser-side code or public
                                client applications.
                            </li>

                            <li>
                                Use appropriate authentication, access
                                controls and secure communication methods.
                            </li>

                            <li>
                                Validate payment status using the appropriate
                                server-side verification or reconciliation
                                mechanisms.
                            </li>

                            <li>
                                Protect systems that store or process
                                transaction and customer information.
                            </li>

                            <li>
                                Notify us promptly of suspected credential
                                compromise, unauthorised access or security
                                incidents affecting the services.
                            </li>
                        </ul>

                        <p>
                            API usage may be subject to rate limits,
                            authentication requirements, technical
                            documentation and additional integration
                            conditions.
                        </p>

                        <p>
                            You must not probe, scan, disrupt or attempt
                            unauthorised access to our infrastructure or
                            the systems of our Payment Partners.
                        </p>
                    </section>

                    {{-- 12. Privacy --}}
                    <section id="privacy" class="mb-5">
                        <h3 class="fw-bold mb-3">12. Privacy and Data Protection</h3>

                        <p>
                            We may process personal information, business
                            information and transaction-related data as
                            necessary to provide the services, manage accounts,
                            support transactions, prevent fraud, meet legal
                            obligations and maintain our systems.
                        </p>

                        <p>
                            The collection, use, storage, disclosure and
                            protection of personal information will be governed
                            by applicable data protection laws and our
                            applicable privacy notice or privacy policy.
                        </p>

                        <p>
                            Merchants must ensure that they have an appropriate
                            legal basis and any required notices, permissions
                            or consents for personal information they submit
                            to or process through the services.
                        </p>

                        <p>
                            Merchants must not upload or transmit information
                            they are not authorised to share.
                        </p>

                        <p>
                            Data may be shared with relevant banks, Payment
                            Partners, service providers, professional advisers
                            or authorities where necessary for service delivery,
                            security, dispute handling or legal compliance,
                            subject to applicable law and contractual
                            obligations.
                        </p>

                        <p>
                            Please refer to our Privacy Policy for further
                            information about personal data handling.
                            If a privacy policy is published on this website,
                            insert its verified URL here.
                        </p>
                    </section>

                    {{-- 13. Availability --}}
                    <section id="availability" class="mb-5">
                        <h3 class="fw-bold mb-3">13. Service Availability and Third Parties</h3>

                        <p>
                            We aim to maintain reliable services but do not
                            guarantee uninterrupted, error-free or continuous
                            availability unless expressly agreed in a separate
                            written service-level agreement.
                        </p>

                        <p>
                            Services may be temporarily unavailable due to
                            maintenance, system upgrades, connectivity issues,
                            security incidents, banking outages, payment
                            network interruptions or circumstances beyond
                            our reasonable control.
                        </p>

                        <p>
                            Some functionalities depend on third-party
                            providers, including banks, payment networks,
                            hosting providers and other technology services.
                        </p>

                        <p>
                            Third-party services may be subject to their
                            own terms, operating rules, restrictions and
                            availability conditions.
                        </p>

                        <p>
                            We are not responsible for independently operated
                            third-party websites or services to the extent
                            permitted by applicable law. Nothing in these
                            Terms excludes responsibility that cannot legally
                            be excluded.
                        </p>
                    </section>

                    {{-- 14. Intellectual Property --}}
                    <section id="intellectual-property" class="mb-5">
                        <h3 class="fw-bold mb-3">14. Intellectual Property</h3>

                        <p>
                            Unless otherwise stated, the website and its
                            content, branding, design elements, software,
                            documentation, graphics and related materials
                            are owned by or licensed to iPaylight or the
                            applicable rights holder.
                        </p>

                        <p>
                            Subject to these Terms, we grant you a limited,
                            non-exclusive, non-transferable and revocable
                            right to access and use the services for their
                            intended and authorised business purposes.
                        </p>

                        <p>
                            You must not copy, modify, distribute, reverse
                            engineer, commercially exploit or create derivative
                            works from our protected materials except where
                            expressly authorised or permitted by applicable law.
                        </p>

                        <p>
                            You retain ownership of materials and information
                            that you lawfully own, subject to any rights
                            necessary for us to provide the agreed services.
                        </p>
                    </section>

                    {{-- 15. Liability --}}
                    <section id="liability" class="mb-5">
                        <h3 class="fw-bold mb-3">15. Disclaimers and Limitation of Liability</h3>

                        <p>
                            The website and its general informational content
                            are provided for their intended purposes.
                            Information published on the website should not
                            be interpreted as a guarantee of transaction
                            approval, settlement timing, uninterrupted service
                            or a particular business outcome.
                        </p>

                        <p>
                            To the extent permitted by applicable law, iPaylight
                            will not be liable for indirect, incidental,
                            special or consequential losses, including loss
                            of profits, business opportunities or anticipated
                            savings, arising from the use of the services.
                        </p>

                        <p>
                            Any exclusion or limitation of liability is subject
                            to applicable law and the terms of the relevant
                            service agreement. Nothing in these Terms excludes
                            liability that cannot legally be excluded or
                            limited.
                        </p>

                        <p>
                            Where a separate signed agreement sets out
                            specific liability limits, those provisions will
                            apply to the extent of any conflict and as
                            permitted by applicable law.
                        </p>
                    </section>

                    {{-- 16. Indemnification --}}
                    <section id="indemnification" class="mb-5">
                        <h3 class="fw-bold mb-3">16. Indemnification</h3>

                        <p>
                            To the extent permitted by applicable law, you
                            may be responsible for reasonable losses, claims,
                            liabilities and expenses arising from your
                            unlawful conduct, material breach of these Terms,
                            infringement of third-party rights or misuse
                            of the services.
                        </p>

                        <p>
                            Any indemnification obligation will be subject
                            to applicable law, the relevant service agreement
                            and the circumstances of the claim.
                        </p>
                    </section>

                    {{-- 17. Suspension --}}
                    <section id="termination" class="mb-5">
                        <h3 class="fw-bold mb-3">17. Suspension and Termination</h3>

                        <p>
                            You may discontinue your use of the website or
                            request closure of your merchant account in
                            accordance with the applicable account closure
                            process and service agreement.
                        </p>

                        <p>
                            We may restrict, suspend or terminate access to
                            particular services where reasonably necessary
                            for security, fraud prevention, legal compliance,
                            a material breach of these Terms or a requirement
                            imposed by an applicable Payment Partner.
                        </p>

                        <p>
                            Where legally permitted and reasonably practicable,
                            we may provide notice or an opportunity to address
                            an issue before taking action. Immediate action
                            may be necessary in certain security, fraud or
                            regulatory circumstances.
                        </p>

                        <p>
                            Termination does not automatically cancel
                            outstanding payment obligations, transaction
                            disputes, applicable record-retention duties
                            or other provisions intended to survive
                            termination.
                        </p>
                    </section>

                    {{-- 18. Changes --}}
                    <section id="changes" class="mb-5">
                        <h3 class="fw-bold mb-3">18. Changes to These Terms</h3>

                        <p>
                            We may update these Terms from time to time to
                            reflect changes in our services, business
                            practices, technical requirements or applicable
                            laws.
                        </p>

                        <p>
                            The updated version will be published on this
                            page with a revised effective or last-updated
                            date, as appropriate.
                        </p>

                        <p>
                            Where required by applicable law or a relevant
                            agreement, we will provide appropriate notice
                            of material changes.
                        </p>

                        <p>
                            Your continued use of the affected services
                            after the applicable effective date will be
                            subject to the updated Terms, to the extent
                            permitted by applicable law.
                        </p>
                    </section>

                    {{-- 19. Governing Law --}}
                    <section id="law" class="mb-5">
                        <h3 class="fw-bold mb-3">19. Governing Law and Dispute Resolution</h3>

                        <p>
                            These Terms will be governed by the laws of
                            India, subject to applicable mandatory legal
                            requirements and the terms of any applicable
                            service agreement.
                        </p>

                        <p>
                            If a dispute arises in connection with these
                            Terms, the parties should first attempt to
                            resolve it through good-faith discussions.
                        </p>

                        <p>
                            If the dispute cannot be resolved through
                            discussions, it may be referred to the
                            competent courts or another dispute resolution
                            mechanism applicable under the relevant
                            agreement and applicable law.
                        </p>

                        <p>
                            The specific court jurisdiction, arbitration
                            arrangements and dispute escalation procedure,
                            if any, should be stated in the applicable
                            signed agreement and reviewed before publication.
                        </p>
                    </section>

                    {{-- 20. General Provisions --}}
                    <section id="general" class="mb-5">
                        <h3 class="fw-bold mb-3">20. General Provisions</h3>

                        <p>
                            <strong>Entire agreement:</strong>
                            These Terms, together with any applicable
                            signed service agreement and incorporated
                            policies, govern the relevant use of the
                            services.
                        </p>

                        <p>
                            <strong>Severability:</strong>
                            If any provision is found unenforceable,
                            the remaining provisions will continue to
                            apply to the extent permitted by law.
                        </p>

                        <p>
                            <strong>No waiver:</strong>
                            Failure to enforce a provision does not
                            necessarily waive the right to enforce it later.
                        </p>

                        <p>
                            <strong>Assignment:</strong>
                            You may not transfer your rights or obligations
                            under these Terms without any required consent.
                            Any assignment by iPaylight will remain subject
                            to applicable law and the relevant agreement.
                        </p>

                        <p>
                            <strong>Force majeure:</strong>
                            Neither party will be responsible for a delay
                            caused by circumstances beyond its reasonable
                            control, subject to applicable law and any
                            relevant contractual obligations.
                        </p>

                        <p>
                            <strong>Electronic communications:</strong>
                            Where legally permitted, notices and service
                            communications may be provided electronically
                            through registered contact details, the
                            dashboard or other agreed communication channels.
                        </p>
                    </section>

                    {{-- 21. Contact --}}
                    <section id="contact" class="mb-5">
                        <h3 class="fw-bold mb-3">21. Contact Us</h3>

                        <p>
                            If you have questions about these Terms and
                            Conditions, our services or a contractual
                            matter, please contact iPaylight using the
                            official contact details published on our
                            website or provided in your service agreement.
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

                            <p class="mb-0">
                                <strong>Contact:</strong>
                                Please refer to the official Contact Us
                                page for verified contact information.
                            </p>
                        </div>
                    </section>

                    <div class="alert alert-light border rounded-4 p-4">
                        <h5 class="fw-bold">Important Notice</h5>
                        <p class="mb-0">
                            These Terms are a general drafting template and
                            do not constitute legal advice. They must be
                            reviewed against iPaylight's actual business
                            model, payment arrangements, regulatory status,
                            merchant agreements and applicable Indian laws
                            before being published or relied upon.
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
{{-- /.block-feature-ten --}}


{{-- Minimal page-specific styling --}}
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

    #introduction,
    #definitions,
    #eligibility,
    #services,
    #account,
    #payments,
    #payouts,
    #fees,
    #refunds,
    #prohibited,
    #security,
    #privacy,
    #availability,
    #intellectual-property,
    #liability,
    #indemnification,
    #termination,
    #changes,
    #law,
    #general,
    #contact {
        scroll-margin-top: 100px;
    }

    @media (max-width: 767px) {
        .legal-content h3 {
            font-size: 21px;
        }

        .legal-content {
            font-size: 15px;
            line-height: 1.8;
        }
    }
</style>

@endsection

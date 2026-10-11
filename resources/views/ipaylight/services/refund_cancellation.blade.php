
@extends('layouts.Frontend.ipaylight_page')

@props(['title' => 'Refund Policy'])

@section('content')
		<!--
		=============================================
			Inner Banner
		==============================================
		-->
		<div class="inner-banner-two light-bg text-center pt-200 md-pt-150 pb-85 lg-pb-50 position-relative">
			<div class="container position-relative">
				<div class="row">
					<div class="col-xl-8 m-auto">
                        <ul class="style-none d-inline-flex justify-content-center pager">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>/</li>
                            <li>Legal</li>
                            <li>/</li>
                            <li>Refund Policy</li>
                        </ul>

                        <h1 class="hero-heading">Refund Policy</h1>

                        <p class="text-lg">
                            At iPayLight, operated by Ipaylight Technologies Pvt. Ltd.,
                            we aim to provide reliable payment collection and payout
                            technology. This policy explains how refunds, failed
                            transactions, reversals and refund-related disputes are handled.
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
		<!-- /.inner-banner-two -->


		<!--
		=====================================================
			Block Feature Ten
		=====================================================
		-->
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
								<li class="mb-2"><a href="#merchant-refunds">3. Merchant Refunds</a></li>
								<li class="mb-2"><a href="#eligibility">4. Refund Eligibility</a></li>
								<li class="mb-2"><a href="#failed-payments">5. Failed Transactions</a></li>
								<li class="mb-2"><a href="#processing">6. Processing Time</a></li>
								<li class="mb-2"><a href="#charges">7. Fees and Charges</a></li>
								<li class="mb-2"><a href="#payouts">8. Payout Reversals</a></li>
								<li class="mb-2"><a href="#disputes">9. Disputes</a></li>
								<li class="mb-2"><a href="#responsibilities">10. Responsibilities</a></li>
								<li class="mb-2"><a href="#fraud">11. Fraud Prevention</a></li>
								<li class="mb-2"><a href="#contact">12. Contact Us</a></li>
							</ul>
						</div>
					</div>


                    {{-- Refund Policy Content --}}
					<div class="col-lg-9">

						<div class="title-one mb-4">
							<h2>Refund Policy</h2>
							<p class="text-lg mt-3">
								Please review this policy to understand the general
								process for handling refunds and transaction-related
								requests when using iPayLight services.
							</p>
						</div>

						<div class="legal-content">

							{{-- 1. Introduction --}}
							<section id="introduction" class="mb-5">
								<h3 class="fw-bold mb-3">1. Introduction</h3>

								<p>
									This Refund Policy applies to the relevant payment
									collection, transaction processing and payout-related
									services made available by iPayLight, operated by
									Ipaylight Technologies Pvt. Ltd. ("iPayLight", "we",
									"our" or "us").
								</p>

								<p>
									iPayLight provides payment technology and related
									infrastructure to eligible businesses. The availability
									and handling of refunds depend on the underlying
									transaction, the merchant's customer policy, the
									applicable payment method and the relevant payment
									partner's rules.
								</p>

								<p>
									This policy should be read together with our Terms
									and Conditions and Privacy Policy, where applicable.
								</p>
							</section>


							{{-- 2. Scope --}}
							<section id="scope" class="mb-5">
								<h3 class="fw-bold mb-3">2. Scope of This Policy</h3>

								<p>This policy addresses refund-related requests involving:</p>

								<ul>
									<li>Payments made by customers to merchants using supported payment methods.</li>
									<li>Transactions that are reported as failed, pending or unsuccessful.</li>
									<li>Refund requests initiated by eligible merchants.</li>
									<li>Payment reversals and eligible duplicate transactions.</li>
									<li>Disputes and transaction-related support requests.</li>
								</ul>

								<p>
									The policy does not independently guarantee a refund
									for every transaction. The outcome will depend on
									the applicable transaction facts, merchant terms,
									payment network rules and legal requirements.
								</p>
							</section>


							{{-- 3. Merchant Refunds --}}
							<section id="merchant-refunds" class="mb-5">
								<h3 class="fw-bold mb-3">3. Refunds for Merchant Transactions</h3>

								<p>
									For purchases of goods or services, the merchant
									that supplied the goods or services is generally
									responsible for deciding whether a customer is
									eligible for a refund under its published refund,
									cancellation and return policy.
								</p>

								<p>
									Customers should contact the relevant merchant
									first regarding product returns, service
									cancellations, incorrect orders, service quality
									issues or other matters relating to the underlying
									purchase.
								</p>

								<p>
									Where the merchant approves a refund and the
									transaction is eligible, the refund may be
									initiated through the applicable payment
									integration or payment partner.
								</p>

								<p>
									iPayLight's role in the process depends on the
									service provided under the relevant merchant
									agreement. Submitting a refund request does not
									by itself mean that the refund has been approved
									or completed.
								</p>
							</section>


							{{-- 4. Refund Eligibility --}}
							<section id="eligibility" class="mb-5">
								<h3 class="fw-bold mb-3">4. Refund Eligibility</h3>

								<p>
									A refund request may be considered where permitted
									by the merchant's applicable policy, the relevant
									service agreement, payment network rules and
									applicable law.
								</p>

								<p>Examples of circumstances that may warrant review include:</p>

								<ul>
									<li>A duplicate payment for the same purchase.</li>
									<li>A merchant-approved cancellation or return.</li>
									<li>A confirmed payment error for which a refund is appropriate.</li>
									<li>A transaction that is eligible for reversal under the relevant payment rules.</li>
									<li>Another circumstance in which a refund is required by applicable law or an agreed policy.</li>
								</ul>

								<p>
									Refund eligibility will be assessed using the
									available transaction details and applicable rules.
									We may request transaction references, payment
									receipts or other information reasonably necessary
									to investigate a request.
								</p>
							</section>


							{{-- 5. Failed Transactions --}}
							<section id="failed-payments" class="mb-5">
								<h3 class="fw-bold mb-3">5. Failed, Pending and Duplicate Transactions</h3>

								<p>
									A payment may sometimes appear pending or failed
									even when the customer's bank or payment provider
									has temporarily debited the amount.
								</p>

								<p>
									In such cases, the customer should check the
									transaction status and contact the relevant bank,
									payment provider or merchant with the transaction
									reference.
								</p>

								<p>
									If a transaction is confirmed as failed and the
									amount was debited, the applicable bank or payment
									network may process an automatic reversal or
									another appropriate adjustment under its rules.
								</p>

								<p>
									For suspected duplicate payments, the customer
									should provide the references for the transactions
									so that the merchant or relevant payment provider
									can investigate them.
								</p>

								<p>
									A displayed status alone may not establish the
									final settlement outcome. The transaction should
									be verified using the applicable payment records.
								</p>
							</section>


							{{-- 6. Processing Time --}}
							<section id="processing" class="mb-5">
								<h3 class="fw-bold mb-3">6. Refund Processing Time</h3>

								<p>
									Refund processing times may vary depending on
									the payment method, issuing bank, receiving bank,
									payment network, merchant approval and the
									applicable payment partner's procedures.
								</p>

								<p>
									Once a refund is successfully initiated, the time
									required for the amount to appear in the customer's
									account is generally determined by the relevant
									financial institution or payment provider.
								</p>

								<p>
									Customers should retain their original transaction
									reference and any refund confirmation provided
									by the merchant or payment provider.
								</p>

								<p>
									If a refund has not appeared within the timeframe
									communicated by the merchant, bank or payment
									provider, the customer should contact the relevant
									support channel for an update.
								</p>

								<p>
									Unless expressly confirmed under an applicable
									agreement or mandatory legal requirement, iPayLight
									does not guarantee a fixed refund completion time.
								</p>
							</section>


							{{-- 7. Fees and Charges --}}
							<section id="charges" class="mb-5">
								<h3 class="fw-bold mb-3">7. Fees, Charges and Refund Amounts</h3>

								<p>
									The amount refunded to a customer will depend on
									the approved refund amount, the merchant's policy,
									the original transaction and applicable law.
								</p>

								<p>
									Any treatment of transaction fees, service charges,
									taxes or other amounts associated with a refund
									will be governed by the relevant merchant agreement,
									payment partner rules and applicable law.
								</p>

								<p>
									Refunds may be subject to transaction validation,
									available processing functionality and other
									applicable restrictions.
								</p>

								<p>
									No additional refund deduction or fee should be
									assumed unless it is permitted by applicable law
									and the relevant disclosed terms.
								</p>
							</section>


							{{-- 8. Payout Reversals --}}
							<section id="payouts" class="mb-5">
								<h3 class="fw-bold mb-3">8. Payouts and Reversals</h3>

								<p>
									Payouts to bank accounts, UPI addresses or other
									supported destinations are subject to recipient
									validation, transaction status and the applicable
									banking or payment network rules.
								</p>

								<p>
									If a payout fails or is returned, the transaction
									may require investigation by the relevant payment
									provider or financial institution before any
									amount can be credited back or reprocessed.
								</p>

								<p>
									Incorrect recipient details, account restrictions,
									technical issues, compliance reviews and other
									factors may affect payout completion.
								</p>

								<p>
									Payout reversals and reprocessing are handled
									according to the applicable service agreement
									and payment partner procedures. A payout should
									not be treated as reversed until its status has
									been confirmed.
								</p>
							</section>


							{{-- 9. Disputes --}}
							<section id="disputes" class="mb-5">
								<h3 class="fw-bold mb-3">9. Refund Disputes and Complaints</h3>

								<p>
									If a customer disagrees with a refund decision
									or believes a transaction has been handled
									incorrectly, the customer should first contact
									the merchant or the relevant payment support
									channel, depending on the nature of the issue.
								</p>

								<p>
									Please provide the following details where available:
								</p>

								<ul>
									<li>Transaction ID or payment reference.</li>
									<li>Transaction date and amount.</li>
									<li>Payment method used.</li>
									<li>Relevant receipt, refund confirmation or bank reference.</li>
									<li>A clear description of the issue and any previous support request.</li>
								</ul>

								<p>
									We may review information available to us and
									coordinate with the relevant merchant or payment
									partner where appropriate. Resolution will depend
									on the facts, applicable payment rules and
									legal requirements.
								</p>
							</section>


							{{-- 10. Responsibilities --}}
							<section id="responsibilities" class="mb-5">
								<h3 class="fw-bold mb-3">10. Customer and Merchant Responsibilities</h3>

								<h5 class="fw-bold mt-4 mb-2">Customers</h5>

								<ul>
									<li>Check the transaction status before submitting a duplicate payment.</li>
									<li>Keep transaction receipts and payment references.</li>
									<li>Contact the merchant regarding purchase cancellations, returns and service-related refund requests.</li>
									<li>Provide accurate information when reporting a transaction issue.</li>
									<li>Never share passwords, PINs, OTPs or other confidential authentication details with unauthorised persons.</li>
								</ul>

								<h5 class="fw-bold mt-4 mb-2">Merchants</h5>

								<ul>
									<li>Publish clear customer refund, return and cancellation terms where applicable.</li>
									<li>Review refund requests in a timely manner.</li>
									<li>Submit accurate refund instructions and transaction references.</li>
									<li>Maintain appropriate records of refunds, cancellations and disputes.</li>
									<li>Comply with applicable law and payment partner requirements.</li>
								</ul>
							</section>


							{{-- 11. Fraud Prevention --}}
							<section id="fraud" class="mb-5">
								<h3 class="fw-bold mb-3">11. Fraud Prevention and Misuse</h3>

								<p>
									Refund and reversal requests may be reviewed
									where there are reasonable indications of
									fraud, unauthorised activity, duplicate claims
									or misuse of the payment system.
								</p>

								<p>
									We may request supporting information or
									coordinate with the relevant merchant, bank
									or payment provider to investigate a request,
									subject to applicable law and contractual
									obligations.
								</p>

								<p>
									Any restriction, investigation or delay will
									be handled in accordance with applicable
									requirements. Nothing in this policy limits
									any rights or remedies that cannot lawfully
									be excluded.
								</p>
							</section>


							{{-- 12. Contact --}}
							<section id="contact" class="mb-5">
								<h3 class="fw-bold mb-3">12. Contact Us</h3>

								<p>
									For questions about this Refund Policy or
									transaction-processing issues involving
									iPayLight, please use the official contact
									details published on our website or provided
									in your merchant service agreement.
								</p>

								<div class="card-style-eight rounded-4 p-4 mt-4">
									<h4 class="fw-bold mb-3">Ipaylight Technologies Pvt. Ltd.</h4>

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
										<a href="{{ url('/contact-us') }}">Contact Us</a>
									</p>
								</div>
							</section>


							<div class="alert alert-light border rounded-4 p-4">
								<h5 class="fw-bold">Important Notice</h5>
								<p class="mb-0">
									This policy is a general template and should be
									reviewed against iPayLight's actual payment
									operations, merchant agreements, refund workflows,
									payment partner requirements and applicable Indian
									laws before publication. Any specific refund
									timeframes, fees or escalation procedures should
									be added only after they have been confirmed.
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

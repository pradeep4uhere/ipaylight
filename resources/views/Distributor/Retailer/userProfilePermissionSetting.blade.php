

<div class="card mb-5 mb-xl-10">
									<!--begin::Card header-->
									<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accouxnts" aria-expanded="true" aria-controls="kt_account_connected_accounts">
										<div class="card-title m-0">
											<h3 class="fw-bolder m-0">Payment Gateways</h3>
										</div>
									</div>
									<!--end::Card header-->
									<!--begin::Content-->
									<div id="kt_account_settings_connected_accounts" class="collapse show">
										<!--begin::Card body-->
										<div class="card-body border-top p-9">
											<!--begin::Notice-->
											<div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
												<!--begin::Icon-->
												<!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
												<span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M22 19V17C22 16.4 21.6 16 21 16H8V3C8 2.4 7.6 2 7 2H5C4.4 2 4 2.4 4 3V19C4 19.6 4.4 20 5 20H21C21.6 20 22 19.6 22 19Z" fill="currentColor"></path>
														<path d="M20 5V21C20 21.6 19.6 22 19 22H17C16.4 22 16 21.6 16 21V8H8V4H19C19.6 4 20 4.4 20 5ZM3 8H4V4H3C2.4 4 2 4.4 2 5V7C2 7.6 2.4 8 3 8Z" fill="currentColor"></path>
													</svg>
												</span>
												<!--end::Svg Icon-->
												<!--end::Icon-->
												<!--begin::Wrapper-->
												<div class="d-flex flex-stack flex-grow-1">
													<!--begin::Content-->
													<div class="fw-bold">
														<div class="fs-6 text-gray-700">Two-factor authentication adds an extra layer of security to your account. To log in, in you'll need to provide a 4 digit amazing code.
														<a href="#" class="fw-bolder">Learn More</a></div>
													</div>
													<!--end::Content-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Notice-->
											<!--begin::Items-->
                                            <div id="kt_account_settings_notifications" class="collapse show">
										<!--begin::Form-->
										<form class="form">
											<!--begin::Card body-->
											<div class="card-body border-top px-9 pt-3 pb-4">
												<!--begin::Table-->
												<div class="table-responsive">
													<table class="table table-row-dashed border-gray-300 align-middle gy-6">
														<tbody class="fs-6 fw-bold">
															<!--begin::Table row-->
															<tr>
																<td class="min-w-250px fs-4 fw-bolder">Payment Gateway</td>
																<td class="w-125px">
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_email" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=email]">
																		<label class="form-check-label ps-2" for="kt_settings_notification_email">Gateway</label>
																	</div>
																</td>
                                                                <td class="w-125px">
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_phone" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=phone]">
																		<label class="form-check-label ps-2" for="kt_settings_notification_phone">Instant</label>
																	</div>
																</td>
                                                                <td class="w-125px">
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_phone" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=phone]">
																		<label class="form-check-label ps-2" for="kt_settings_notification_phone">Next Day</label>
																	</div>
																</td>
                                                                <td class="w-125px">
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_phone" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=phone]">
																		<label class="form-check-label ps-2" for="kt_settings_notification_phone">N Week</label>
																	</div>
																</td>
																<td class="w-125px">
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_phone" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=phone]">
																		<label class="form-check-label ps-2" for="kt_settings_notification_phone">Payout</label>
																	</div>
																</td>
															</tr>
															<!--begin::Table row-->
                                                            <?php if(!empty($userProfile->dashboardItem->gatewayActiveList)){ ?>
                                                            <?php foreach($userProfile->dashboardItem->gatewayActiveList as $item){ ?>
															<!--begin::Table row-->
															<tr>
																<td><img src="{{asset('assets/media/cards/'.getPaymentGatewayIcon($item->gateway_name))}}" height="50" width="100px"/></td>
																<td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="1" id="billing1" checked="checked" data-kt-settings-notification="email">
																		<label class="form-check-label ps-2" for="billing1"></label>
																	</div>
																</td>
																<td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="billing2" checked="checked" data-kt-settings-notification="phone">
																		<label class="form-check-label ps-2" for="billing2"></label>
																	</div>
																</td>
                                                                <td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="billing2" checked="checked" data-kt-settings-notification="phone">
																		<label class="form-check-label ps-2" for="billing2"></label>
																	</div>
																</td>
                                                                <td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="billing2" checked="checked" data-kt-settings-notification="phone">
																		<label class="form-check-label ps-2" for="billing2"></label>
																	</div>
																</td>
                                                                <td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="billing2" checked="checked" data-kt-settings-notification="phone">
																		<label class="form-check-label ps-2" for="billing2"></label>
																	</div>
																</td>   
															</tr>
                                                            <?php } ?>
                                                            <?php } ?>
															<!--begin::Table row-->
														</tbody>
													</table>
												</div>
												<!--end::Table-->
											</div>
											<!--end::Card body-->
											
										</form>
										<!--end::Form-->
									</div>


											
											<!--end::Items-->
										</div>
										<!--end::Card body-->
										<!--begin::Card footer-->
										<div class="card-footer d-flex justify-content-end py-6 px-9">
											<button class="btn btn-primary">Save Gateway Setting</button>
										</div>
										<!--end::Card footer-->
									</div>
									<!--end::Content-->
								</div>

                                <!--Email Setting-->
                                <div class="card mb-5 mb-xl-10">
									<!--begin::Card header-->
									<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_email_preferences" aria-expanded="true" aria-controls="kt_account_email_preferences">
										<div class="card-title m-0">
											<h3 class="fw-bolder m-0">Email Preferences</h3>
										</div>
									</div>
									<!--begin::Card header-->
									<!--begin::Content-->
									<div id="kt_account_settings_email_preferences" class="collapse show">
										<!--begin::Form-->
										<form class="form">
											<!--begin::Card body-->
											<div class="card-body border-top px-9 py-9">
												<!--begin::Option-->
												<label class="form-check form-check-custom form-check-solid align-items-start">
													<!--begin::Input-->
													<input class="form-check-input me-3" type="checkbox" name="email-preferences[]" value="1">
													<!--end::Input-->
													<!--begin::Label-->
													<span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">Successful Payments</span>
														<span class="text-muted fs-6">Receive a notification for every successful payment.</span>
													</span>
													<!--end::Label-->
												</label>
												<!--end::Option-->
												<!--begin::Option-->
												<div class="separator separator-dashed my-6"></div>
												<!--end::Option-->
												<!--begin::Option-->
												<label class="form-check form-check-custom form-check-solid align-items-start">
													<!--begin::Input-->
													<input class="form-check-input me-3" type="checkbox" name="email-preferences[]" checked="checked" value="1">
													<!--end::Input-->
													<!--begin::Label-->
													<span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">Payouts</span>
														<span class="text-muted fs-6">Receive a notification for every initiated payout.</span>
													</span>
													<!--end::Label-->
												</label>
												<!--end::Option-->
												<!--begin::Option-->
												<div class="separator separator-dashed my-6"></div>
												<!--end::Option-->
												<!--begin::Option-->
												<label class="form-check form-check-custom form-check-solid align-items-start">
													<!--begin::Input-->
													<input class="form-check-input me-3" type="checkbox" name="email-preferences[]" value="1">
													<!--end::Input-->
													<!--begin::Label-->
													<span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">Fee Collection</span>
														<span class="text-muted fs-6">Receive a notification each time you collect a fee from sales</span>
													</span>
													<!--end::Label-->
												</label>
												<!--end::Option-->
												<!--begin::Option-->
												<div class="separator separator-dashed my-6"></div>
												<!--end::Option-->
												<!--begin::Option-->
												<label class="form-check form-check-custom form-check-solid align-items-start">
													<!--begin::Input-->
													<input class="form-check-input me-3" type="checkbox" name="email-preferences[]" checked="checked" value="1">
													<!--end::Input-->
													<!--begin::Label-->
													<span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">Customer Payment Dispute</span>
														<span class="text-muted fs-6">Receive a notification if a payment is disputed by a customer and for dispute purposes.</span>
													</span>
													<!--end::Label-->
												</label>
												<!--end::Option-->
												<!--begin::Option-->
												<div class="separator separator-dashed my-6"></div>
												<!--end::Option-->
												<!--begin::Option-->
												<label class="form-check form-check-custom form-check-solid align-items-start">
													<!--begin::Input-->
													<input class="form-check-input me-3" type="checkbox" name="email-preferences[]" value="1">
													<!--end::Input-->
													<!--begin::Label-->
													<span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">Refund Alerts</span>
														<span class="text-muted fs-6">Receive a notification if a payment is stated as risk by the Finance Department.</span>
													</span>
													<!--end::Label-->
												</label>
												<!--end::Option-->
												<!--begin::Option-->
												<div class="separator separator-dashed my-6"></div>
												<!--end::Option-->
												<!--begin::Option-->
												<label class="form-check form-check-custom form-check-solid align-items-start">
													<!--begin::Input-->
													<input class="form-check-input me-3" type="checkbox" name="email-preferences[]" checked="checked" value="1">
													<!--end::Input-->
													<!--begin::Label-->
													<span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">Invoice Payments</span>
														<span class="text-muted fs-6">Receive a notification if a customer sends an incorrect amount to pay their invoice.</span>
													</span>
													<!--end::Label-->
												</label>
												<!--end::Option-->
												<!--begin::Option-->
												<div class="separator separator-dashed my-6"></div>
												<!--end::Option-->
												<!--begin::Option-->
												<label class="form-check form-check-custom form-check-solid align-items-start">
													<!--begin::Input-->
													<input class="form-check-input me-3" type="checkbox" name="email-preferences[]" value="1">
													<!--end::Input-->
													<!--begin::Label-->
													<span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">Webhook API Endpoints</span>
														<span class="text-muted fs-6">Receive notifications for consistently failing webhook API endpoints.</span>
													</span>
													<!--end::Label-->
												</label>
												<!--end::Option-->
											</div>
											<!--end::Card body-->
											<!--begin::Card footer-->
											<div class="card-footer d-flex justify-content-end py-6 px-9">
												<button class="btn btn-light btn-active-light-primary me-2">Discard</button>
												<button class="btn btn-primary px-6">Save Changes</button>
											</div>
											<!--end::Card footer-->
										</form>
										<!--end::Form-->
									</div>
									<!--end::Content-->
								</div>


                                <div class="card mb-5 mb-xl-10">
									<!--begin::Card header-->
									<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_notifications" aria-expanded="true" aria-controls="kt_account_notifications">
										<div class="card-title m-0">
											<h3 class="fw-bolder m-0">Notifications</h3>
										</div>
									</div>
									<!--begin::Card header-->
									<!--begin::Content-->
									<div id="kt_account_settings_notifications" class="collapse show">
										<!--begin::Form-->
										<form class="form">
											<!--begin::Card body-->
											<div class="card-body border-top px-9 pt-3 pb-4">
												<!--begin::Table-->
												<div class="table-responsive">
													<table class="table table-row-dashed border-gray-300 align-middle gy-6">
														<tbody class="fs-6 fw-bold">
															<!--begin::Table row-->
															<tr>
																<td class="min-w-250px fs-4 fw-bolder">Notifications</td>
																<td class="w-125px">
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_email" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=email]">
																		<label class="form-check-label ps-2" for="kt_settings_notification_email">Email</label>
																	</div>
																</td>
																<td class="w-125px">
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_phone" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=phone]">
																		<label class="form-check-label ps-2" for="kt_settings_notification_phone">Phone</label>
																	</div>
																</td>
															</tr>
															<!--begin::Table row-->
															<!--begin::Table row-->
															<tr>
																<td>Billing Updates</td>
																<td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="1" id="billing1" checked="checked" data-kt-settings-notification="email">
																		<label class="form-check-label ps-2" for="billing1"></label>
																	</div>
																</td>
																<td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="billing2" checked="checked" data-kt-settings-notification="phone">
																		<label class="form-check-label ps-2" for="billing2"></label>
																	</div>
																</td>
															</tr>
															<!--begin::Table row-->
															<!--begin::Table row-->
															<tr>
																<td>New Team Members</td>
																<td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="team1" checked="checked" data-kt-settings-notification="email">
																		<label class="form-check-label ps-2" for="team1"></label>
																	</div>
																</td>
																<td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="team2" data-kt-settings-notification="phone">
																		<label class="form-check-label ps-2" for="team2"></label>
																	</div>
																</td>
															</tr>
															<!--begin::Table row-->
															<!--begin::Table row-->
															<tr>
																<td>Completed Projects</td>
																<td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="project1" data-kt-settings-notification="email">
																		<label class="form-check-label ps-2" for="project1"></label>
																	</div>
																</td>
																<td>
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="project2" checked="checked" data-kt-settings-notification="phone">
																		<label class="form-check-label ps-2" for="project2"></label>
																	</div>
																</td>
															</tr>
															<!--begin::Table row-->
															<!--begin::Table row-->
															<tr>
																<td class="border-bottom-0">Newsletters</td>
																<td class="border-bottom-0">
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="newsletter1" data-kt-settings-notification="email">
																		<label class="form-check-label ps-2" for="newsletter1"></label>
																	</div>
																</td>
																<td class="border-bottom-0">
																	<div class="form-check form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="newsletter2" data-kt-settings-notification="phone">
																		<label class="form-check-label ps-2" for="newsletter2"></label>
																	</div>
																</td>
															</tr>
															<!--begin::Table row-->
														</tbody>
													</table>
												</div>
												<!--end::Table-->
											</div>
											<!--end::Card body-->
											<!--begin::Card footer-->
											<div class="card-footer d-flex justify-content-end py-6 px-9">
												<button class="btn btn-light btn-active-light-primary me-2">Discard</button>
												<button class="btn btn-primary px-6">Save Changes</button>
											</div>
											<!--end::Card footer-->
										</form>
										<!--end::Form-->
									</div>
									<!--end::Content-->
								</div>


                                <div class="card">
									<!--begin::Card header-->
									<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
										<div class="card-title m-0">
											<h3 class="fw-bolder m-0">Deactivate Account</h3>
										</div>
									</div>
									<!--end::Card header-->
									<!--begin::Content-->
									<div id="kt_account_settings_deactivate" class="collapse show">
										<!--begin::Form-->
										<form id="kt_account_deactivate_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
											<!--begin::Card body-->
											<div class="card-body border-top p-9">
												<!--begin::Notice-->
												<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
													<!--begin::Icon-->
													<!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
													<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
															<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
															<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
														</svg>
													</span>
													<!--end::Svg Icon-->
													<!--end::Icon-->
													<!--begin::Wrapper-->
													<div class="d-flex flex-stack flex-grow-1">
														<!--begin::Content-->
														<div class="fw-bold">
															<h4 class="text-gray-900 fw-bolder">You Are Deactivating User Profile Account</h4>
															<div class="fs-6 text-gray-700">For extra security, this requires you to confirm your email or phone number when you reset yousignr password.
															<br>
															<a class="fw-bolder" href="#">Learn more</a></div>
														</div>
														<!--end::Content-->
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Notice-->
												<!--begin::Form input row-->
												<div class="form-check form-check-solid fv-row fv-plugins-icon-container">
													<input name="deactivate" class="form-check-input" type="checkbox" value="" id="deactivate">
													<label class="form-check-label fw-bold ps-2 fs-6" for="deactivate">I confirm my account deactivation</label>
												<div class="fv-plugins-message-container invalid-feedback"></div></div>
												<!--end::Form input row-->
											</div>
											<!--end::Card body-->
											<!--begin::Card footer-->
											<div class="card-footer d-flex justify-content-end py-6 px-9">
												<button id="kt_account_deactivate_account_submit" type="submit" class="btn btn-danger fw-bold">Deactivate Account</button>
											</div>
											<!--end::Card footer-->
										<input type="hidden"><div></div></form>
										<!--end::Form-->
									</div>
									<!--end::Content-->
								</div>
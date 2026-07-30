<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
									<!--begin::Col-->
									<div class="col-xxl-12">
										<!--begin::Row-->
										<div class="row g-5 g-xl-12">
											<!--begin::Col-->
											<div class="col-md-3">
												<!--begin::Card widget 11-->
												<div class="card card-flush h-xl-100" style="background-color: #e8fff3">
													<!--begin::Header-->
													<div class="card-header flex-nowrap pt-5">
														<!--begin::Title-->
														<h3 class="card-title align-items-start flex-column">
															<span class="card-label fw-bolder fs-4 text-gray-800">{{getLocalText('total_payment_recived')}} Recived</span>
															<span class="mt-1 fw-bold fs-7" style="color:">{{$dashboardItem['totalCount']}} Number Of Transaction</span>
														</h3>
														<!--end::Title-->
														
													</div>
													<!--end::Header-->
													<!--begin::Body-->
													<div class="card-body text-center pt-5">
														<!--begin::Image-->
                                                        
														<img src="assets/media/svg/payment.svg" class="" alt="">
														<!--end::Image-->
														<!--begin::Section-->
														<div class="text-start">
															<span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>Rs. {{number_format($dashboardItem['TotalRecivedAmount'],2)}}</span>
															<span class="mt-5 fw-bold fs-7" style="color:">{{ucfirst(AmountToWords($dashboardItem['TotalRecivedAmount']))}}</span>
														</div>
														<!--end::Section-->
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 11-->
											</div>
											<!--end::Col-->
                                            <!--begin::Col-->
											<div class="col-md-3">
												<!--begin::Card widget 11-->
												<div class="card card-flush h-xl-100" style="background-color: #F6E5CA">
													<!--begin::Header-->
													<div class="card-header flex-nowrap pt-5">
														<!--begin::Title-->
														<h3 class="card-title align-items-start flex-column">
															<span class="card-label fw-bolder fs-4 text-gray-800">{{getLocalText('today_payment')}}</span>
															<span class="mt-1 fw-bold fs-7" style="color:">{{$dashboardItem['totalTodayCount']}} Number Of Transaction</span>
														</h3>
														<!--end::Title-->
														
													</div>
													<!--end::Header-->
													<!--begin::Body-->
													<div class="card-body text-center pt-5">
														<!--begin::Image-->
														<img src="assets/media/svg/today_payment.svg" class="" alt="">
														<!--end::Image-->
														<!--begin::Section-->
														<div class="text-start">
                                                        <span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>Rs. {{number_format($dashboardItem['TotalRecivedTodayAmount'],2)}}</span>
															<span class="mt-5 fw-bold fs-7" style="color:">{{ucfirst(AmountToWords($dashboardItem['TotalRecivedTodayAmount']))}}</span>
														</div>
														<!--end::Section-->
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 11-->
											</div>
											<!--end::Col-->
                                            <!--begin::Col-->
											<div class="col-md-3">
												<!--begin::Card widget 11-->
												<div class="card card-flush h-xl-100" style="background-color: #BFDDE3">
													<!--begin::Header-->
													<div class="card-header flex-nowrap pt-5">
														<!--begin::Title-->
														<h3 class="card-title align-items-start flex-column">
															<span class="card-label fw-bolder fs-4 text-gray-800">Last Week</span>
															<span class="mt-1 fw-bold fs-7" style="color:">{{$dashboardItem['totalWeekCount']}} Number Of Transaction</span>
														</h3>
														<!--end::Title-->
														
													</div>
													<!--end::Header-->
													<!--begin::Body-->
													<div class="card-body text-center pt-5">
														<!--begin::Image-->
														<img src="assets/media/svg/growing.svg" class="" alt="">
														<!--end::Image-->
														<!--begin::Section-->
														<div class="text-start">
                                                        <span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>Rs. {{number_format($dashboardItem['TotalRecivedWeekAmount'],2)}}</span>
														<span class="mt-5 fw-bold fs-7" style="color:">{{ucfirst(AmountToWords($dashboardItem['TotalRecivedWeekAmount']))}}</span>
														</div>
														<!--end::Section-->
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 11-->
											</div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col-md-3">
												<!--begin::Card widget 11-->
												<div class="card card-flush h-xl-100" style="background-color: #F3D6EF">
													<!--begin::Header-->
													<div class="card-header flex-nowrap pt-5">
														<!--begin::Title-->
														<h3 class="card-title align-items-start flex-column">
															<span class="card-label fw-bolder fs-4 text-gray-800">Faild Payment</span>
															<span class="mt-1 fw-bold fs-7" style="color:">{{$dashboardItem['totalFailedCount']}} Number Of Transaction</span>
														</h3>
														<!--end::Title-->
														
														<!--end::Toolbar-->
													</div>
													<!--end::Header-->
													<!--begin::Body-->
													<div class="card-body text-center pt-5">
														<!--begin::Image-->
														<img src="assets/media/svg/failed.svg" class="" alt="">
														<!--end::Image-->
														<!--begin::Section-->
														<div class="text-start">
                                                        <span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>Rs. {{number_format($dashboardItem['TotalFailedAmount'],2)}}</span>
														<span class="mt-5 fw-bold fs-7" style="color:">{{ucfirst(AmountToWords($dashboardItem['TotalFailedAmount']))}}</span>
														</div>
														<!--end::Section-->
													</div>
													<!--end::Body-->
												</div>
												<!--end::Card widget 11-->
											</div>
											<!--end::Col-->
											
										</div>
										<!--end::Row-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xxl-6">
                                        <div class="card card-flush border-0 h-xl-100">
											<!--begin::Body-->
											<div class="card-body py-9">
												<!--begin::Row-->
												<div class="row gx-9 h-100">
													<!--begin::Col-->
													<div class="col-sm-6 mb-10 mb-sm-0">
														<!--begin::Overlay-->
														<a class="d-block overlay h-100" data-fslightbox="lightbox-hot-sales" href="">
															<!--begin::Image-->
															<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px h-100" style="background-image:url('assets/media/svg/latest_payment.svg')"></div>
															<!--end::Image-->
															<!--begin::Action-->
															<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
																<i class="bi bi-eye-fill fs-2x text-white"></i>
															</div>
															<!--end::Action-->
														</a>
														<!--end::Overlay-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													
													<div class="col-sm-6">
														<!--begin::Wrapper-->
														<div class="d-flex flex-column h-100">
															<!--begin::Header-->
															<div class="mb-7">
																<!--begin::Title-->
																<div class="mb-6">
																	<span class="text-gray-400 fs-7 fw-bolder me-2 d-block lh-1 pb-1">Transaction ID: 34353342346776</span>
																	<a href="../../demo1/dist/apps/projects/users.html" class="text-gray-800 text-hover-primary fs-1 fw-bolder">Latest Payment</a>
																</div>
																<!--end::Title-->
																<!--begin::Items-->
																<div class="d-flex align-items-center flex-wrap d-grid gap-2">
																	<!--begin::Item-->
																	<div class="d-flex align-items-center me-5 me-xl-13">
																		<!--begin::Symbol-->
																		<div class="symbol symbol-30px symbol-circle me-3">
																			<img src="assets/media/avatars/300-3.jpg" class="" alt="">
																		</div>
																		<!--end::Symbol-->
																		<!--begin::Info-->
																		<div class="m-0">
																			<span class="fw-bold text-gray-400 d-block fs-8">Agent Details</span>
																			
																			<a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-7">{{$dashboardItem['lastPayment']['User']['name']}}&nbsp;|&nbsp;Code:{{$dashboardItem['lastPayment']['User']['agent_code']}}</a>
																			
																		</div>
																		<!--end::Info-->
																	</div>
																	<!--end::Item-->
																	<!--begin::Item-->
																	<div class="d-flex align-items-center">
																		<!--begin::Symbol-->
																		<div class="symbol symbol-30px symbol-circle me-3">
																			<span class="symbol-label bg-success">
																				<!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
																				<span class="svg-icon svg-icon-5 svg-icon-white">
																					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																						<path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="currentColor"></path>
																						<path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="currentColor"></path>
																					</svg>
																				</span>
																				<!--end::Svg Icon-->
																			</span>
																		</div>
																		<!--end::Symbol-->
																		<!--begin::Info-->
																		<div class="m-0">
																			<span class="fw-bold text-gray-400 d-block fs-8">Customer Details</span>
																			<a href="#" class="fw-bold text-gray-800 text-hover-primary fs-7">{{$dashboardItem['lastPayment']['customer_name']}}&nbsp;|&nbsp;M:&nbsp;{{$dashboardItem['lastPayment']['customer_mobile']}}</a>
																		</div>
																		<!--end::Info-->
																	</div>
																	<!--end::Item-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Header-->
															<!--begin::Body-->
															<div class="d-flex flex-column border border-1 border-gray-300 text-center pt-5 pb-7 mb-8 card-rounded">
																<span class="fw-bold text-gray-600 fs-7 pb-1">Payment Details</span>
																<span class="fw-bolder text-gray-800 fs-1 lh-1 pb-1">Rs. {{$dashboardItem['lastPayment']['amount']}}</span>
																<span class="fw-bold text-gray-600 fs-7 pb-1">Txn No:</span>
																<span class="fw-bold text-gray fs-8 lh-1 pb-1 mt-1">{{$dashboardItem['lastPayment']['txn_id']}}</span>
																<span class="text-success fw-bolder fs-4 mt-2 pb-2">{{$dashboardItem['lastPayment']['status']}}</span>
																<span class="fw-bold text-gray-600 fs-7 pb-1">Payment Date</span>
																<span class="fw-bolder text-gray-800 fs-6">{{getFormatDate($dashboardItem['lastPayment']['created_at'],'d M, Y | H:i A')}}</span>
															</div>
															<!--end::Body-->
															<!--begin::Footer-->
															<div class="d-flex flex-stack mt-auto bd-highlight">
																<!--begin::Actions-->
																<a href="#" class="btn btn-primary btn-sm flex-shrink-0 me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_bidding">View Details</a>
																<a href="#" class="btn btn-light btn-sm flex-shrink-0" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">View Details</a>
																<!--end::Actions-->
															</div>
															<!--end::Footer-->
														</div>
														<!--end::Wrapper-->
													</div>
													<!--end::Col-->
													
												</div>
												<!--end::Row-->
											</div>
											<!--end::Body-->
										</div>
									</div>
                                    <div class="col-xxl-6">
                                        <div class="card card-flush border-0 h-xl-100">
											<!--begin::Body-->
											<div class="card-body py-9">
												<!--begin::Row-->
												<div class="row gx-9 h-100">
													<!--begin::Col-->
													<div class="col-sm-6 mb-10 mb-sm-0">
														<!--begin::Overlay-->
														<a class="d-block overlay h-100" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x600/img-42.jpg">
															<!--begin::Image-->
															<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px h-100" style="background-image:url('assets/media/svg/online_payment.svg')"></div>
															<!--end::Image-->
															<!--begin::Action-->
															<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
																<i class="bi bi-eye-fill fs-2x text-white"></i>
															</div>
															<!--end::Action-->
														</a>
														<!--end::Overlay-->
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col-sm-6">
														<!--begin::Wrapper-->
														<div class="d-flex flex-column h-100">
															<!--begin::Header-->
															<div class="mb-7">
																<!--begin::Title-->
																<div class="mb-6">
																	<span class="text-gray-400 fs-7 fw-bolder me-2 d-block lh-1 pb-1">NFT ID: 34356776</span>
																	<a href="../../demo1/dist/apps/projects/users.html" class="text-gray-800 text-hover-primary fs-1 fw-bolder">California Art</a>
																</div>
																<!--end::Title-->
																<!--begin::Items-->
																<div class="d-flex align-items-center flex-wrap d-grid gap-2">
																	<!--begin::Item-->
																	<div class="d-flex align-items-center me-5 me-xl-13">
																		<!--begin::Symbol-->
																		<div class="symbol symbol-30px symbol-circle me-3">
																			<img src="assets/media/avatars/300-3.jpg" class="" alt="">
																		</div>
																		<!--end::Symbol-->
																		<!--begin::Info-->
																		<div class="m-0">
																			<span class="fw-bold text-gray-400 d-block fs-8">Creator</span>
																			<a href="../../demo1/dist/apps/projects/users.html" class="fw-bolder text-gray-800 text-hover-primary fs-7">Robert Fox</a>
																		</div>
																		<!--end::Info-->
																	</div>
																	<!--end::Item-->
																	<!--begin::Item-->
																	<div class="d-flex align-items-center">
																		<!--begin::Symbol-->
																		<div class="symbol symbol-30px symbol-circle me-3">
																			<span class="symbol-label bg-success">
																				<!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
																				<span class="svg-icon svg-icon-5 svg-icon-white">
																					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																						<path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="currentColor"></path>
																						<path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="currentColor"></path>
																					</svg>
																				</span>
																				<!--end::Svg Icon-->
																			</span>
																		</div>
																		<!--end::Symbol-->
																		<!--begin::Info-->
																		<div class="m-0">
																			<span class="fw-bold text-gray-400 d-block fs-8">Instant Price</span>
																			<a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-7">4.2 ETH</a>
																		</div>
																		<!--end::Info-->
																	</div>
																	<!--end::Item-->
																</div>
																<!--end::Items-->
															</div>
															<!--end::Header-->
															<!--begin::Body-->
															<div class="d-flex flex-column border border-1 border-gray-300 text-center pt-5 pb-7 mb-8 card-rounded">
																<span class="fw-bold text-gray-600 fs-7 pb-1">Last Bid</span>
																<span class="fw-bolder text-gray-800 fs-2hx lh-1 pb-1">2.48 ETH</span>
																<span class="fw-bolder text-gray-600 fs-4 pb-5">$6,047.84</span>
																<span class="fw-bold text-gray-600 fs-7 pb-1">Ending in</span>
																<span class="fw-bolder text-gray-800 fs-3">06h 52m 47s</span>
															</div>
															<!--end::Body-->
															<!--begin::Footer-->
															<div class="d-flex flex-stack mt-auto bd-highlight">
																<!--begin::Actions-->
																<a href="#" class="btn btn-primary btn-sm flex-shrink-0 me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_bidding">Place a Bid</a>
																<a href="#" class="btn btn-light btn-sm flex-shrink-0" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">View Item</a>
																<!--end::Actions-->
															</div>
															<!--end::Footer-->
														</div>
														<!--end::Wrapper-->
													</div>
													<!--end::Col-->
												</div>
												<!--end::Row-->
											</div>
											<!--end::Body-->
										</div>
									</div>
									<!--end::Col-->
								    </div>

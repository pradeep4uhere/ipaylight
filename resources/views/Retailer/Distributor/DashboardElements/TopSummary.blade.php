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
															<span class="card-label fw-bolder fs-4 text-gray-800">{{getLocalText('total_payment_recived')}}</span>
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
									
								    </div>

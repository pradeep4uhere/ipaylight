<!--begin::Engage widget 4-->
<div class="card" style="background: #1C325E;">
											<!--begin::Body-->
											<div class="card-body d-flex ps-xl-15">
												<!--begin::Action-->
												<div class="m-0">
													<!--begin::Title-->
													<div class="position-relative fs-2x z-index-2 fw-bolder text-white mb-7">
													<span class="me-2">{{getLocalText('You have got')}}
													<span class="position-relative d-inline-block text-danger">
														<a href="#" class="text-danger opacity-75-hover">{{$dashboardItem['totalUserCount']}} {{getLocalText('contacts_user')}}</a>
														<!--begin::Separator-->
														<span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
														<!--end::Separator-->
														<?php $lastWeekContact = 1;?>
													</span></span>{{getLocalText('User')}}.
													<br /><span class="fs-5">{{str_replace('[0]',$lastWeekContact, getLocalText('last_week_contact'))}}</span></div>
													<!--end::Title-->
													<!--begin::Action-->
													<div class="mb-3">
														<a href='#' class="btn btn-danger fw-bold me-2">{{getLocalText('View All Contact')}}</a>
													</div>
													<!--begin::Action-->
												</div>
												<!--begin::Action-->
												<!--begin::Illustration-->
												<img src="assets/media/illustrations/sigma-1/17-dark.png" class="position-absolute me-3 bottom-0 end-0 h-200px" alt="" />
												<!--end::Illustration-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Engage widget 4-->
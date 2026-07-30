<!--begin::List Widget 5-->
<div class="card card-xl-stretch">
											<!--begin::Header-->
											<div class="card-header align-items-center border-0 mt-4">
												<h3 class="card-title align-items-start flex-column">{{getLocalText('Login Activities')}}
													<span class="fw-bolder mb-2 text-dark"></span>
													<span class="text-muted fw-bold fs-7">{{getLocalText('Last Login')}}:&nbsp;{{getFormatDate(getAuthValue('last_login_at'))}}</span>
												</h3>
											</div>
											<div class="separator separator-dashed"></div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body pt-5">
												<!--begin::Timeline-->
												<div class="timeline-label">
													@if(!empty($dashboardItem['userLoginActivities']))
													
													@foreach($dashboardItem['userLoginActivities'] as $item)
													<?php $array = ['warning','success','info','danger']; 
													$randomKey = array_rand($array);
													$jsonArr = json_decode($item['location'], true);
													?>
													<!--begin::Item-->
													<div class="timeline-item">
														<!--begin::Label-->
														<div class="timeline-label fw-bolder text-gray-800 fs-6">{{getFormatDate($item['created_at'],'H:i a')}}</div>
														<!--end::Label-->
														<!--begin::Badge-->
														<div class="timeline-badge">
															<i class="fa fa-genderless text-{{$array[$randomKey]}} fs-1"></i>
														</div>
														<!--end::Badge-->
														<!--begin::Text-->
														<div class="fw-mormal timeline-content text-muted ps-2">Date: {{getFormatDate($item['created_at'])}}<br>
															<span>IPAddress: {{$item['ip_address']}}<span>
															<span class="text-muted fw-bold d-block fs-7">{{$jsonArr['regionName']}}</span>
															<span class="text-muted fw-bold d-block fs-7">{{$jsonArr['cityName']}}, {{$jsonArr['regionCode']}}, {{$jsonArr['zipCode']}}, {{$jsonArr['countryName']}}</span>
															<span class="text-muted fw-bold d-block fs-7">Location: {{$jsonArr['latitude']}}, {{$jsonArr['longitude']}}</span>
														</div>
														<!--end::Text-->
													</div>
													@endforeach
													@endif
													<!--end::Item-->
													<!--begin::Item-->
												</div>
												<!--end::Timeline-->
											</div>
											<!--end: Card Body-->
										</div>
										<!--end: List Widget 5-->
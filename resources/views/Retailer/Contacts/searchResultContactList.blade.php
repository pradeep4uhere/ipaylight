<div class="card card-flush h-lg-100">
											<!--begin::Card header-->
											<div class="card-header mt-6">
												<!--begin::Card title-->
												<div class="card-title flex-column">
													<h3 class="fw-bolder mb-1">Contact Search Result</h3>
													<div class="fs-6 text-gray-400">From Total {{$UserContactListCount}} Contact</div>
												</div>
												<!--end::Card title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<a href="{{route('ro.rocontactlist')}}" class="btn btn-bg-primary text-white fw-bolder btn-sm">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path>
                                                            <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    View All Contacts
                                                  </a>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end::Card toolbar-->
											<!--begin::Card body-->
											<div class="card-body d-flex flex-column p-9 pt-3 mb-9">

                                                @if(!empty($userContactList))
                                                @foreach($userContactList as $item)
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<!--begin::Avatar-->
													<div class="me-5 position-relative">
														<!--begin::Image-->
														<div class="symbol symbol-35px symbol-circle">
                                                            <?php $randomClass = getRandomClassName(); ?>
															<span class="symbol-label  {{$randomClass['key']}} {{$randomClass['value']}} fw-bold fs-4">{{getFirstChar($item->first_name)}}</span>
														</div>
														<!--end::Image-->
													</div>
													<!--end::Avatar-->
													<!--begin::Details-->
													<div class="fw-bold">
                                                        <a href="javascript:void(0)"class="fs-5 fw-bolder text-gray-900 text-hover-primary">
														{{$item->first_name}}&nbsp;{{$item->last_name}}</a>
														<div class="text-gray-400">M: {{$item->mobile_number}} &amp; E: {{$item->email}}</div>
													</div>
													<!--end::Details-->
													<!--begin::Badge-->
													<div class="badge badge-danger ms-auto">{{$item->beneficiaryAccounts->count()}}</div>
													<!--end::Badge-->
												</div>
												<div class="card-toolbars py-10 px-10">
												 <?php $getPayoutList = getPayoutList(); ?>
												 <?php foreach($getPayoutList as $item){ ?>
												  <a href="{{route('ro.rocontactlist')}}" class="btn btn-bg-primary text-white fw-bolder btn-sm">
                                                  	 {{$item}}
                                                  </a>
												  <?php } ?>
												</div>
												<!--end::Item-->
                                                @endforeach
                                                @endif
											</div>
											
											<!--end::Card body-->
										</div>
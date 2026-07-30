<div class="alert alert-danger mt-5" style="display:none" id="errorMsg"></div>
<div class="alert alert-success mt-5" style="display:none" id="successMsg"></div>
<div class="card card-mute mt-5  mb-10">

									<!--begin::Card header-->
									<div class="card-header align-items-center py-5 gap-2 gap-md-5">
										<!--begin::Card title-->
										<div class="card-title">
											All Beneficiary List
										</div>
                                        
										<!--end::Card title-->
											<!--begin::Card toolbar-->
										<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
										<a href="{{route('dmt.addnewbeneficiary',['cid'=>encryptString($data['cid'])])}}" class="btn btn-sm btn-danger">
												Add New Benificiery
											</a>
										</div>
										<!--end::Card toolbar-->
									</div>
									<!--end::Card header-->
									<!--begin::Card body-->
									<div class="card-body pt-0">
										<!--begin::Table-->
										<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_report_returns_table">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
													<th class="min-w-10px">SN</th>
													<th class="text-center min-w-35px">Bank</th>
													<th class="text-start min-w-75px">Transfer</th>
													<th class="text-start min-w-100px">Beneficiary Name</th>
													<th class="text-start min-w-75px">Bank Name</th>
													<th class="text-start min-w-75px">Account No</th>
													<th class="text-start min-w-75px">IFSC Code</th>
													<th class="text-center min-w-75px">Status</th>
                                                    <th class="text-center min-w-75px">Verified</th>
                                                   
                                                    <th class="text-end min-w-75px">Action</th>
												</tr>
												<!--end::Table row-->
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody class="fw-bold text-gray-600">
												<?php $count=1;?>
												@foreach($data['accountList'] as $item)
												<?php 
												$identifier = encryptString($item['serviceName'].'|'.$item['id']); ?>
												<!--begin::Table row-->
												<tr>
													<!--begin::Date=-->
													<td>{{$count}}</td>
													<td><img src="{{asset('assets/bank/'.$item['bank_icon'])}}" height="35px"/></td>
													<td class="text-start">
													@if($item['serviceName']=='PG')
														<button type="button" class="btn btn-sm btn-light-success dmttransferNow" data-bs-toggle="modal" data-bs-target="#kt_modal_transfer_money" data-servicename="{{'PAYOUT'}}"  data-indentifier="{{$identifier}}" data-route-url="{{route('payout.gettransferform')}}">Transfer Now</button>
													@elseif($item['api_contact_id']!="")
														<button type="button" class="btn btn-sm btn-light-success dmttransferNow" data-bs-toggle="modal" data-bs-target="#kt_modal_transfer_money" data-indentifier="{{$identifier}}" data-servicename="{{'DMT'}}" data-route-url="{{route('payout.gettransferform')}}">Transfer Now</button>
													@else
													<div id="transferNowButton_{{$identifier}}" style="display:none">
														<button type="button" class="btn btn-sm btn-light-success dmttransferNow" data-bs-toggle="modal" data-bs-target="#kt_modal_transfer_money" data-indentifier="{{$identifier}}" data-servicename="{{'DMT'}}" data-route-url="{{route('payout.gettransferform')}}">Transfer Now</button>
													</div>
													<form class="verifyAccountForm" action="{{route('payout.verifyaccount')}}" method="post" id="verifyForm_{{$identifier}}">
														@csrf
														<input type="hidden" name="identifier" value="{{$identifier}}"/>
														<input type="hidden" name="identifier_service" value="{{encryptString('DMT')}}"/>
														<button type="submit" class="btn btn-sm btn-light-danger me-3" title="" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="right" data-bs-toggle="tooltip-dark" data-bs-custom-class="tooltip-dark" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Verification must before transfer money.">Verify Account</button>
													</form>
													@endif
													</td>

													<!--end::Date=-->
													<!--begin::No products returned=-->
													<td class="text-start pe-0">{{$item['beneficiary_name']}}</td>
													<!--end::No products returned=-->
													<!--begin::No orders refunded=-->
													<td class="text-start pe-0">{{$item['bank_name']}}</td>
													<td class="text-start pe-0">{{$item['account_number']}}</td>
													<!--end::No orders refunded=-->
													<!--begin::No orders replaced=-->
													<td class="text-start pe-0">{{$item['ifsc_code']}}</td>
													<td class="text-center">
													@if($item['is_verified']=='Yes')
													<span class="badge badge-light-success fs-8 fw-bolder">Verified</span>
													@else
													<span class="badge badge-light-danger fs-8 fw-bolder">Not Verified</span>
													@endif
													</td>
													<td class="text-center pe-0">
													@if($item['status']=='Active')
													<span class="badge badge-light-success fs-8 fw-bolder">Active</span>
													@else
													<span class="badge badge-light-danger fs-8 fw-bolder">{{$item['status']}}</span>
													@endif
													</td>
                                                   
													<td class="text-end"><a href="#" class="btn btn-sm btn-light-danger">Remove</a></td>
													<!--end::Total replaced=-->
												</tr>
												<!--end::Table row-->
												<?php $count++;?>
												@endforeach
												
											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Products-->
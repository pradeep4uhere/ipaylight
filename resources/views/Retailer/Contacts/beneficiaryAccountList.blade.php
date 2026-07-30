
@extends('Retailer.layouts.dashboard')
@section('content')
@if ($errors->has('error'))
			@include('utils.errorMessage',['message'=> $errors->first('error')])
		@endif

		<div class="row mb-2">
			
            <div class="card card-flush  flex-row-fluid overflow-hidden mb-5">
			
                <!--begin::Background-->
                <div class="position-absolute top-0 end-0 opacity-0.8 pe-none text-end">
                    <img src="assets/media/svg/men.svg" class="w-175px">
                </div>
                <!--end::Background-->
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Contact Details</h2>
                    </div>
                </div>
				
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 fs-6 ">
				<div class="fw-bolder fs-4 text-gray-800">{{$userContactDetails->first_name}}&nbsp;{{$userContactDetails->last_name}}</div>
                <div class="fw-bold fs-7 text-gray-600">
				<br><span class="fw-bolder">Mobile:</span>&nbsp;{{$userContactDetails->mobile_number}}&nbsp;&nbsp;|&nbsp;&nbsp;<span class="fw-bolder">Email:</span> {{$userContactDetails->email}},
                <br><span class="fw-bolder">Address:</span>&nbsp;{{$userContactDetails->address}}&nbsp;, {{$userContactDetails->zipcode}}
                <br><span class="fw-bolder">Status:</span class="fw-bolder"> @if($userContactDetails->status=='Active')
                <span class="badge badge-light-success fs-8 fw-bolder">{{$userContactDetails->status}}</span> 
                @else 
                <span class="badge badge-light-success fs-8 fw-bolder">$userContactDetails->status</span>
                @endif
				</div>
            </div>
            <!--end::Card body-->
        </div>
			
			
			<!--begin::Card-->
			<div class="card mt-5">
			<div class="justify-content-start ribbon ribbon-start ribbon-clip p-5">
			<div class="ribbon-label fs-4 fw-bolder">You are Using - {{getPayoutList()[$serviceName]}}
				<span class="ribbon-inner bg-info"></span>
			</div>
			</div>
			
				<!--begin::Card header-->
				<div class="card-header border-0 mt-10">
					<!--begin::Card title-->
					<div class="card-title">
						<!--begin::Search-->
						<div class="d-flex align-items-center position-relative my-1">
							<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
							<span class="svg-icon svg-icon-1 position-absolute ms-6">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
									<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
								</svg>
							</span>
							<!--end::Svg Icon-->
							<input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{getLocalText('search_beneficiary')}}" />
						</div>
						<!--end::Search-->
					</div>
					<!--begin::Card title-->
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
					
					<!--begin::Toolbar-->
					<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
						
						<a href="{{route('ro.view-contact',['id'=>encryptstring($userContactDetails->id)])}}"  class="btn btn-danger me-3">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
						<span class="svg-icon svg-icon-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
								<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
							</svg>
						</span>
						Add  Beneficiary
						</a>
						
					</div>
					<!--end::Toolbar-->
					<!--begin::Group actions-->
					<div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
						<div class="fw-bolder me-5">
						<span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
						<button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
					</div>
					<!--end::Group actions-->
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table-->
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-6 text-uppercase gs-0">
						<th class="min-w-30px">Icon</th>
						<th class="min-w-100px">Id</th>
                        <th class="text-start min-w-100px">Bank Name</th>
                        <th class="text-start min-w-100px">Beneficiary</th>
                        <th class="text-start min-w-100px">Account</th>
                        <th class="text-start min-w-100px">IFSC Code</th>
						<th class="text-start min-w-100px">Created Date</th>
                        <th class="text-start min-w-50px">Status</th>
						<th class="text-center">Action</th>
                        
                    </tr>
                    <!--end::Table row-->
                </thead>
                <?php if(!empty($listData)){  ?>
                    <?php foreach($listData as $item){  //dd();?>
                    <tr class="">
						<td class="text-start">
						<?php $imagePath = asset("storage/bank/".$item['icon']); ?>
						<img src="{{$imagePath}}" height="30px" width="30px" title="" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="right"  data-bs-toggle="tooltip-dark" data-bs-custom-class="tooltip-dark" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="{{$item->bank_name}}"/>
						</td>
                        <!-- <td class="text-start"><a href="{{route('ro.view-contact',['id'=>encryptString($item->id)])}}" class="menu-link px-3">{{$item->beneficiary_id}}</a></td> -->
                        <td class="text-start">{{$item->beneficiary_id}}</td>
                        <td class="text-start">{{$item->bank_name}}</td>
						<td class="text-start">{{$item->beneficiary_name}}</td>
                        <td class="text-start">{{$item->account_number}}</td>
                       	<td class="text-start">{{$item->ifsc_code}}</td>
                        <td class="text-start">
                            <a href="#" class="text-gray-600 text-hover-primary" id="kt_drawer_chat_toggle">{{$item->created_at}}</a>
                        </td>
                        <td class="text-start">
                            <?php if($item->status == 'Active'){ ?>
                            <span class="badge py-3 px-4 fs-7 badge-light-success">{{$item->status}}</span>
                            <?php } ?>
                            <?php if($item->status == 'InActive'){ ?>
                                <span class="badge py-3 px-4 fs-7 badge-light-danger">{{$item->status}}</span>
                            <?php } ?>
                        </td>
						<td class="text-end">
						@if($item->api_contact_id!=null)
						<input type="hidden" name="identifier" value="{{encryptString($serviceName.'|'.$item->id)}}"/>
                        <button type="button" class="btn btn-sm btn-primary me-3 transferNow" data-bs-toggle="modal" data-bs-target="#kt_modal_transfer_money" data-indentifier="{{encryptString($serviceName.'|'.$item->id)}}" data-route-url="{{route('payout.gettransferform')}}">Transfer Now</button>
						

						
						@else
						<form action="{{route('payout.verifyaccount')}}" method="post">
						@csrf
						<input type="hidden" name="identifier" value="{{encryptString($serviceName.'|'.$item->id)}}"/>
                        <button type="submit" class="btn btn-sm btn-light-danger me-3" title="" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="right"  data-bs-toggle="tooltip-dark" data-bs-custom-class="tooltip-dark" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Verification must before transfer money.">Verify Account</button>
						</form>
						@endif
                    	</td>
                       
                    </tr>
                    <?php }} ?>
				</table>
				<!--end::Table-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
		<!--begin::Modals-->
		
 <!--begin::Modal - Create App-->
    <!--end::Modal - Create App-->	
@include('Retailer.Contacts.transferMoneyModelBox')
@endsection
               
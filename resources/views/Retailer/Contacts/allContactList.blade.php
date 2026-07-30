
@extends('Retailer.layouts.dashboard')
@section('content')

        
		<!--begin::Card-->
		<div class="card">
			<!--begin::Card header-->
			<div class="card-header border-0 pt-6">
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
						<input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{getLocalText('search_contact')}}" />
					</div>
					<!--end::Search-->
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
                
					<!--begin::Toolbar-->
					<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
					
                        <!--begin::Export-->
						
						<!--end::Export-->
						<a href="{{route('ro.add-new-contact')}}" class="btn btn-danger fw-bolder fs-6 me-3">
						<span class="svg-icon svg-icon-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path>
								<path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor"></path>
							</svg>
						</span>
						{{getLocalText('add_new_contact')}}
						</a>
					</div>
					<!--end::Toolbar-->
					
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table-->
				<table class="table align-middle table-row-dashed fs-7 gy-5" id="kt_customers_table">
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-100px">Id</th>
                        <th class="text-start min-w-100px">Name</th>
                        <th class="text-start min-w-100px">Mobile</th>
                        <th class="text-start min-w-125px">Address</th>
						<th class="text-start min-w-100px">Created Date</th>
                        <th class="text-start min-w-100px">Status</th>
                        <th class="text-start">View</th>
						<th class="text-start">Action</th>
						<th class="text-end">Transfer</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <?php if(!empty($userContactList)){  ?>
                    <?php foreach($userContactList as $item){  //dd();?>
                    <tr class="">
                        <td class="text-start">
						@if(getAuthValue('role')=='Distributor')
						<a href="{{route('ds.view-contact',['user'=>encryptString($userProfile->id),'id'=>encryptString($item->id)])}}" class="menu-link px-3" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Click here to Add New Beneficiary to {{$item->first_name}} contact">{{$item->contact_id}}</a>
						@else
						<a href="{{route('ro.view-contact',['id'=>encryptString($item->id)])}}" class="menu-link px-3" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Click here to Add New Beneficiary to {{$item->first_name}} contact">{{$item->contact_id}}</a>
						@endif
						</td>
                        <td class="text-start">{{$item->first_name}}<br/>{{$item->last_name}}</td>
                        <td class="text-start">{{$item->mobile_number}}<br/>{{$item->email}}</td>
                        <td class="text-start">{{$item->zipcode}}<br/>{{$item->address}}</td>
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
                        <td class="text-start">
						<a href="{{route('ro.view-beneficiary',['id'=>encryptString($item->id)])}}" class="menu-link px-3" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="View All Beneficiary">
						<span class="svg-icon svg-icon-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#009ef7">
								<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="#009ef7"></path>
								<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="#009ef7"></rect>
							</svg>
						</span>
						</a>
						</td>
						<td class="text-start">
						@if(getAuthValue('role')=='Distributor')
						<form action="{{ route('ds.delete-contact', encryptstring($item->id)) }}" method="POST" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Remove Contacts">
						@else
						<form action="{{ route('ro.delete-contact', encryptstring($item->id)) }}" method="POST" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Remove Contacts">
						@endif
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-link p-0">
						<span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#f1416c">
							<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="#f1416c"></path>
							<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="#f1416c"></path>
							<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="#f1416c"></path>
						</svg>
						</button>
						</form>
					</span>
                    </td>
					<td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Transfer
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true" style="">
                            <!--begin::Menu item-->
							<?php $payout = getPayoutList(); ?>
							@if(!empty($payout))
							@foreach($payout as $k=>$payout)
                            	<div class="menu-item px-3"><a href="{{route('ro.verify-beneficiary',['servicecontactid'=>encryptString($k.$item->id)])}}" class="menu-link px-3">{{$payout}}</a></div>
							@endforeach
							@endif
                        </div>
                        <!--end::Menu-->
                    </td>
                    </tr>
                    <?php }} ?>
				</table>
				<!--end::Table-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
		
	
        @endsection
               
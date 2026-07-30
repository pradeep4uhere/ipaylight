@extends('Admin.layouts.Admin.listing')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <div>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
</div>
    </div>
@endif  
	   <div class="card card-xl-stretch mb-xl-12">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">Wallet Transaction Summary</h3>
            </div>
            <div class="card-body pt-0">
            <div class="row">
                <div class="col-xl-3">
                <!--begin::Item-->
                <div class="d-flex align-items-center bg-light-success rounded p-5 mb-7">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-warning me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"></path>
                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2 py-5">
                        <a href="#" class="fw-bolder text-gray-800 text-hover-success fs-6">Total Credit Amount</a>
                        <span class="text-black fs-4 fw-bolder d-block">₹ {{$userProfile->dashboardItem->totalWalletCredit}}</span>
                    </div>
                </div>
            </div>
            

                <!--end::Item-->
                <!--begin::Item-->
            <div class="col-xl-3">
                <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-7">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-success me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"></path>
                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2 py-5">
                        <a href="#" class="fw-bolder text-gray-800 text-hover-danger fs-6">Total Debit Amount</a>
                        <span class="text-black fs-4 fw-bolder d-block">₹ {{$userProfile->dashboardItem->totalWalletDebit}}</span>
                    </div>
                    <!--end::Title-->
                </div>
            </div>
                <!--end::Item-->
                <!--begin::Item-->
            <div class="col-xl-3">
                <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-danger me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"></path>
                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2 py-5">
                        <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Total Pending Amount</a>
                        <span class="text-black fs-4 fw-bolder d-block">₹ {{$userProfile->dashboardItem->totalWalletPending}}</span>
                    </div>
                    
                </div>
            </div>
                <!--end::Item-->
                <!--begin::Item-->
            <div class="col-xl-3">
                <div class="d-flex align-items-center bg-light-info rounded p-5">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-info me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"></path>
                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2 py-5">
                        <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Total Reversal Amount</a>
                        <span class="text-black fs-4 fw-bolder d-block">₹ {{$userProfile->dashboardItem->totalWalletReversal}}</span>
                    </div>
                    <!--end::Title-->
                </div>
            </div>
                <!--end::Item-->
            </div>
        </div>
            
            
</div>
<h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-gray-800">{{getLocalText('latest_wallet_transaction')}}s</span>
                <span class="text-gray-400 mt-1 fw-bold fs-6">Trasnactions list debit and credit from wallet</span>
        </h3>
		@include('Admin.Wallet.searchForm')

        
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
						<input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search In Wallet List" />
					</div>
					<!--end::Search-->
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
               
					<!--begin::Toolbar-->
					<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
						<a href="{{route('export.admin_wallet-transaction')}}"  class="btn btn-primary me-3">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor" />
								<path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor" />
								<path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
							</svg>
						</span>
						<!--end::Svg Icon-->Export Report</a>
						<!--end::Export-->
						
					</div>
					<!--end::Toolbar-->
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table-->
				<table class="table align-middle table-row-dashed fs-7 gy-5" id="kt_ecommerce_sales_table">
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-100px">Date</th>
                        <th class="text-start min-w-100px">Description</th>
                        <th class="text-start min-w-100px">Reference No.</th>
                        <th class="text-start min-w-125px">Txn Number</th>
						<th class="text-center min-w-100px">Open Bal.</th>
                        <th class="text-center min-w-100px">Amount</th>
                        <th class="text-center min-w-100px">Type</th>
						<th class="text-center min-w-100px" nowrap="nowrap">Close Bal.</th>
                        <th class="text-center min-w-50px">Status</th>
                        <th class="text-start"></th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <?php if(!empty($userProfile->dashboardItem->walletTransactions)){  ?>
                    <?php foreach($userProfile->dashboardItem->walletTransactions as $item){  //dd();?>
                    <tr class="">
                        <td nowrap="nowrap">
                            <a href="#" class="text-gray-800 text-hover-primary">{{getFormatDate($item->created_at,'d M Y | H:i A')}}</a>
                        </td>
                        <td class="text-start">{{$item->description}}</td>
                        <td class="text-start">{{$item->reference_number}}</td>
                        <td>
                            <a  href="{{route('admin.transaction-view',['tid'=>encryptString($item->transaction_id)])}}" class="text-gray-600 text-hover-primary">{{generateNumberWithPad($item->transaction_id)}}</a>
                        </td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-boldest">₹ {{number_format($item->open_balance,2)}}</span>
                        </td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-boldest">₹ {{number_format($item->amount,2)}}</span>
                        </td>
                        <td class="text-end">
                            <?php if($item->transaction_type == 'Credit'){ ?>

                                <span class="badge badge-success fs-base">
                            <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
                                    <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
                                </svg>
                            </span>&nbsp;
                            {{$item->transaction_type}}</span>
                            <?php } ?>
                            <?php if($item->transaction_type == 'Debit'){ ?>
                                <span class="badge badge-danger fs-base">&nbsp;
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                        <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->&nbsp;{{$item->transaction_type}}&nbsp;&nbsp;</span>
                            <?php } ?>
                        </td>
						<td class="text-end">
                            <span class="text-gray-800 fw-boldest">₹ {{number_format($item->close_balance,2)}}</span>
                        </td>
                        <td class="text-end">
                            <?php if($item->transaction_status == 'Success'){ ?>
                            <span class="badge py-3 px-4 fs-7 badge-light-success">{{$item->transaction_status}}</span>
                            <?php } ?>
                            <?php if($item->transaction_status == 'Failed'){ ?>
                                <span class="badge py-3 px-4 fs-7 badge-light-danger">{{$item->transaction_status}}</span>
                            <?php } ?>
                            <?php if($item->transaction_status == 'Pending'){ ?>
                                <span class="badge py-3 px-4 fs-7 badge-light-info">{{$item->transaction_status}}</span>
                            <?php } ?>
                            <?php if($item->transaction_status == 'Reversal'){ ?>
                                <span class="badge py-3 px-4 fs-7 badge-light-danger">{{$item->transaction_status}}</span>
                            <?php } ?>
                        </td>
                        <td class="text-end"></td>
                    </tr>
                    <?php }} ?>
				</table>
				<!--end::Table-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
		
@endsection

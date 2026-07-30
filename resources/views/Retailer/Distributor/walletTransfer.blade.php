<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-4 mb-xl-10">
        <!--begin::Engage widget 3-->
        <div class="card bg-primary h-md-100">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column pt-13 pb-14">
                <!--begin::Heading-->
                <div class="m-0">
                    <!--begin::Title-->
                    <h1 class="fw-bold text-white text-center lh-lg mb-9">Wallet Transfer
                    <br>
                    <span class="fw-boldest">Transfer To Retailer's Wallet</span></h1>
                    <!--end::Title-->
                    <!--begin::Illustration-->
                    <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 mb-lg-12" style="background-image:url('assets/media/svg/wallet_transfer.svg')"></div>
                    <!--end::Illustration-->
                </div>
                <!--end::Heading-->
                <!--begin::Links-->
                <div class="text-center">
                    <!--begin::Link-->
                    <a class="btn btn-sm btn-white btn-color-gray-800 me-2" href="{{route(getUserProfileRoutePrefix('wallet_transactions'),['user'=>encryptUserProfileId($userProfile)])}}">View Wallet Report</a>
                    <!--end::Link-->
                    
                </div>
                <!--end::Links-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Engage widget 3-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-8 mb-5 mb-xl-10 ">
        <!--begin::Chart widget 11-->
        <div class="card card-flush h-xl-100 bg-light-white">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder text-dark">Wallet Transfer To Retailer's Account</span>
                    <span class="text-gray-400 mt-1 fw-bold fs-6">Transfer To Retialer's Wallet</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <ul class="nav" id="kt_chart_widget_11_tabs">
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4 me-1 active" data-bs-toggle="tab"  href="#kt_chart_widget_11_tab_content_3">View Wallet Transactions</a>
                        </li>
                    </ul>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pb-0 pt-4">
            <form action="{{route(getUserProfileRoutePrefix('transfer_to_wallet'),['user'=>encryptUserProfileId($userProfile)])}}" method="post">
              @csrf
            <div class="row mb-5">
					<!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Choose Transaction Type</span>
					</label>
					<!--end::Label-->
					<div class="col-md-6 fv-row">
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Transfer Type" name="payment_type">
                            <option value="">Select Transaction Type</option>
                            <option value="debit">Debit Amount</option>
                            <option value="credit">Credit Amount</option>
                        </select>
					</div>
                    <x-input-error :messages="$errors->payment_type->get('payment_type')" class="mt-2" />
					<!--end::Col-->
			</div>
            <div class="row mb-5">
					<!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Enter Amount(₹)</span>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-12 fv-row">
						<input type="number" name="amount" class="form-control form-control-lg form-control-solid" placeholder="Enter Amount"/>
					</div>
					<!--end::Col-->
			</div>
            <div class="row mb-16">
					<!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Payment Descriptions</span>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-12 fv-row">
						<input type="text" name="description" class="form-control form-control-lg form-control-solid" placeholder="Enter Transfer Descriptions" />
					</div>
					<!--end::Col-->
			</div>

            <div class="row">
            <div class="text-right">
                    <!--begin::Link-->
                    <input type="hidden" name="user_id"  value="{{encryptUserProfileId($userProfile)}}" />
                    <input type="submit" name="submit" class="btn btn-sm btn-primary btn-color-white-800 me-2 fs-5" placeholder="Enter Transfer Descriptions" value="Submit" />
                </div>
            </div> 
            </form>
            </div>
            
           
        </div>
        <!--end::Chart widget 11-->
    </div>
    <!--end::Col-->
</div>
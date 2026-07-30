<div class="row gy-5 g-xl-10">
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
                    
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <form action="{{route('ro.wallet_transfer')}}" method="post">
            @csrf
            <div class="card-body pb-0 pt-4">
            <div class="row mb-10">
					<!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Enter Mobile Number</span>
					</label>
					<!--end::Label-->
					<div class="col-md-6 fv-row">
                    <input type="number" name="mobile" class="form-control form-control-lg form-control-solid" placeholder="Enter Mobile Number"/>
					</div>
                    <x-input-error :messages="$errors->mobile->get('mobile')" class="mt-2" />
					<!--end::Col-->
			</div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
            <input type="submit" name="submit" class="btn btn-sm btn-primary btn-color-white-800 me-2 fs-5" placeholder="Enter Transfer Descriptions" value='Search User' />
            </div>
            </form>
           
       
        </div>
       
        <!--end::Chart widget 11-->
    </div>
    <!--end::Col-->
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
                    <a class="btn btn-sm btn-white btn-color-gray-800 me-2" href="{{route('ro.wallet_transactions')}}">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21 18.3V4H20H5C4.4 4 4 4.4 4 5V20C10.9 20 16.7 15.6 19 9.5V18.3C18.4 18.6 18 19.3 18 20C18 21.1 18.9 22 20 22C21.1 22 22 21.1 22 20C22 19.3 21.6 18.6 21 18.3Z" fill="currentColor"></path>
                            <path d="M22 4C22 2.9 21.1 2 20 2C18.9 2 18 2.9 18 4C18 4.7 18.4 5.29995 18.9 5.69995C18.1 12.6 12.6 18.2 5.70001 18.9C5.30001 18.4 4.7 18 4 18C2.9 18 2 18.9 2 20C2 21.1 2.9 22 4 22C4.8 22 5.39999 21.6 5.79999 20.9C13.8 20.1 20.1 13.7 20.9 5.80005C21.6 5.40005 22 4.8 22 4Z" fill="currentColor"></path>
                        </svg>
                    </span>View Wallet Report</a>
                    <!--end::Link-->
                    
                </div>
                <!--end::Links-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Engage widget 3-->
    </div>
    <!--end::Col-->
    
</div>
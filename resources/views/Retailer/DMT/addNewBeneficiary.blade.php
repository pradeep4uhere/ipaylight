@extends('Retailer.layouts.dashboard')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row gy-5 g-xl-10">
    
    <!--begin::Col-->
    <div class="col-xl-8 mb-5 mb-xl-10 ">
    <div class="row mb-2">
            <div class="card card-flush py-4 flex-row-fluid overflow-hidden mb-5">
                <!--begin::Background-->
                <div class="position-absolute top-0 end-0 opacity-9 pe-none text-end">
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
                <span class="fs-4 fw-bold">{{$userContactDetails->first_name}}&nbsp;{{$userContactDetails->last_name}}</span>
                <br>Mobile:{{$userContactDetails->mobile_number}}&nbsp;|&nbsp;Email: {{$userContactDetails->email}},
                <br>Mobile:{{$userContactDetails->address}}&nbsp;, {{$userContactDetails->zipcode}}
                <br>Status: @if($userContactDetails->status=='Active')
                <span class="badge badge-light-success fs-8 fw-bolder">{{$userContactDetails->status}}</span> 
                @else 
                <span class="badge badge-light-success fs-8 fw-bolder">$userContactDetails->status</span>
                @endif
            </div>
            <!--end::Card body-->
        </div>
        </div>
        <div class="row mb-2">
        <!--begin::Chart widget 11-->
        <div class="card card-mute h-xl-100 bg-light-white">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder text-dark">Add Beneficiary Details</span>
                    <span class="text-gray-400 mt-1 fw-bold fs-8">Enter Bank Account Details</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->

            <form action="{{route(getAuthRoutePrefix().'.save-beneficiary-details')}}" method="post">
            @csrf
            <input type="hidden" name="user_contact_id" value="{{$userContactDetails->id}}"/>
         
            <div class="card-body pb-0 pt-4">
            <div class="row mb-2">
					<!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Beneficiary Name</span>
					</label>
					<!--end::Label-->
					<div class="col-md-12 fv-row">
                    <input type="text" name="beneficiary_name" class="form-control form-control-lg form-control-solid" placeholder="Enter Beneficiary Name"/>
                    <x-input-error :messages="$errors->get('beneficiary_name')" class="mt-2" />
					</div>
					<!--end::Col-->
			</div>
            <div class="row mb-2">
					<!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Account Number</span>
					</label>
					<!--end::Label-->
					<div class="col-md-6 fv-row">
                    <input type="text" name="account_number" class="form-control form-control-lg form-control-solid" placeholder="Account Number"/>
                    <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
					</div>
                   
                    <div class="col-md-6 fv-row">
                    <input type="text" name="re_enter_account_number" class="form-control form-control-lg form-control-solid" placeholder="Re-enter Account Number"/>
                    <x-input-error :messages="$errors->get('re_enter_account_number')" class="mt-2" />
					</div>
					<!--end::Col-->
			</div>
            <div class="row mb-10">
				
					<div class="col-md-6 fv-row">
                    <!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Bank Name</span>
					</label>
					<!--end::Label-->
                    {!!getMasterBankSelectList()!!}
                     <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
					</div>
                   
                    <div class="col-md-6 fv-row">
                    <!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Bank IFSC Code</span>
					</label>
					<!--end::Label-->
                    <input type="text" name="ifsc_code" id="ifsc_code" class="form-control form-control-lg form-control-solid" placeholder="IFSC Code"/>
                    <x-input-error :messages="$errors->get('ifsc_code')" class="mt-2" />
					</div>
					<!--end::Col-->
			</div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
            <input type="submit" name="submit" class="btn btn-sm btn-primary btn-color-white-800 me-2 fs-5" placeholder="Enter Transfer Descriptions" value="Add New Beneficiary" />
            </div>
            </form>
           
       
        </div>
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
                    <h1 class="fw-bold text-white text-center lh-lg mb-9">Your Contacts
                    <br>
                    <span class="fw-boldest">View All Contacts</span></h1>
                    <!--end::Title-->
                    <!--begin::Illustration-->
                    <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 mb-lg-12" style="background-image:url('assets/media/svg/add.svg')"></div>
                    <!--end::Illustration-->
                </div>
                <!--end::Heading-->
                <!--begin::Links-->
                <div class="text-center">
                    <!--begin::Link-->
                    @if(getAuthRoutePrefix()=='ds')
                    <a class="btn btn-sm btn-white btn-color-gray-800 me-2 mb-2" href="{{route('ds.rocontactlist',['user'=>encryptstring($userProfile->id)])}}">
                    @else
                    <a class="btn btn-sm btn-white btn-color-gray-800 me-2 mb-2" href="{{route('ro.rocontactlist')}}">
                    @endif
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path>
                            <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    View All Contacts</a>&nbsp;
                    
                    
                </div>
                <!--end::Links-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Engage widget 3-->
    </div>
    <!--end::Col-->
    
</div>
<!--end::Wrapper-->
@endsection
                        
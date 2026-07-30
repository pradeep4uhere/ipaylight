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
        <!--begin::Chart widget 11-->
        <div class="card card-flush h-xl-100 bg-light-white">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder text-dark">{{getLocalText('add_new_contact')}}</span>
                    <span class="text-gray-400 mt-1 fw-bold fs-6">{{getLocalText('enter_contact_details')}}</span>
                </h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <form action="{{route('ro.save-new-contact')}}" method="post">
            @csrf
            <div class="card-body pb-0 pt-4">
            <div class="row mb-10">
					
					<div class="col-md-6 fv-row">
                    <!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Enter First Name</span>
					</label>
					<!--end::Label-->
                    <input type="text" name="first_name" class="form-control form-control-lg form-control-solid" placeholder="Enter First Name" value="{{ old('first_name') }}"/>
                    <x-input-error :messages="$errors->first('first_name')" class="mt-2" />
					</div>
                   
                    <div class="col-md-6 fv-row">
                    <label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Enter Last Name</span>
					</label>
                    <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Enter Last Name"/>
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
					</div>
					<!--end::Col-->
			</div>
            <div class="row mb-10">
					
					<div class="col-md-6 fv-row">
                    <!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Enter Mobile Number</span>
					</label>
					<!--end::Label-->
                    <input type="number" name="mobile_number" class="form-control form-control-lg form-control-solid" placeholder="enter Mobile Number"/>
                    <x-input-error :messages="$errors->get('mobile_number')" class="mt-2" />
					</div>
                   
                    <div class="col-md-6 fv-row">
                    <label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Enter Email Address</span>
					</label>
                    <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Enter Email Address"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
					</div>
					<!--end::Col-->
			</div>
            <div class="row mb-10">
					
					<div class="col-md-6 fv-row">
                    <!--begin::Label-->
					<label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Enter Address</span>
					</label>
					<!--end::Label-->
                    <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Enter Address"/>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
					</div>
                   
                    <div class="col-md-6 fv-row">
                    <label class="col-lg-12 col-form-label fw-bolder fs-6">
						<span class="required">Enter Zipcode</span>
					</label>
                    <input type="number" name="zipcode" class="form-control form-control-lg form-control-solid" placeholder="Enter Zipcode"/>
                    <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
					</div>
					<!--end::Col-->
			</div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
            <a href="{{route('ro.ro_contacts')}}" class="btn btn-sm btn-danger fw-bolder fs-6 me-2">
            <span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path>
                    <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor"></path>
                </svg>
            </span>
            {{getLocalText('search_contact')}}</a>
            <input type="submit" name="submit" class="btn btn-sm btn-primary btn-color-white-800 me-2 fs-5" placeholder="Enter Transfer Descriptions" value="Save Contact" />
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
                    <h1 class="fw-bold text-white text-center lh-lg mb-9">Your Contacts
                    <br>
                    <span class="fw-boldest">
                    
                    View All Contacts</span></h1>
                    <!--end::Title-->
                    <!--begin::Illustration-->
                    <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 mb-lg-12" style="background-image:url('assets/media/svg/add_user.svg')"></div>
                    <!--end::Illustration-->
                </div>
                <!--end::Heading-->
                <!--begin::Links-->
                <div class="text-center">
                    <!--begin::Link-->
                    <a class="btn btn-sm btn-white btn-color-gray-800 me-2" href="{{route('ro.rocontactlist')}}">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path>
                            <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    View All Contacts</a>
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
<!--end::Wrapper-->
@endsection
                        
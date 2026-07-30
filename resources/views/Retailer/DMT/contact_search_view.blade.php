<div class="row gy-5 g-xl-10">
<div class="col-xl-8">
    <div class="card card-bordered">
        <div class="card-header">
            <h3 class="card-title">Search Customer</h3>
            
        </div>
        <div class="card-body">
        <div class="row">
                    <div class="row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Customer Mobile No:</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                <input type="text" name="fname" id="mobileNumber" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Mobile Number" value="{{$data['mobileNumber']}}">
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Customer Account No:</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-4">
                        <input type="text" name="fname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="Account Number">
                        </div>
                        <!--end::Col-->
                    </div>
			</div>
        </div>
        <div class="card-footer">
        <input type="submit" name="submit" class="btn btn-sm btn-primary btn-color-white-800 me-2 fs-5" placeholder="Enter Transfer Descriptions" value="Search Contact" />
        <a href="{{route('ro.ro_contacts')}}" class="btn btn-sm btn-danger fw-bolder fs-6 me-2">
        <span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                </svg>
            </span>
            {{getLocalText('add_new_contact')}}
        </a>
        </div>
    </div>
</div>
@if(!empty($data['user']))
<div class="col-xl-4">
    <div class="card card-bordered">
        <div class="card-header">
            <h3 class="card-title"> Customer Details</h3>
            <div class="card-toolbar">
               
            </div>
        </div>
        <div class="card-body gs-0 gy-0" style="padding: 2rem 1.25rem;">
            @include('Retailer.DMT.customer_details',['data'=>$data])
        </div>
    </div>
</div>
</div>
@endif
@if(!empty($data['accountList']))
    @include('Retailer.DMT.account_list')
@elseif(!empty($data['user']) && empty($data['accountList']))
    @include('Retailer.DMT.no_account_list')
@endif
@include('Retailer.Contacts.transferMoneyModelBox')

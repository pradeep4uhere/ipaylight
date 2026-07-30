
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0 text-danger">Deactivate Account</h3>
        </div>
    </div>
    <!--end::Card header-->
 <!--begin::Content-->
 <div id="kt_account_settings_notifications" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_deactivate_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" action="{{route('admin.profile-deactivate',['user'=>encryptString($userProfile->id)])}}" method="post">
            @csrf
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                @if($userProfile->status=='inactive') 
                <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed mb-9 p-6">
                <div class="fw-bold text-danger fw-bolder">Profile Account is DeActivated</div>
                </div>
                @endif
                @if($userProfile->status=='active') 
                <div class="notice d-flex bg-light-success rounded border-success border border-dashed mb-9 p-6">
                <div class="fw-bold text-success fw-bolder">Profile Account is Activated.</div>
                </div>
                @endif

                 <!--begin::Notice-->
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">You Are Deactivating User Profile Account</h4>
                            <div class="fs-6 text-gray-700">Your user profile account deactivation process has begun. During this time, your account will be temporarily suspended, preventing access to its features and functionalities. You can reactivate your account at any time."
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
                <!--begin::Form input row-->
                <div class="form-check form-check-solid fv-row fv-plugins-icon-container">
                    <input name="deactivate" class="form-check-input" type="checkbox" value="1" id="deactivate" @if($userProfile->status=='inactive') checked="checked" @endif required="required">
                    <label class="form-check-label fw-bold ps-2 fs-6" for="deactivate">I confirm my account deactivation</label>
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                <!--end::Form input row-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
            @if($userProfile->status=='inactive')
                <button id="kt_account_deactivate_account_submit" type="submit" class="btn  btn-success  fw-bold">Activate Account</button>
            @endif
            @if($userProfile->status=='active')
            <button id="kt_account_deactivate_account_submit" type="submit" class="btn  btn-danger  fw-bold">De-Activate Account</button>
            @endif
            
            
            </div>
            <!--end::Card footer-->
        <input type="hidden"><div></div></form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
    </div>
       
</div>

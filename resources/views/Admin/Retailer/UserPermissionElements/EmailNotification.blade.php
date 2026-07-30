<div class="card mb-5 mb-xl-10">
<!--Email Setting-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_email_preferences" aria-expanded="true" aria-controls="kt_account_email_preferences">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Email Preferences</h3>
        </div>
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <form class="form" action="{{route('admin.save-permission-setting',['user'=>encryptString($userProfile->id)])}}" method="post">
        @csrf
            <!--begin::Card body-->
            <div class="card-body border-top px-9 py-9">
            <?php //dd($userProfile->dashboardItem->permissionTitleList);
            if(!empty($userProfile->dashboardItem->permissionTitleList)){ 
                $count=0;?>
                <?php foreach($userProfile->dashboardItem->permissionTitleList as $item){ 
                      if($item->permission_type=='EMAIL' && !empty($userProfile->dashboardItem->userPermissionArray)){
                      if(array_key_exists('EMAIL',$userProfile->dashboardItem->userPermissionArray)){
                ?>
                <!--begin::Option-->
                @if($count>0)
                <div class="separator separator-dashed my-6"></div>
                @endif
                <label class="form-check form-check-custom form-check-solid align-items-start">
                    <!--begin::Input-->
                    <input class="form-check-input me-3" type="checkbox" name="profilePermissionSetting[{{$item->permission_key}}]" value="true" @if($userProfile->dashboardItem->userPermissionArray['EMAIL'][$item->permission_key]==true) checked="checked" @endif>
                    <!--end::Input-->
                    <!--begin::Label-->
                    <span class="form-check-label d-flex flex-column align-items-start">
                        <span class="fw-bolder fs-5 mb-0">{{$item->permission_title}}</span>
                        <span class="text-muted fs-6">{{$item->permission_descriptions}}</span>
                    </span>
                    <!--end::Label-->
                </label>
                <!--end::Option-->
                <!--begin::Option-->
                
                <?php  }else { ?>
                     <!--begin::Option-->
                @if($count>0)
                <div class="separator separator-dashed my-6"></div>
                @endif
                <label class="form-check form-check-custom form-check-solid align-items-start">
                    <!--begin::Input-->
                    <input class="form-check-input me-3" type="checkbox" name="profilePermissionSetting[{{$item->permission_key}}]" value="true" >
                    <!--end::Input-->
                    <!--begin::Label-->
                    <span class="form-check-label d-flex flex-column align-items-start">
                        <span class="fw-bolder fs-5 mb-0">{{$item->permission_title}}</span>
                        <span class="text-muted fs-6">{{$item->permission_descriptions}}</span>
                    </span>
                    <!--end::Label-->
                </label>
                <!--end::Option-->
                <!--begin::Option-->

                <?php } ?>
                <?php $count++; } ?>
                <?php  } ?>
               
                <?php  } ?>
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <input type="hidden" name="action" value="EMAIL"/>
                <button class="btn btn-primary px-6">Save Changes</button>
            </div>
            <!--end::Card footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
</div>
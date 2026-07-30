<div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-5 mb-xl-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('assets/media/svg/happy.svg')">
<div class="card-body pt-9 pb-0">
    @include('Customer.Profile.SummeryItem')
    <!--begin::Navs-->
    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
        <!--begin::Nav item-->
        <?php if(getAuthValue('role')=='Distributor'){ $routeRole = 'ds'; }else{ $routeRole = 'admin'; } ?>
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 
            {{ ($actionName === 'admin.profile_view') ? 'active' : '' }}
            {{ ($actionName === 'ds.profile_view') ? 'active' : '' }}
            {{ ($actionName === 'ds.profile_edit') ? 'active' : '' }}
            {{ ($actionName === 'admin.profile_edit') ? 'active' : '' }}
            
            " href="{{route($routeRole.'.profile_view',['user'=>Crypt::encryptString($userProfile->id)])}}">Profile</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
            
            <a class="nav-link text-active-primary ms-0 me-10 py-5 
            {{ ($actionName === ('admin.profile-kyc-update')) ? 'active' : '' }}
            {{ ($actionName === ('ds.profile-kyc-update')) ? 'active' : '' }}
            " 
            href="{{route($routeRole.'.profile-kyc-update',['user'=>Crypt::encryptString($userProfile->id)])}}">KYC</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 
            {{ ($actionName === 'admin.profile-change-password') ? 'active' : '' }}
            {{ ($actionName === 'ds.profile-change-password') ? 'active' : '' }}
            " 
            href="{{route($routeRole.'.profile-change-password',['user'=>Crypt::encryptString($userProfile->id)])}}">Change Password</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 
            {{ ($actionName == 'admin.profile-verify-email') ? 'active' : '' }}
            {{ ($actionName == 'ds.profile-verify-email') ? 'active' : '' }}
            " 
            href="{{route($routeRole.'.profile-verify-email',['user'=>Crypt::encryptString($userProfile->id)])}}">Verify Email</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <!-- <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 
            {{ ($actionName == 'admin.profile-verify-mobile') ? 'active' : '' }}
            {{ ($actionName == 'ds.profile-verify-mobile') ? 'active' : '' }}
            " 
            href="{{route($routeRole.'.profile-verify-mobile',['user'=>Crypt::encryptString($userProfile->id)])}}">Verify Mobile</a>
        </li> -->
        <!--end::Nav item-->
           <!--begin::Nav item-->
           <!-- <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 
            {{ ($actionName == 'admin.profile-bank-account') ? 'active' : '' }}
            {{ ($actionName == 'ds.profile-bank-account') ? 'active' : '' }}
            " 
            href="{{route($routeRole.'.profile-bank-account',['user'=>Crypt::encryptString($userProfile->id)])}}">Bank Account</a>
        </li>  -->
        <!--end::Nav item-->
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 
            {{ ($actionName == 'admin.profile-tpin-setting') ? 'active' : '' }}
            {{ ($actionName == 'ds.profile-tpin-setting') ? 'active' : '' }}
            " 
            href="{{route($routeRole.'.profile-tpin-setting',['user'=>Crypt::encryptString($userProfile->id)])}}">TPIN Setting</a>
        </li> 
    </ul>
    <!--begin::Navs-->
</div>
</div>
<div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-5 mb-xl-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('assets/media/svg/happy.svg')">
<div class="card-body pt-9 pb-0">
    @include('Distributor.Profile.SummeryItem')
    <!--end::Details-->
    <!--begin::Navs-->
    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
        <!--begin::Nav item-->
        <?php if(getAuthValue('role')=='Distributor'){ $route = 'ds';} ?>
        <?php if(getAuthValue('role')=='Superdistributor'){ $route = 'sds';} ?>
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 
            {{ ($actionName == ('ds.profile')) ? 'active' : '' }}
            {{ ($actionName == ('ds.edit-profile')) ? 'active' : '' }}
            " href="{{route($route.'.profile')}}">Profile</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($actionName == $route.'.kyc-update') ? 'active' : '' }}" href="{{route($route.'.kyc-update')}}">KYC</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($actionName == $route.'.change-password') ? 'active' : '' }}" href="{{route($route.'.change-password')}}">Change Password</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($actionName == $route.'.verify-email') ? 'active' : '' }}" href="{{route($route.'.verify-email')}}">Verify Email</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($actionName == $route.'.verify-mobile') ? 'active' : '' }}" href="{{route($route.'.verify-mobile')}}">Verify Mobile</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($actionName == $route.'.two-factor-auth') ? 'active' : '' }}" href="{{route($route.'.two-factor-auth')}}">Two Factor Auth</a>
        </li>
        <!--end::Nav item-->
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($actionName == $route.'.bank-account') ? 'active' : '' }}" href="{{route($route.'.bank-account')}}">Bank Account</a>
        </li> 
        <!--end::Nav item-->
        
    </ul>
    <!--begin::Navs-->
</div>
</div>
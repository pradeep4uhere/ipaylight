<style>
.menu-title-gray-800 .menu-item .menu-link .menu-title {
    color: #fff;
}
</style>
<div id="kt_aside" class="aside aside-hoverabler fs-6 fw-bold" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle" style="background-color:#0a2267;color:#FFF">
        <!--begin::Brand-->
        <div class="aside-logo flex-column-auto" id="kt_aside_logo">
            <!--begin::Logo-->
            <a href="{{route('dashboard')}}">
                <img alt="Logo" src="logo.png" class="h-40px logo" />
            </a>
            <!--end::Logo-->
            
            <!--begin::Aside toggler-->
            <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">

                <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                <span class="svg-icon svg-icon-1 rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                        <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Aside toggler-->
        </div>
        <!--end::Brand-->
        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid">
            
            <!--begin::Aside Menu-->
            <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            
                <!--begin::Menu-->
                <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion  
                    {{ ($actionName == 'ds.dashboard') ? 'hover showing' : '' }}
                    {{ ($actionName == 'ds.transactions') ? 'hover showing' : '' }}
                    {{ ($actionName == 'ds.settalment') ? 'hover showing' : '' }} 
                    {{ ($actionName == 'ds.transactions-list') ? 'hover showing' : '' }} 
                    
                    ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Dashboards</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item {{ ($actionName == 'ds.transactions-list') ? 'hover show' : '' }} ">
                                <a class="menu-link" href="{{route('ds.transactions-list')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Transctions</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'ds.settalment') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.settalment')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Settalment</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                   
                    

                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">ds Account</span>
                        </div>
                    </div>
                    
                    
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                     {{ ($actionName == 'profile') ? 'hover showing' : '' }}
                     {{ ($actionName == 'kyc-update') ? 'hover showing' : '' }} 
                     {{ ($actionName == 'change-password') ? 'hover showing' : '' }} 
                     
                     ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor" />
                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Profile Account</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg  
                            {{ ($actionName == 'ds/profile') ? 'show' : '' }} 
                            {{ ($actionName == 'ds/kyc-update') ? 'show' : '' }} 
                            {{ ($actionName == 'ds/change-password') ? 'show' : '' }} 
                        ">
                            <div class="menu-item {{ ($actionName == 'ds/profile') ? 'hover show' : '' }} ">
                                <a class="menu-link" href="{{route('ds.profile')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Profile</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'ds/kyc-update') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.kyc-update')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">KYC</span>
                                </a>
                            </div>
                            
                            <div class="menu-item {{ ($actionName == 'ds/change-password') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.change-password')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Change Password</span>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                    {{ ($actionName == 'ds/verify-email') ? 'show' : '' }} 
                    {{ ($actionName == 'ds/verify-mobile') ? 'show' : '' }} 
                    {{ ($actionName == 'ds/two-factor-auth') ? 'show' : '' }} 
                    {{ ($actionName == 'ds/qrcode') ? 'show' : '' }} 
                    ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/technology/teh004.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21 10.7192H3C2.4 10.7192 2 11.1192 2 11.7192C2 12.3192 2.4 12.7192 3 12.7192H6V14.7192C6 18.0192 8.7 20.7192 12 20.7192C15.3 20.7192 18 18.0192 18 14.7192V12.7192H21C21.6 12.7192 22 12.3192 22 11.7192C22 11.1192 21.6 10.7192 21 10.7192Z" fill="currentColor" />
                                        <path d="M11.6 21.9192C11.4 21.9192 11.2 21.8192 11 21.7192C10.6 21.4192 10.5 20.7191 10.8 20.3191C11.7 19.1191 12.3 17.8191 12.7 16.3191C12.8 15.8191 13.4 15.4192 13.9 15.6192C14.4 15.7192 14.8 16.3191 14.6 16.8191C14.2 18.5191 13.4 20.1192 12.4 21.5192C12.2 21.7192 11.9 21.9192 11.6 21.9192ZM8.7 19.7192C10.2 18.1192 11 15.9192 11 13.7192V8.71917C11 8.11917 11.4 7.71917 12 7.71917C12.6 7.71917 13 8.11917 13 8.71917V13.0192C13 13.6192 13.4 14.0192 14 14.0192C14.6 14.0192 15 13.6192 15 13.0192V8.71917C15 7.01917 13.7 5.71917 12 5.71917C10.3 5.71917 9 7.01917 9 8.71917V13.7192C9 15.4192 8.4 17.1191 7.2 18.3191C6.8 18.7191 6.9 19.3192 7.3 19.7192C7.5 19.9192 7.7 20.0192 8 20.0192C8.3 20.0192 8.5 19.9192 8.7 19.7192ZM6 16.7192C6.5 16.7192 7 16.2192 7 15.7192V8.71917C7 8.11917 7.1 7.51918 7.3 6.91918C7.5 6.41918 7.2 5.8192 6.7 5.6192C6.2 5.4192 5.59999 5.71917 5.39999 6.21917C5.09999 7.01917 5 7.81917 5 8.71917V15.7192V15.8191C5 16.3191 5.5 16.7192 6 16.7192ZM9 4.71917C9.5 4.31917 10.1 4.11918 10.7 3.91918C11.2 3.81918 11.5 3.21917 11.4 2.71917C11.3 2.21917 10.7 1.91916 10.2 2.01916C9.4 2.21916 8.59999 2.6192 7.89999 3.1192C7.49999 3.4192 7.4 4.11916 7.7 4.51916C7.9 4.81916 8.2 4.91918 8.5 4.91918C8.6 4.91918 8.8 4.81917 9 4.71917ZM18.2 18.9192C18.7 17.2192 19 15.5192 19 13.7192V8.71917C19 5.71917 17.1 3.1192 14.3 2.1192C13.8 1.9192 13.2 2.21917 13 2.71917C12.8 3.21917 13.1 3.81916 13.6 4.01916C15.6 4.71916 17 6.61917 17 8.71917V13.7192C17 15.3192 16.8 16.8191 16.3 18.3191C16.1 18.8191 16.4 19.4192 16.9 19.6192C17 19.6192 17.1 19.6192 17.2 19.6192C17.7 19.6192 18 19.3192 18.2 18.9192Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Authentication</span>
                            <span class="menu-arrow"></span>
                        </span>


                        <div class="menu-sub menu-sub-accordion menu-active-bg 
                           
                    
                        ">
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                               
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    <div class="menu-item">
                                        <a class="menu-link" href="">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Two-steps</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link" href="">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Change Password</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="menu-item {{ ($actionName == 'two-factor-auth') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.two-factor-auth')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Two Factor Auth</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'verify-email') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.verify-email')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Verify Email</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'verify-mobile') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.verify-mobile')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Verify Mobile</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'qrcode') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.qrcode')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">QR Code</span>
                                </a>
                            </div>
                            
                           
                           
                        </div>
                    </div>
                   
                    
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">Miscellaneous
</span>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                    {{ ($actionName == 'mobilrecharge') ? 'show' : '' }} 
                    {{ ($actionName == 'phonebill') ? 'show' : '' }} 
                    {{ ($actionName == 'landlinebill') ? 'show' : '' }} 
                    {{ ($actionName == 'gasbill') ? 'show' : '' }} 
                    ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
                                        <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
                                        <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{getLocalText('bill_payment')}}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item {{ ($actionName == 'mobilrecharge') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.mobilrecharge')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{getLocalText('mobile_recharge')}}</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'phonebill') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.phonebill')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{getLocalText('phone_bill')}}</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'landlinebill') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.landlinebill')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{getLocalText('landline_bills')}}</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'gasbill') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.gasbill')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{getLocalText('gas_bills')}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                    {{ ($actionName == 'ds.allretailer') ? 'show' : '' }} 
                    {{ ($actionName == 'ds/settalment') ? 'show' : '' }} 
                    {{ ($actionName == 'ds/paymentcreditreport') ? 'show' : '' }} 
                    {{ ($actionName == 'ds/paymentdebitreport') ? 'show' : '' }} 
                    {{ ($actionName == 'profile_view') ? 'show' : '' }} 
                    
                    ">
                    
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor" />
                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Retailer</span>
                            <span class="menu-arrow"></span>
                        </span>
                         <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item {{ ($actionName == 'ds.allretailer') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.allretailer')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Retailer</span>
                                </a>
                            </div>
                          <!--  <div class="menu-item {{ ($actionName == 'settalment') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.settalment')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Retialer Payments</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'paymentcreditreport') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.paymentcreditreport')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Retialer Payouts</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'paymentdebitreport') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.paymentdebitreport')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Retailer Wallet</span>
                                </a>
                            </div>-->
                        </div> 
                    </div>
                    
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                    {{ ($actionName == 'ds.my_commission_setting') ? 'show' : '' }} 
                    {{ ($actionName == 'addcontact') ? 'show' : '' }} 
                    {{ ($actionName == 'allgateway') ? 'show' : '' }} 
                    {{ ($actionName == 'addgateway') ? 'show' : '' }} 
                    
                    ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor" />
                                        <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Payment Gateway</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item 
                            {{ ($actionName == 'ds.my_commission_setting') ? 'hover show' : '' }}
                            {{ ($actionName == 'ds.my_commission_setting' || '') ? 'hover show' : '' }}
                            ">
                                <a class="menu-link" href="{{route('ds.my_commission_setting')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Payment Gateway</span>
                                </a>
                            </div>
                        </div>
                       
                    </div>

                    <!--All Report Aside Menu Start Here-->
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">All Report</span>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                    {{ ($actionName == 'ds.my_commission_setting') ? 'show' : '' }} 
                    {{ ($actionName == 'ds.wallettransaction') ? 'show' : '' }} 
                    {{ ($actionName == 'ds.transactions-list') ? 'show' : '' }} 
                    ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Transction Report</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item 
                            {{ ($actionName == 'ds.transactions') ? 'hover show' : '' }}
                            {{ ($actionName == 'ds.transactions-list') ? 'show' : '' }} 
                            ">
                                <a class="menu-link" href="{{route('ds.transactions-list')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Transaction Report</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'ds.wallettransaction') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('ds.wallettransaction')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Wallet Transaction</span>
                                </a>
                            </div>
                        </div>
                    </div>  
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Settalment Report</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item {{ ($actionName == 'messageadd') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.messageadd')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Settalment Report</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'messageinbox') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.messageinbox')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Unsettal Report</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'messagesent') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.messagesent')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Future Settalment Report</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'messagesent') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.messagesent')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Export Settalment Report</span>
                                </a>
                            </div>
                        </div>
                    </div> 
                    <!--All Report Aside Menu Ends Here-->                



                    
                    
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">Message & Support  
</span>
                        </div>
                    </div>
                    
                    
                    
                    
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                    {{ ($actionName == 'messageadd') ? 'show' : '' }} 
                    {{ ($actionName == 'messageinbox') ? 'show' : '' }} 
                    {{ ($actionName == 'messagesent') ? 'show' : '' }} 
                    {{ ($actionName == 'messagedeleted') ? 'show' : '' }} 
                    ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Inbox</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item {{ ($actionName == 'messageadd') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.messageadd')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">New Message</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'messageinbox') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.messageinbox')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Inbox</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'messagesent') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.messagesent')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Sent</span>
                                </a>
                            </div>
                            <div class="menu-item {{ ($actionName == 'messagedeleted') ? 'hover show' : '' }}">
                                <a class="menu-link" href="{{route('user.messagedeleted')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All Deleted</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1
                    {{ ($actionName == 'support.overview') ? 'show' : '' }} 
                    {{ ($actionName == 'overview') ? 'show' : '' }} 
                    {{ ($actionName == 'createticket') ? 'show' : '' }} 
                    {{ ($actionName == 'faqs') ? 'show' : '' }} 
                    
                    ">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/graphs/gra006.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M13 5.91517C15.8 6.41517 18 8.81519 18 11.8152C18 12.5152 17.9 13.2152 17.6 13.9152L20.1 15.3152C20.6 15.6152 21.4 15.4152 21.6 14.8152C21.9 13.9152 22.1 12.9152 22.1 11.8152C22.1 7.01519 18.8 3.11521 14.3 2.01521C13.7 1.91521 13.1 2.31521 13.1 3.01521V5.91517H13Z" fill="currentColor" />
                                    <path opacity="0.3" d="M19.1 17.0152C19.7 17.3152 19.8 18.1152 19.3 18.5152C17.5 20.5152 14.9 21.7152 12 21.7152C9.1 21.7152 6.50001 20.5152 4.70001 18.5152C4.30001 18.0152 4.39999 17.3152 4.89999 17.0152L7.39999 15.6152C8.49999 16.9152 10.2 17.8152 12 17.8152C13.8 17.8152 15.5 17.0152 16.6 15.6152L19.1 17.0152ZM6.39999 13.9151C6.19999 13.2151 6 12.5152 6 11.8152C6 8.81517 8.2 6.41515 11 5.91515V3.01519C11 2.41519 10.4 1.91519 9.79999 2.01519C5.29999 3.01519 2 7.01517 2 11.8152C2 12.8152 2.2 13.8152 2.5 14.8152C2.7 15.4152 3.4 15.7152 4 15.3152L6.39999 13.9151Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{getLocalText('support_center')}}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item {{ ($actionName == 'support.overview') ? 'hover show' : '' }}">
                            <a class="menu-link" href="{{route('support.overview')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{getLocalText('all_tickets')}}</span>
                            </a>
                        </div>
                        
                        <div class="menu-item {{ ($actionName == 'faq') ? 'hover show' : '' }}">
                            <a class="menu-link" href="{{route('support.faqs')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">FAQ</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{getLocalText('privacy_policy')}}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{getLocalText('terms_conditions')}}</span>
                            </a>
                        </div>
                    </div>

                    
                </div>
                    
                    
                    
                    
                   
                    
                    <div class="menu-item">
                        <div class="menu-content">
                            <div class="separator mx-1 my-4"></div>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="#">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z" fill="currentColor" />
                                        <path opacity="0.3" d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{getAppName()}}&nbsp;{{getAppVersion()}}</span>
                        </a>
                    </div>
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside menu-->
        <!--begin::Footer-->
        
        <!--end::Footer-->
    </div>
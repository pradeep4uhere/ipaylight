<!--begin::Payment Gateway Settalment Setting Start Here-->
@include('Admin.Retailer.UserPermissionElements.PaymentGatewaySetting')
<!--end::Payment Gateway Settalment Setting Start Here-->

<!--begin::Payment Gateway Settalment Setting Start Here-->
@include('Admin.Retailer.UserPermissionElements.GatewaySetting')
<!--end::Payment Gateway Settalment Setting Start Here-->

<?php if(!empty($userProfile->dashboardItem->permissionTitleList)){ ?>
<!--begin::Email Notification Setting Start Here-->
@include('Admin.Retailer.UserPermissionElements.ProfilePermission')								
<!--end::Email Notification Ends Here-->
<?php } ?>
<!--begin::Email Notification Setting Start Here-->
@include('Admin.Retailer.UserPermissionElements.EmailNotification')								
<!--end::Email Notification Ends Here-->

<!--begin::Push Notification Setting Start Here-->
@include('Admin.Retailer.UserPermissionElements.DeactivateAccount')								
<!--end::Push Notification Setting Ends Here-->
									

	
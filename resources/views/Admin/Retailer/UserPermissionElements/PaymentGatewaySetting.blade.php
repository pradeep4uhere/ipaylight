<!--begin::Items-->
<div class="card mb-5 mb-xl-10">
<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accouxnts" aria-expanded="true" aria-controls="kt_account_connected_accounts">
<table class="tablealign-middle">
<tbody class="fs-6 fw-bold">
    <!--begin::Table row-->
    <tr><td class="py-5"><span class="fw-bolder m-0 fs-3">Payment Gateways Setting</span><br/>
    <span class="fs-7">Accept Payment From Payment Gateway based on particular Gatway<span></td></tr>
    
</table>
</div>
<div id="kt_account_settings_notifications" class="collapse show">
    <!--begin::Form-->
    <form class="form" action="{{route('admin.save-gateway-permission',['user'=>encryptString($userProfile->id)])}}" method="post">
        @csrf
        <!--begin::Card body-->
        <div class="card-body border-top px-9 pt-3 pb-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-row-dashed border-gray-300 align-middle gy-6">
                    <tbody class="fs-6 fw-bold">
                        <!--begin::Table row-->
                        <tr>
                            <td class="min-w-250px fs-4 fw-bolder">Payment Gateway</td>
                            <td class="w-125px">
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_pg" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=PG]">
                                    <label class="form-check-label ps-2" for="kt_settings_notification_email">Gateway</label>
                                </div>
                            </td>
                            <td class="w-125px">
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_is" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=IN]">
                                    <label class="form-check-label ps-2" for="kt_settings_notification_phone">Instant</label>
                                </div>
                            </td>
                            <td class="w-125px">
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_nd" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=ND]">
                                    <label class="form-check-label ps-2" for="kt_settings_notification_phone">Next Day</label>
                                </div>
                            </td>
                            <td class="w-125px">
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_nw" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=NW]">
                                    <label class="form-check-label ps-2" for="kt_settings_notification_phone">N Week</label>
                                </div>
                            </td>
                            <td class="w-125px">
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" id="kt_settings_notification_po" checked="checked" data-kt-check="true" data-kt-check-target="[data-kt-settings-notification=PO]">
                                    <label class="form-check-label ps-2" for="kt_settings_notification_phone">Payout</label>
                                </div>
                            </td>
                        </tr>
                        <!--begin::Table row-->
                        <?php //dd($userProfile->dashboardItem->gatewayActiveList); 
                              if(!empty($userProfile->dashboardItem->gatewayActiveList)){ ?>
                        <?php foreach($userProfile->dashboardItem->gatewayActiveList as $item){ 
                              if(!empty($userProfile->dashboardItem->userPermissionArray)){
                                if(array_key_exists('GATEWAY', $userProfile->dashboardItem->userPermissionArray)){
                                    if(!array_key_exists($item->gateway_name, $userProfile->dashboardItem->userPermissionArray['GATEWAY'])){
                                        $gatewayPermission['gateway_name']= false;
                                        $gatewayPermission['gateway_settalment_instant']= false;
                                        $gatewayPermission['gateway_settalment_next_day']= false;
                                        $gatewayPermission['gateway_settalment_next_week']= false;
                                        $gatewayPermission['gateway_payout']= false;
                                    }else{
                                        $gatewayPermission = $userProfile->dashboardItem->userPermissionArray['GATEWAY'][$item->gateway_name];
                                    }
                                }else{
                                  $gatewayPermission['gateway_name']= false;
                                  $gatewayPermission['gateway_settalment_instant']= false;
                                  $gatewayPermission['gateway_settalment_next_day']= false;
                                  $gatewayPermission['gateway_settalment_next_week']= false;
                                  $gatewayPermission['gateway_payout']= false;
                                }
                              }else{
                                    $gatewayPermission['gateway_name']= false;
                                    $gatewayPermission['gateway_settalment_instant']= false;
                                    $gatewayPermission['gateway_settalment_next_day']= false;
                                    $gatewayPermission['gateway_settalment_next_week']= false;
                                    $gatewayPermission['gateway_payout']= false;
                              } 
                        ?>
                        <!--begin::Table row-->
                        <tr>
                            <td class="fs-4"><img src="{{asset('assets/media/cards/'.getPaymentGatewayIcon($item->gateway_name))}}" height="50" width="100px"/>&nbsp;&nbsp;{{$item->gateway_name}}</td>
                            <td>
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="true" id="{{$item->gateway_name}}1" name="{{$item->gateway_name}}[gateway_name]" @if($gatewayPermission['gateway_name']==true) checked="checked" @endif data-kt-settings-notification="PG">
                                    <label class="form-check-label ps-2" for="{{$item->gateway_name}}1"></label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-check-solid"> 
                                    <input class="form-check-input" type="checkbox" value="true" id="{{$item->gateway_name}}2" name="{{$item->gateway_name}}[gateway_settalment_instant]" @if($gatewayPermission['gateway_settalment_instant']==true) checked="checked" @endif data-kt-settings-notification="IN">
                                    <label class="form-check-label ps-2" for="{{$item->gateway_name}}2"></label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="true" id="{{$item->gateway_name}}3" name="{{$item->gateway_name}}[gateway_settalment_next_day]" @if($gatewayPermission['gateway_settalment_next_day']==true) checked="checked" @endif data-kt-settings-notification="ND">
                                    <label class="form-check-label ps-2" for="{{$item->gateway_name}}3"></label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="true" id="{{$item->gateway_name}}4" name="{{$item->gateway_name}}[gateway_settalment_next_week]" @if($gatewayPermission['gateway_settalment_next_week']==true) checked="checked" @endif data-kt-settings-notification="NW">
                                    <label class="form-check-label ps-2" for="{{$item->gateway_name}}4"></label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="true" id="{{$item->gateway_name}}5" name="{{$item->gateway_name}}[gateway_payout]" @if($gatewayPermission['gateway_payout']==true) checked="checked" @endif data-kt-settings-notification="PO">
                                    <label class="form-check-label ps-2" for="{{$item->gateway_name}}5"></label>
                                </div>
                            </td>   
                        </tr>

                        <?php } ?>
                        <?php } ?>
                        <!--begin::Table row-->
                        
                    </tbody>
                </table>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button class="btn btn-light btn-active-light-primary me-2">Discard</button>
                            <input type="hidden" name="action" value="GATEWAY">
                            <button type="submit" class="btn btn-primary px-6">Save Changes</button>
                        </div>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
        
    </form>
    <!--end::Form-->
	</div>
</div>

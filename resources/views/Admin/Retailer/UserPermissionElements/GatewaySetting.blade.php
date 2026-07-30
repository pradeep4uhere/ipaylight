<div class="card mb-5 mb-xl-10">
<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accouxnts" aria-expanded="true" aria-controls="kt_account_connected_accounts">
	<div class="card-title mt-5">
		<h3 class="fw-bolder m-0">Settalement For Payment Gateways</h3>
	</div>
	<div class="fs-8 mb-5">Settlement is the process through which a merchant receives money paid by their end users for a particular product/service. There are a number of entities involved in the settlement process.</div>
	
</div>

<div class="accordion" id="kt_accordion_1">
<?php //dd($userProfile->dashboardItem->settalmentSettings);
if(!empty($userProfile->dashboardItem->gatewayActiveList)){ ?>
<?php foreach($userProfile->dashboardItem->gatewayActiveList as $item){ ?>
	<div class="accordion-item">
		<h2 class="accordion-header" id="kt_accordion_1_header_{{$item->id}}">
			<button class="accordion-button fs-4 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_{{$item->id}}" aria-expanded="false" aria-controls="kt_accordion_1_body_{{$item->id}}">
			<img src="{{asset('assets/media/cards/'.getPaymentGatewayIcon($item->gateway_name))}}" height="50" width="100px"/>&nbsp;&nbsp;
			{{$item->gateway_name}}</button>
		</h2>
		<div id="kt_accordion_1_body_{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_{{$item->id}}" data-bs-parent="#kt_accordion_1" style="">
			<div class="accordion-body">
			@include('Admin.Retailer.UserPermissionElements.DomesticSettalment')
			<div class="separator separator-dashed my-5"></div>
			@include('Admin.Retailer.UserPermissionElements.InternationalSettalment')
			</div>
			</div>
		</div>
	</div>
<?php } ?>
<?php } ?>
</div>
</div>

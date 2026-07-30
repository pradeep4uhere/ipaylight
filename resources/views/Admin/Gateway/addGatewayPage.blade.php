@extends('Admin.layouts.Admin.dashboard')
@section('content')
<style>
.form-floating .form-select {
     padding-top: 1rem;
}
</style>
<!--begin::Wrapper-->
<div class="card mb-5 mb-xl-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bolder m-0">Add New Payment Gateway</h3>
		</div>
		<!--end::Card title-->
	</div>
	<!--begin::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_profile_details" class="collapse show">
		<!--begin::Form-->
		<form id="kt_account_profile_details_form" class="form" method="post" action="{{route('savegateway')}}">
			@csrf
            <!--begin::Card body-->
			<div class="card-body border-top p-9">
				<!--begin::Input group-->
				
				<div class="row mb-6">
					<!--begin::Label-->
					<div class="col-lg-3">
					<label class="col-lg-12 col-form-label fw-bold fs-6 required">Choose Gateway<span class="require"></span></label>
					</div>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-3">
                    {!!$paymentGatewayList!!}
					</div>
					<div class="col-lg-3">
					<label class="col-lg-12 col-form-label fw-bold fs-6 required">Gateway Mode</label>
					</div>
					<div class="col-lg-3">
                    <select class="form-select form-select-solid fw-bolder" data-control="select2" name="mode" data-hide-search="true">
						<option value="Test">Test</option>
						<option value="Prod">Prod</option>
					</select>
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Col-->
					<div class="col-lg-12">
						<!--begin::Row-->
						<div class="row">
							<!--begin::Col-->
							
                            <div class="col-lg-6 form-floating mb-7">
                                <input type="text" class="form-control form-control-solid" id="floatingInput1" name="pg_name" placeholder="Enter Gateway Name"/>
                                <label for="floatingInput required">Enter Gateway Name</label>
                                <x-input-error :messages="$errors->get('pg_name')" class="mt-2" /> 
                            </div>
                            

							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-lg-6 form-floating mb-7">
                                <input type="text" class="form-control form-control-solid required" id="floatingInput2" name="pg_short_code" placeholder="Gateway ShortCode"/>
                                <label for="floatingInput required">Gateway ShortCode</label>
                                <x-input-error :messages="$errors->get('pg_short_code')" class="mt-2" /> 
                            </div>
							<!--end::Col-->
						</div>
                        <div class="row">
							<!--begin::Col-->
							
                            <div class="col-lg-6 form-floating mb-7">
                                <input type="text" class="form-control form-control-solid" id="floatingInput3" name="pg_client_key" placeholder="Enter Gateway CLIENT KEY"/>
                                <label for="floatingInput required">Enter Gateway CLIENT KEY</label>
                                <x-input-error :messages="$errors->get('pg_client_key')" class="mt-2" /> 
                                
                            </div>

							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-lg-6 form-floating mb-7">
                                <input type="text" class="form-control form-control-solid" id="floatingInput4" name="pg_secert_key" placeholder="Enter Gateway SECERT KEY"/>
                                <label for="floatingInput">Enter Gateway SECERT KEY</label>
                                <x-input-error :messages="$errors->get('pg_secert_key')" class="mt-2" /> 
                            </div>
							<!--end::Col-->
						</div>
                        <div class="row">
							<!--begin::Col-->
							
                            <div class="col-lg-6 form-floating mb-7">
                                <input type="text" class="form-control form-control-solid" id="floatingInput1" name="payout_client_key" placeholder="Enter Payout CLIENT KEY"/>
                                <label for="floatingInput">Enter Payout CLIENT KEY</label>
                            </div>

							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-lg-6 form-floating mb-7">
                                <input type="text" class="form-control form-control-solid" id="floatingInput2" name="payout_secerts_key" placeholder="Enter Payout SECERT KEY"/>
                                <label for="floatingInput">Enter Payout SECERT KEY</label>
                            </div>
							<!--end::Col-->
                            
						</div>
						<!--end::Row-->
                        <div class="row">
							<!--begin::Col-->
							
                            <div class="col-lg-6 form-floating">
                            <div class="d-flex flex-stack mb-8">
								<!--begin::Label-->
								<div class="me-5">
									<label class="fs-6 fw-bold">Accepting Payment By Retailers Or Users</label>
									<div class="fs-7 fw-bold text-muted">If you need to disable, Please Off this button</div>
								</div>
								<!--end::Label-->
								<!--begin::Switch-->
								<label class="form-check form-switch form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" checked="checked" name="gateway_active">
									<span class="form-check-label fw-bold text-muted">Allowed</span>
								</label>
								<!--end::Switch-->
							</div>
                            </div>

							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-lg-6 form-floating mb-7">
                            <div class="d-flex flex-stack mb-8">
								<!--begin::Label-->
								<div class="me-5">
									<label class="fs-6 fw-bold">Payout Feature By Retailers Or Users</label>
									<div class="fs-7 fw-bold text-muted">If you need to disable, Please Off this button</div>
								</div>
								<!--end::Label-->
								<!--begin::Switch-->
								<label class="form-check form-switch form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" checked="checked" name="payout_active">
									<span class="form-check-label fw-bold text-muted">Allowed</span>
								</label>
								<!--end::Switch-->
							</div>
                            </div>
							<!--end::Col-->
						</div>
                        <label class="btn btn-outline btn-outline-dashed btn-outline-default active d-flex text-start p-6">
                        <span class="fs-8">Note: All these above details will get from your payment getway dashboard.</span>
</div>
                        <hr/>
                       

                        <!--All Payment Method Start-->
                        <div class="row">
							<!--begin::Col-->
                            <div class="col-lg-12 form-floating">
                            <div class="mb-15 fv-row">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack">
									<!--begin::Label-->
									<div class="fw-bold me-5">
										<label class="fs-6">Allowed Payment Type</label>
										<div class="fs-7 text-muted">Allow Payment Type Accepted By Gateways</div>
									</div>
								</div>
								<!--end::Wrapper-->
							</div>
                            <div>
                            <div class="col-lg-6">
                            <table class="table align-middle table-row-dashed fs-7 gy-5">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-400 fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-250px">Payment Type</th>
													<th class="min-w-125px text-center">Action</th>
													<th class="min-w-125px text-center">Base Rate</th>
													<th class="min-w-125px text-center">Rate Type</th>
												</tr>
												<!--end::Table row-->
											</thead>
                                            <tbody>
                                                <?php if($paymentTypeList) { ?>
                                                <?php foreach($paymentTypeList as $k=>$item){ ?> 
                                                <tr>
                                                
                                                <td>
                                                <div class="fw-bold me-5">
                                                    <label class="form-check form-check-custom form-check-solid">
                                                    &nbsp;<img src="{{ asset('assets/media/cards/' . $item['icon']) }}" width="60px" />
                                                    <span class="form-check-label fw-bold">{{$item['name']}}</span>
                                                </label>
                                                </div>
                                                </td>
                                                <td>
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" name="payment_type_status[{{$k}}]"  value="1">
                                                        <span class="form-check-label fw-bold text-muted">Allowed</span>
                                                    </label>
                                                 </td>
                                                 <td>
                                                    <div class="d-flex">
                                                        <div class="fw-bold me-5">
                                                            <input type="text" inputmode="decimal" maxlength="4" class="form-control form-control-solid" id="kt_inputmask_6" name="payment_type_value[{{$k}}]" value="{{$item['base_price']}}"  placeholder="2.5"/>
                                                        </div>
                                                    </div>
                                                </td>
												<td>
													<select name="payment_rate_type[{{$k}}]" aria-label="Select Rate Type" data-control="select2" class="form-select form-select-solid">
														<option value="Percentage" selected>Percentage</option>
														<option value="Flat" >Flat</option>
													</select>
											
                                                </td>
                                                </tr>
                                                <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                </table>
                            </div>
							
                            

							<!--end::Col-->
							<!--begin::Col-->
							
							<!--end::Col-->



						</div>
                        
                        <!--All Payment Method Ends-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
               
                            
				
				
				<!--end::Input group-->
				
				
				
			</div>
			<!--end::Card body-->
			<!--begin::Actions-->
			<div class="card-footer d-flex justify-content-end py-6 px-9">
				<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
				<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
			</div>
			<!--end::Actions-->
		</form>
		<!--end::Form-->
	</div>
	<!--end::Content-->
</div>
@endsection
                        
<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bolder m-0">Bank Account Details</h3>
		</div>
		<!--end::Card title-->
	</div>
	<!--begin::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_profile_details" class="collapse show">
		<!--begin::Form-->
			<!--begin::Card body-->
			<div class="card-body border-top p-9">
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Full Name As Per Bank Account</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="As Per Your Pan Card"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
						<input type="tel" name="full_name_in_bank" class="form-control form-control-lg form-control-solid" placeholder="First Name" value="{{getAuthValue('name')}}" />
					</div>
					
					<!--end::Col-->
				</div>
				<!--end::Input group-->


				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Account Number</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="12 Digit Valid Aadhar Number"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
						<input type="number" name="account_number" class="form-control form-control-lg form-control-solid"  value="{{getAuthValue('account_number')}}" readonly="readonly" />
					</div>
					
				</div>
				<!--end::Input group-->





				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Bank Name</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Valid Bank Account Number"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
						<input type="text" name="bank_name" class="form-control form-control-lg form-control-solid" placeholder="Enter Bank Name" value="{{getAuthValue('bank_name')}}" readonly="readonly" />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->

                <!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Bank IFSC Code</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="IFSC Code must be valided from your branch"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
						<input type="text" name="bank_ifsc_code" class="form-control form-control-lg form-control-solid" placeholder="Enter Bank IFSC Code" value="{{getAuthValue('bank_ifsc_code')}}" readonly="readonly" />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->



				<!--begin::Input group For Upload AAdhar Front Page-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">Upload Cancle Cheque</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4">
						<!--begin::Image input-->
						<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
                            <?php $imagePath = asset("storage/ekyc/".getAuthValue('cancle_cheque')); ?>
							<div class="image-input-wrapper w-400px h-225px" style="background-image: url({{$imagePath}})"></div>
							<!--end::Preview existing avatar-->
							<!--begin::Cancel-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel cancle cheque Pic">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Cancel-->
						</div>
						<!--end::Image input-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group for upload Aadhar Front Page-->
				<!--end::Input group-->
			</div>
		<!--end::Form-->
	</div>


	
	<!--end::Content-->
</div>
<!--end::Basic info-->



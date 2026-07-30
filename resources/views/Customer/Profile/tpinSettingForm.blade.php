

<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bolder m-0">Update TPIN Setting</h3>
		</div>
		<!--end::Card title-->
	</div>
	<!--begin::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_profile_details" class="collapse show">
		<!--begin::Form-->
		<?php if(Auth::user()->role == 'admin') { $route = route('admin.profile-tpin-save',['user'=>Crypt::encryptString($userProfile->id)]); } ?>
		<?php if(Auth::user()->role == 'distributor') { $route = route('ds.profile-tpin-save',['user'=>Crypt::encryptString($userProfile->id)]); } ?>
		<?php if(Auth::user()->role == 'retailer') { $route = route('ro.profile-tpin-save',['user'=>Crypt::encryptString($userProfile->id)]); } ?>
    	<?php if(Auth::user()->role == 'superdistributor') { $route = route('sds.profile-tpin-save',['user'=>Crypt::encryptString($userProfile->id)]); } ?>
       
		<form id="kt_account_profile_details_form" class="form" method="post" action="{{$route}}" enctype="multipart/form-data">
			@csrf
			<!--begin::Card body-->
			<div class="card-body border-top p-9">
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Enter 6 Six Digitt PIN</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter Six digit numeric integer only"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
						<input type="number" name="tpin" class="form-control form-control-lg form-control-solid"  min="100000" max="" />
					</div>
					<!--end::Col-->
                    <!--begin::Col-->
					<div class="col-lg-4 fv-row">
						<input type="number" name="confirm_tpin" class="form-control form-control-lg form-control-solid"   />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--end::Input group-->
			</div>
			<!--end::Card body-->
			<!--begin::Actions-->
			<div class="card-footer d-flex justify-content-end py-6 px-9">
				<input type="hidden" name="role" value="admin">
				<button type="reset" class="btn btn btn-light-danger me-2">Discard</button>
				<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
			</div>
			<!--end::Actions-->
		</form>
		<!--end::Form-->
	</div>


	
	<!--end::Content-->
</div>
<!--end::Basic info-->



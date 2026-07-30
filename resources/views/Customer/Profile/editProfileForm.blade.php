
<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bolder m-0">Edit Profile Details</h3>
		</div>
		<!--end::Card title-->
	</div>
	<!--begin::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_profile_details" class="collapse show">
		<!--begin::Form-->
		<form id="kt_account_profile_details_form" class="form" method="post" action="{{route(getUserProfileRoutePrefix('profile_edit_save'),['user'=>Crypt::encryptString($userProfile->id)])}}" enctype='multipart/form-data'>
			@csrf
			<!--begin::Card body-->
			<div class="card-body border-top p-9">
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">Avatar</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<?php $imageUrl = asset('storage/avatars/'.$userProfile->picture); ?>
						<!--begin::Image input-->
						<?php if($userProfile->picture!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-125px h-125px" 
							<?php if($userProfile->picture!=''){ ?> style="background-image: url({{$imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							<!--end::Preview existing avatar-->
							<!--begin::Label-->
							<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
								<i class="bi bi-pencil-fill fs-7"></i>
								<!--begin::Inputs-->
								<input type="file" id="imageInput" name="avatar" accept=".png, .jpg, .jpeg">
								<input type="hidden" name="avatar_remove" />
								<!--end::Inputs-->
							</label>
							<!--end::Label-->
							<!--begin::Cancel-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Cancel-->
							<!--begin::Remove-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Remove-->
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
						<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
						<x-input-error :messages="$errors->get('avatar')" class="mt-2" /> 
						<!--end::Hint-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Row-->
						<div class="row">
							<!--begin::Col-->
							<div class="col-lg-6 fv-row">
								<input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="{{$userProfile->name}}" />
								<x-input-error :messages="$errors->get('name')" class="mt-2" /> 
								<input type="hidden" name="id"  value="{{$userProfile->id}}" />
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-lg-6 fv-row">
								<input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value="{{$userProfile->last_name}}" />
								<x-input-error :messages="$errors->get('last_name')" class="mt-2" /> 
							</div>
							<!--end::Col-->
						</div>
						<!--end::Row-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label required fw-bold fs-6">Email Address</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Eanter Valid" value="{{$userProfile->email}}" />
						<x-input-error :messages="$errors->get('email')" class="mt-2" /> 
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Mobile Number</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="tel" name="mobile" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{$userProfile->mobile}}" />
						<x-input-error :messages="$errors->get('mobile')" class="mt-2" /> 
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Address</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter Valid Address as per Aadhar Card"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Enter Address" value="{{$userProfile->address}}" />
						<x-input-error :messages="$errors->get('address')" class="mt-2" /> 
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">City</span>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="text" name="city" class="form-control form-control-lg form-control-solid" placeholder="Enter City Name" value="{{$userProfile->city_name}}" />
						<x-input-error :messages="$errors->get('address')" class="mt-2" /> 
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">State</span>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
					<select name="state" aria-label="Select a State" data-control="select2" data-placeholder="Select a State"  class="form-select form-select-solid fw-bolder">
					<option value="">Select a state...</option>
						{{!!getStateOptions($userProfile['state'])!!}}
					</select>
						<x-input-error :messages="$errors->get('address')" class="mt-2" /> 
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->

				

				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Zipcode</span>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="number" name="zipcode" class="form-control form-control-lg form-control-solid" placeholder="e.g 201009" value="{{$userProfile->zipcode}}" />
						<x-input-error :messages="$errors->get('zipcode')" class="mt-2" /> 
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Verified Mobile/Email</span>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
					<?php $selected1 = ($userProfile->is_mobile_verified == 1) ? 'selected' : ''; ?>
					<?php $selected2 = ($userProfile->is_mobile_verified == 0) ? 'selected' : ''; ?>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					@if($userProfile->is_mobile_verified==1)
					<select name="is_mobile_verified" data-hide-search="true" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder  bg-light-success  form-success">
					@else
					<select name="is_mobile_verified" data-hide-search="true" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder   bg-light-danger   form-success">
					@endif
						<option value="0" {{$selected2}}>Mobile Not Verified</option>
						<option value="1" {{$selected1}}>Mobile Verified</option>
					</select>
						<x-input-error :messages="$errors->get('is_mobile_verified')" class="mt-2" /> 
					</div>
					<div class="col-lg-4 fv-row">
					<?php $selected1 = ($userProfile->is_email_verified == 1) ? 'selected' : ''; ?>
					<?php $selected2 = ($userProfile->is_email_verified == 0) ? 'selected' : ''; ?>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					@if($userProfile->is_email_verified==1)
					<select name="is_email_verified" data-hide-search="true" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder  bg-light-success  form-success">
					@else
					<select name="is_email_verified" data-hide-search="true" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder   bg-light-danger   form-success">
					@endif
						<option value="0" {{$selected2}}>Email Not Verified</option>
						<option value="1" {{$selected1}}>Email Verified</option>
					</select>
						<x-input-error :messages="$errors->get('is_email_verified')" class="mt-2" /> 
					</div>
				</div>
				<!--end::Input group-->

				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">User Role</span>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
					<?php $selected1 = ($userProfile->role == 'user') ? 'selected' : ''; ?>
					<?php $selected2 = ($userProfile->role == 'retailer') ? 'selected' : ''; ?>
					<?php $selected3 = ($userProfile->role == 'distributor') ? 'selected' : ''; ?>
					<?php $selected4 = ($userProfile->role == 'superdistributor') ? 'selected' : ''; ?>
					<?php $selected5 = ($userProfile->role == 'sudadmin') ? 'selected' : ''; ?>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					<select name="role" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder form-success" onchange="getDistributorList(this)">
						<option value="user" {{$selected1}} class="text-danger">User</option>
						<option value="retailer" {{$selected2}}>Retailer</option>
						<option value="distributor" {{$selected3}}>Distributor</option>
						<option value="superdistributor" {{$selected4}}>Super Distributor</option>
						<option value="sudadmin" {{$selected5}}>SubAdmin</option>
					</select>
						<x-input-error :messages="$errors->get('address')" class="mt-2" /> 
					</div>
					<!--end::Col-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row" id="dsList" <?php if(($userProfile['parent_id'] > 0) && ($userProfile['role']== 'retailer')){ ?> style="display:block" <?php }else{ ?> style="display:none" <?php }?>>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					<select name="user_id" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder form-success"  >
						<?php foreach($dsList as $value){ ?>
						<option value="{{$value['id']}}"  class="text-danger" <?php if($userProfile['parent_id']==$value['id']){ echo "selected"; }?>>{{$value['name']}}-&nbsp;{{($value['agent_code'])?$value['agent_code']:generateAgentCode($value['id'])}}</option>
						<?php } ?>
					</select>
						<x-input-error :messages="$errors->get('user_id')" class="mt-2" /> 
					</div>
					<!--end::Col-->

					

					

				</div>
				<?php if($userProfile['role']== 'distributor') { ?> 
				<div class="row mb-6" id="superdistributor">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Distributor Has Super Distributor</span>
					</label>
					<div class="col-lg-4">
					<select name="is_superdistributor" data-hide-search="true" aria-label="Select Options" data-control="select2"  class="form-select form-select-solid fw-bolder  form-success" onchange="getSuperDistributorList(this.value)">
						<option value="no">NO</option>
						<option value="yes" <?php if($userProfile['parent_id'] > 0){ ?> selected="selected" <?php }?>>YES</option>
					</select>
					</div>
					
					<div class="col-lg-4" id="sdsList" <?php if(($userProfile['parent_id'] > 0) && ($userProfile['role']== 'distributor') ){ ?> style="display:block" <?php }else{ ?> style="display:none" <?php }?>>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					<select name="super_user_id" aria-label="Select SuperDistributor" data-control="select2"  class="form-select form-select-solid fw-bolder form-success"  >
						<?php foreach($sdsList as $value){ ?>
						<option value="{{$value['id']}}"  class="text-danger" <?php if($userProfile['parent_id']==$value['id']){ echo "selected"; }?>>{{$value['name']}}-&nbsp;{{($value['agent_code'])?$value['agent_code']:generateAgentCode($value['id'])}}</option>
						<?php } ?>
					</select>
					</div>
				</div>
				<?php }else{ ?>
					<div class="row mb-6" id="superdistributor" style="display:none">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Distributor Has Super Distributor</span>
					</label>
					<div class="col-lg-4">
					<select name="is_superdistributor" data-hide-search="true" aria-label="Select Options" data-control="select2"  class="form-select form-select-solid fw-bolder  form-success" onchange="getSuperDistributorList(this.value)">
						<option value="no">NO</option>
						<option value="yes" >YES</option>
					</select>
					</div>
					
					<div class="col-lg-4" id="sdsList" <?php if(($userProfile['parent_id'] > 0) && ($userProfile['role']== 'distributor') ){ ?> style="display:block" <?php }else{ ?> style="display:none" <?php }?>>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					<select name="super_user_id" aria-label="Select SuperDistributor" data-control="select2"  class="form-select form-select-solid fw-bolder form-success"  >
						<?php foreach($sdsList as $value){ ?>
						<option value="{{$value['id']}}"  class="text-danger" <?php if($userProfile['parent_id']==$value['id']){ echo "selected"; }?>>{{$value['name']}}-&nbsp;{{($value['agent_code'])?$value['agent_code']:generateAgentCode($value['id'])}}</option>
						<?php } ?>
					</select>
					</div>
				</div>
				<?php } ?>
				
				
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Status</span>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
					<?php $selected = ($userProfile->status == 'active') ? 'selected' : ''; ?>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					<select name="status" data-hide-search="true" aria-label="Select User Status" data-control="select2"  class="form-select form-select-solid fw-bolder @if($userProfile->status == 'active') bg-light-success @else bg-light-danger @endif  form-success" onchange="getInActiveReason(this.value)">
						<option value="inactive" {{$selected}} class="text-danger">In-Active</option>
						<option value="active" {{$selected}}>Active</option>
					</select>
						<x-input-error :messages="$errors->get('address')" class="mt-2" /> 
					</div>
					<!--end::Col-->
					<div class="col-lg-4 fv-row" id="in-active-status-list1" 
					<?php if($userProfile->status_reason_code > 0){ ?> style="display:block" 
					<?php }else{ ?>
						style="display:none"
					<?php }?>
					>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					{!!getInActiveStatusList($userProfile->status_reason_code)!!}
					<x-input-error :messages="$errors->get('status_reason_code')" class="mt-2" /> 
					
					</div>
				</div>
				
				
				<div class="row mb-6"  id="in-active-status-list"
					<?php if($userProfile->status_reason_code > 0){ ?> style="display:block" 
					<?php }else{ ?>
						style="display:none"
					<?php }?>
					
					>
					<!-- <div class="col-lg-4 fv-row fw-bold fs-6"> -->
					<!--begin::Label-->
						<!-- <span class="required">In Active Status Reason</span> -->
					<!-- </div> -->
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-12	 fv-row" >
					<input type="text" name="status_reason"  id="status_reason" class="form-control form-control-lg form-control-solid mt-5 border-danger bg-light-danger" placeholder="Please enter reason" value="{{$userProfile->status_reason}}" />
						<x-input-error :messages="$errors->get('status_reason')" class="mt-2" /> 
					</div>
					<!--end::Col-->
				</div>
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
<!--end::Basic info-->
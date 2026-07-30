<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bolder m-0">KYC Details</h3>
		</div>
		<!--end::Card title-->
	</div>
	<!--begin::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_profile_details" class="collapse show">
		<!--begin::Form-->
		<?php $imageUrl = asset('storage/avatars/'.$userProfile->picture); ?>
		
			<!--begin::Card body-->
			<div class="card-body border-top p-9">
				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">Photograph</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Image input-->
						<?php //dd($userProfile->picture);?>
						<?php $imageUrl = asset('storage/avatars/'.$userProfile->picture); ?>
						<?php if($userProfile->picture!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-125px h-125px" 
							<?php if($userProfile->picture!=''){ ?> style="background-image: url({{$imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							<!--end::Preview existing avatar-->
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
						<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
						<x-input-error :messages="$errors->get('photograph')" class="mt-2" /> 
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
								<input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="{{$userProfile->name}}" readonly="readonly" />
								<x-input-error :messages="$errors->get('name')" class="mt-2" /> 
								<input type="hidden" name="id"  value="{{$userProfile->id}}" />
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-lg-6 fv-row">
								<input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value="{{$userProfile->last_name}}"  readonly="readonly"/>
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
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Aadhar Number</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="12 Digit Valid Aadhar Number"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input inputmode="text" id="kt_inputmask_2" name="aadhar_card_number" class="form-control form-control-lg form-control-solid" placeholder="____-____-____" value="{{$userProfile->aadhar_card_number}}"  readonly="readonly"/>
						<x-input-error :messages="$errors->get('aadhar_card_number')" class="mt-2" />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->


				<!--begin::Input group For Upload AAdhar Front Page-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">Aadhar Front Photograph</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Image input-->
						<?php $aadhar_front_pic_imageUrl = asset('storage/ekyc/'.$userProfile->aadhar_front_pic); ?>
						<?php if($userProfile->picture!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-425px h-225px" 
							<?php if($userProfile->aadhar_front_pic!=''){ ?> style="background-image: url({{$aadhar_front_pic_imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							
							
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
						<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
						<x-input-error :messages="$errors->get('aadhar_front_pic')" class="mt-2" />
						<!--end::Hint-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group for upload Aadhar Front Page-->


	
				




				<!--begin::Input group For Upload AAdhar Front Page-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">Aadhar Back Photograph</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Image input-->
						<?php $aadhar_back_pic_imageUrl = asset('storage/ekyc/'.$userProfile->aadhar_back_pic); ?>
						<?php if($userProfile->aadhar_back_pic!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-425px h-225px" 
							<?php if($userProfile->aadhar_back_pic!=''){ ?> style="background-image: url({{$aadhar_back_pic_imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							<!--begin::Label-->
							
							
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
						<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
						<x-input-error :messages="$errors->get('aadhar_back_pic')" class="mt-2" />
						<!--end::Hint-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group for upload Aadhar Front Page-->



				<!--begin::Input group-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">PAN CARD Number</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="PAN Card Number"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="text" name="pan_card_number" class="form-control form-control-lg form-control-solid" placeholder="e.g BBBBB5555A" value="{{$userProfile->pan_card_number}}" readonly="readonly" />
						<x-input-error :messages="$errors->get('pan_card_number')" class="mt-2" />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->

				<!--begin::Input group For Upload AAdhar Front Page-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">PAN Card</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Image input-->
						<?php $pan_card_pic_imageUrl = asset('storage/ekyc/'.$userProfile->pan_card_pic); ?>
						<?php if($userProfile->pan_card_pic!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-425px h-225px" 
							<?php if($userProfile->pan_card_pic!=''){ ?> style="background-image: url({{$pan_card_pic_imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
						<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
						<x-input-error :messages="$errors->get('pan_card_pic')" class="mt-2" />
						<!--end::Hint-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group for upload Aadhar Front Page-->

				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Verified Mobile</span>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
					<?php $selected1 = ($userProfile->is_mobile_verified == true) ? 'selected' : ''; ?>
					<?php $selected2 = ($userProfile->is_mobile_verified == false) ? 'selected' : ''; ?>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					@if($userProfile->is_mobile_verified==1)
					<select name="is_mobile_verified" data-hide-search="true" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder  bg-light-success border-success form-success" disabled="disabled">
					@else
					<select name="is_mobile_verified" data-hide-search="true" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder   bg-light-danger border-danger  form-success" disabled="disabled">
					@endif
						<option value="false" {{$selected2}}>Not Verified</option>
						<option value="true" {{$selected1}}>Verified</option>
					</select>
						<x-input-error :messages="$errors->get('is_mobile_verified')" class="mt-2" /> 
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
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					<select name="role" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder form-success"  disabled="disabled">
						<option value="user" {{$selected1}} class="text-danger">User</option>
						<option value="retailer" {{$selected2}}>Retailer</option>
						<option value="distributor" {{$selected3}}>Distributor</option>
					</select>
						<x-input-error :messages="$errors->get('address')" class="mt-2" /> 
					</div>
					<!--end::Col-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row" id="dsList" <?php if($userProfile['parent_id'] > 0 && $userProfile['role']=='retailer'){ ?> style="display:block" <?php }else{ ?> style="display:none" <?php }?>>
					<!-- data-bs-target="#kt_modal_upgrade_plan" data-bs-toggle="modal" -->
					<select name="user_id" aria-label="Select User Role" data-control="select2"  class="form-select form-select-solid fw-bolder form-success" disabled="disabled"  >
						<option value="0">Choose Distributor</option>
						<?php foreach($dsList as $value){ ?>
						<option value="{{$value['id']}}"  class="text-danger" <?php if($userProfile['parent_id']==$value['id']){ echo "selected"; }?>>{{$value['name']}}-&nbsp;{{($value['agent_code'])?$value['agent_code']:generateAgentCode($value['id'])}}</option>
						<?php } ?>
					</select>
						<x-input-error :messages="$errors->get('user_id')" class="mt-2" /> 
					</div>
					<!--end::Col-->
				</div>
			<!--begin::Actions-->
			</div>
			
		<!--end::Form-->
	</div>
	<!--end::Content-->
</div>
<!--end::Basic info-->



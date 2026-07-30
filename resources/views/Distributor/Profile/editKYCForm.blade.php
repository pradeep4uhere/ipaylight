<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bolder m-0">Update KYC Details</h3>
		</div>
		<!--end::Card title-->
	</div>
	<!--begin::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_profile_details" class="collapse show">
		<!--begin::Form-->
		<?php $imageUrl = asset('storage/avatars/'.$userProfile->picture); ?>
		<form id="kt_account_profile_details_form" class="form" action="{{route('ds.kyc-update-save')}}" enctype='multipart/form-data' method="post">
			@csrf
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
						<?php $imageUrl = asset('storage/avatars/'.$userProfile->photograph); ?>
						<?php if($userProfile->picture!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-125px h-125px" 
							<?php if($userProfile->photograph!=''){ ?> style="background-image: url({{$imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							<!--end::Preview existing avatar-->
							<!--begin::Label-->
							<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Photograph">
								<i class="bi bi-pencil-fill fs-7"></i>
								<!--begin::Inputs-->
								<input type="file" name="photograph" accept=".png, .jpg, .jpeg" />
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
					<label class="col-lg-4 col-form-label fw-bold fs-6">
						<span class="required">Aadhar Number</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="12 Digit Valid Aadhar Number"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input inputmode="text" id="kt_inputmask_2" name="aadhar_card_number" class="form-control form-control-lg form-control-solid" placeholder="____-____-____" value="{{$userProfile->aadhar_card_number}}" />
						<x-input-error :messages="$errors->get('aadhar_card_number')" class="mt-2" />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->


				<!--begin::Input group For Upload AAdhar Front Page-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">Upload Aadhar Front Photograph</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Image input-->
						<?php $aadhar_front_pic_imageUrl = asset('storage/ekyc/'.$userProfile->aadhar_front_pic); ?>
						<?php if($userProfile->picture!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-125px h-125px" 
							<?php if($userProfile->aadhar_front_pic!=''){ ?> style="background-image: url({{$aadhar_front_pic_imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							<!--begin::Label-->
							<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
								<i class="bi bi-pencil-fill fs-7"></i>
								<!--begin::Inputs-->
								<input type="file" name="aadhar_front_pic" accept=".png, .jpg, .jpeg" />
								<input type="hidden" name="aadhar_front_pic_remove" />
								<!--end::Inputs-->
							</label>
							<!--end::Label-->
							<!--begin::Cancel-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Aadhar Front Pic">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Cancel-->
							<!--begin::Remove-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove Aadhar Front Pic">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Remove-->
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
					<label class="col-lg-4 col-form-label fw-bold fs-6">Upload Aadhar Back Photograph</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Image input-->
						<?php $aadhar_back_pic_imageUrl = asset('storage/ekyc/'.$userProfile->aadhar_back_pic); ?>
						<?php if($userProfile->aadhar_back_pic!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-125px h-125px" 
							<?php if($userProfile->aadhar_back_pic!=''){ ?> style="background-image: url({{$aadhar_back_pic_imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							<!--begin::Label-->
							<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
								<i class="bi bi-pencil-fill fs-7"></i>
								<!--begin::Inputs-->
								<input type="file" name="aadhar_back_pic" accept=".png, .jpg, .jpeg" />
								<input type="hidden" name="avatar_back_pic_remove" />
								<!--end::Inputs-->
							</label>
							<!--end::Label-->
							<!--begin::Cancel-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Aadhar Front Pic">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Cancel-->
							<!--begin::Remove-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove Avatar Front Pic">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Remove-->
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
						<input type="text" name="pan_card_number" class="form-control form-control-lg form-control-solid" placeholder="e.g BBBBB5555A" value="{{$userProfile->pan_card_number}}" />
						<x-input-error :messages="$errors->get('pan_card_number')" class="mt-2" />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->

				<!--begin::Input group For Upload AAdhar Front Page-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">Upload PAN Card</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Image input-->
						<?php $pan_card_pic_imageUrl = asset('storage/ekyc/'.$userProfile->pan_card_pic); ?>
						<?php if($userProfile->pan_card_pic!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-125px h-125px" 
							<?php if($userProfile->pan_card_pic!=''){ ?> style="background-image: url({{$pan_card_pic_imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							<!--begin::Label-->
							<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change pan card pic">
								<i class="bi bi-pencil-fill fs-7"></i>
								<!--begin::Inputs-->
								<input type="file" name="pan_card_pic" accept=".png, .jpg, .jpeg" />
								<input type="hidden" name="pan_card_pic_remove" />
								<!--end::Inputs-->
							</label>
							<!--end::Label-->
							<!--begin::Cancel-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel pan card pic">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Cancel-->
							<!--begin::Remove-->
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove pan card pic">
								<i class="bi bi-x fs-2"></i>
							</span>
							<!--end::Remove-->
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
						<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
						<x-input-error :messages="$errors->get('pan_card_pic')" class="mt-2" />
						<!--end::Hint-->
					</div>
					<!--end::Col-->
				</div>
				
			
		
			</div>
			<!--end::Card body-->
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



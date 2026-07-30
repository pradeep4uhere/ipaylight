<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
		<!--begin::Card title-->
		<div class="card-title m-0">
			<h3 class="fw-bolder m-0">KYC Details <span class="badge badge-light-success fw-bolder fs-7 px-2 py-1 ms-2">Your KYC Verified</span></h3>
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
						<span class="required">Full Name</span>
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="As Per Your Pan Card"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-4 fv-row">
						<input type="tel" name="name" class="form-control form-control-lg form-control-solid" placeholder="First Name" value="{{getAuthValue('name')}}" readonly="readonly" disabled="disabled" />
					</div>
					<div class="col-lg-4 fv-row">
						<input type="tel" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last Name" value="{{getAuthValue('last_name')}}" disabled="disabled" />
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
						<input inputmode="text" id="kt_inputmask_2" name="aadhar_card_number" class="form-control form-control-lg form-control-solid" placeholder="____-____-____" value="{{$userProfile->aadhar_card_number}}" disabled="disabled" />
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
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/files/blank-image.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-425px h-225px" 
							<?php if($userProfile->aadhar_front_pic!=''){ ?> style="background-image: url({{$aadhar_front_pic_imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
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
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/files/blank-image.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-425px h-225px" 
							<?php if($userProfile->aadhar_back_pic!=''){ ?> style="background-image: url({{$aadhar_back_pic_imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							<!--begin::Label-->
							
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
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
						<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
					</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 fv-row">
						<input type="text" name="pan_card_number" class="form-control form-control-lg form-control-solid" placeholder="Enter Pan Card Number" value="{{getAuthValue('pan_card_number')}}" disabled="disabled" />
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->

				
				<!--begin::Input group For Upload PAN Card Start-->
				<div class="row mb-6">
					<!--begin::Label-->
					<label class="col-lg-4 col-form-label fw-bold fs-6">Upload PAN Card</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<!--begin::Image input-->
						<?php $pan_card_pic_imageUrl = asset('storage/ekyc/'.$userProfile->pan_card_pic); ?>
						<?php if($userProfile->pan_card_pic!=''){ $image_input_changed = 'image-input-changed';  } else{ $image_input_changed = 'image-input-empty';} ?>
						<div class="image-input image-input-outline  {{$image_input_changed}}" data-kt-image-input="true" style="background-image: url('assets/media/svg/files/blank-image.svg')">
							<!--begin::Preview existing avatar-->
							<div class="image-input-wrapper w-425px h-225px" 
							<?php if($userProfile->pan_card_pic!=''){ ?> style="background-image: url({{$pan_card_pic_imageUrl}})" <?php } else { ?> style="background-image: none" <?php } ?>
							id="preview"></div>
							
						</div>
						<!--end::Image input-->
						<!--begin::Hint-->
						
					</div>
					<!--end::Col-->
				</div>
				<!--begin::Input group For Upload PAN Card Ends-->
				
				<!--end::Input group-->
			</div>
			<!--end::Card body-->
	</div>
	<!--end::Content-->
</div>
<!--end::Basic info-->



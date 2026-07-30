<div class="card card-mute mt-10">
	<!--begin::Card header-->
	<div class="card-header align-items-center py-5 gap-2 gap-md-5">
		<!--begin::Card title-->
		
			<h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">
					Account List
				</span>
			</h3>
			<div class="card-toolbar">
				<a href="{{route('dmt.addnewbeneficiary',['cid'=>encryptString($data['cid'])])}}" class="btn btn-sm btn-danger">
					Add New Benificiery
				</a>
			</div>
	</div>
	<!--end::Card header-->
	<!--begin::Card body-->
	<div class="card-body pt-5">
		@include('utils.errorMessage',['message'=>'No Account List Found'])
	</div>
	<!--end::Card body-->
</div>
<!--end::Products-->
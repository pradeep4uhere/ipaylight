<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
<!--begin::Col-->
<div class="col-xxl-12">
	<!--begin::Row-->
	<div class="row g-5 g-xl-12">
		<!--begin::Col-->
		<div class="col-md-3">
			<!--begin::Card widget 11-->
			<div class="card card-flush h-xl-100" style="background-color: #e8fff3">
				<!--begin::Header-->
				<div class="card-header flex-nowrap pt-5">
					<!--begin::Title-->
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bolder fs-4 text-gray-800">Total Credit Amount</span>
					</h3>
					<!--end::Title-->
					
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body text-center pt-5">
					<!--begin::Image-->
					
					<img src="assets/media/svg/payment.svg" class="" alt="">
					
					<!--end::Image-->
					<!--begin::Section-->
					<div class="text-start">
						<span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>₹ {{$userProfile->dashboardItem->totalWalletCredit}}</span>
						
					</div>
					<!--end::Section-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Card widget 11-->
		</div>
		<!--end::Col-->
		<!--begin::Col-->
		<div class="col-md-3">
			<!--begin::Card widget 11-->
			<div class="card card-flush h-xl-100" style="background-color: #F6E5CA">
				<!--begin::Header-->
				<div class="card-header flex-nowrap pt-5">
					<!--begin::Title-->
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bolder fs-4 text-gray-800">Total Debit Amount</span>
					</h3>
					<!--end::Title-->
					
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body text-center pt-5">
					<!--begin::Image-->
					<img src="assets/media/svg/debit.svg" class="" alt="" height="">
					<!--end::Image-->
					<!--begin::Section-->
					<div class="text-start">
					<span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>₹ {{$userProfile->dashboardItem->totalWalletDebit}}</span>
						
					</div>
					<!--end::Section-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Card widget 11-->
		</div>
		<!--end::Col-->
		<!--begin::Col-->
		<div class="col-md-3">
			<!--begin::Card widget 11-->
			<div class="card card-flush h-xl-100" style="background-color: #F3D6EF">
				<!--begin::Header-->
				<div class="card-header flex-nowrap pt-5">
					<!--begin::Title-->
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bolder fs-4 text-gray-800">Total Pending Amount</span>
					</h3>
					<!--end::Title-->
					
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body text-center pt-5">
					<!--begin::Image-->
					<img src="assets/media/svg/failed.svg" class="" alt="">
					<!--end::Image-->
					<!--begin::Section-->
					<div class="text-start">
					<span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>₹ {{$userProfile->dashboardItem->totalWalletPending}}</span>
					</div>
					<!--end::Section-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Card widget 11-->
		</div>
		<!--end::Col-->
		<!--begin::Col-->
		<div class="col-md-3">
			<!--begin::Card widget 11-->
			<div class="card card-flush h-xl-100" style="background-color: #e4e6ef">
				<!--begin::Header-->
				<div class="card-header flex-nowrap pt-5">
					<!--begin::Title-->
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bolder fs-4 text-gray-800">Total Reversal Amount</span>
					</h3>
					<!--end::Title-->
					
					<!--end::Toolbar-->
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body text-center pt-5">
					<!--begin::Image-->
					<img src="assets/media/svg/reverse.svg" class="" alt="">
					<!--end::Image-->
					<!--begin::Section-->
					<div class="text-start">
					<span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>₹ {{$userProfile->dashboardItem->totalWalletReversal}}</span>
					</div>
					<!--end::Section-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Card widget 11-->
		</div>
		<!--end::Col-->
		
	</div>
	<!--end::Row-->
</div>
<!--end::Col-->


<!--end::Col-->
</div>
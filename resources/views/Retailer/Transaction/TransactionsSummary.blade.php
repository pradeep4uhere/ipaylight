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
						<span class="card-label fw-bolder fs-4 text-gray-800">{{getLocalText('total_payment_recived')}}</span>
					</h3>
					<!--end::Title-->
					
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body text-center pt-5">
					<!--begin::Image-->
					
					<img src="assets/media/svg/payment_recv.svg" class="" alt="">
					
					<!--end::Image-->
					<!--begin::Section-->
					<div class="text-start">
						<span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>₹ {{number_format($transactionsummary['TotalAmount'],2)}}</span>
						
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
						<span class="card-label fw-bolder fs-4 text-gray-800">{{getLocalText('today_payment')}}</span>
					</h3>
					<!--end::Title-->
					
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body text-center pt-5">
					<!--begin::Image-->
					<img src="assets/media/svg/today.svg" class="" alt="" height="">
					<!--end::Image-->
					<!--begin::Section-->
					<div class="text-start">
					<span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>₹ Rs. {{number_format($transactionsummary['TotalTodayAmount'],2)}}</span>
						
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
			<div class="card card-flush h-xl-100" style="background-color: #faf6c8">
				<!--begin::Header-->
				<div class="card-header flex-nowrap pt-5">
					<!--begin::Title-->
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bolder fs-4 text-gray-800">{{getLocalText('pending_payment')}}</span>
					</h3>
					<!--end::Title-->
					
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body text-center pt-5">
					<!--begin::Image-->
					<img src="assets/media/svg/pending.svg" class="" alt="">
					<!--end::Image-->
					<!--begin::Section-->
					<div class="text-start">
					<span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>₹ {{number_format($transactionsummary['TotalFailedAmount'],2)}}</span>
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
						<span class="card-label fw-bolder fs-4 text-gray-800">{{getLocalText('failed_payment')}}</span>
					</h3>
					<!--end::Title-->
					
					<!--end::Toolbar-->
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body text-center pt-5">
					<!--begin::Image-->
					<img src="assets/media/svg/failed.svg" class="" alt="">
					<!--end::Image-->
					<!--begin::Section-->
					<div class="text-start">
					<span class="d-block fw-bolder fs-2 text-gray-800 mb-2"><i class="bi bi-graph-up fs-2x me-5"></i>₹ {{number_format($transactionsummary['TotalFailedAmount'],2)}}</span>
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
		
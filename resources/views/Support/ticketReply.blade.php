<style>
	p.fw-normal.fs-5.text-gray-700.m-0.ps-20 {
    font-family: system-ui;
}
</style>
<div class="overflow-hidden position-relative card-rounded">
<!--begin::Ribbon-->
<?php if($replyItem->user->id == getAuthValue('id')){ 
	$class= "border-warning";
	$textprimary = "primary";
}elseif($replyItem->user->role == 'distributor'){ 
	$class= "border-info";
	$textprimary = "info";
}else{
	$class= "border-success";
	$textprimary = "success";
}
?>
<div class="ribbon ribbon-triangle ribbon-top-start {{$class}}">
	<!--begin::Ribbon icon-->
	<div class="ribbon-icon mt-n5 ms-n6">
		<i class="bi bi-check2 fs-2 text-white"></i>
	</div>
	<!--end::Ribbon icon-->
</div>

<!--end::Ribbon-->
<!--begin::Card-->
<div class="card card-bordered w-100 mb-5">
	<!--begin::Body-->
	<div class="card-body m-0">
		<!--begin::Wrapper-->
		<div class="w-100 d-flex flex-stack mb-5">
			<!--begin::Container-->
			<div class="d-flex align-items-center f">
				<!--begin::Author-->
				<div class="symbol symbol-50px me-5">
					<div class="symbol-label fs-3 fw-bolder bg-light-{{$textprimary}} text-{{$textprimary}}">{{getFirstChar($replyItem->user->name)}}</div>
				</div>
				<!--end::Author-->
				<!--begin::Info-->
				<div class="d-flex flex-column fw-bold fs-5 text-gray-600 text-dark">
					<!--begin::Text-->
					<div class="d-flex align-items-center">
						<!--begin::Username-->
						<a href="javascript:void(0)" class="text-gray-800 fw-bolder text-hover-primary fs-5 me-3">{{$replyItem->user->name}}</a>
						<!--end::Username-->
						<span class="m-0"></span>
					</div>
					<!--end::Text-->
					<!--begin::Date-->
					<span class="text-muted fw-bold fs-7">{{getFormatDate($replyItem->created_at)}}</span>
					<!--end::Date-->
				</div>
				<!--end::Info-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Wrapper-->
		<!--begin::Desc-->
		<p class="fw-normal fs-5 text-gray-700 m-0 ps-20">{!!$replyItem->message!!}</p>
		<!--end::Desc-->
		<div class="mt-2 ps-20 float-end">
		<a href="#" class="text-gray-800 text-hover-primary d-flex flex-column">
			<!--begin::Image-->
			<div class="symbol symbol-20px mb-5">
			@if($replyItem->document_file!='')
			@if(strtolower(pathinfo($replyItem->document_file, PATHINFO_EXTENSION))=='pdf')
				<img src="assets/media/svg/files/pdf.svg" alt="">&nbsp;Attachment 
			@elseif(strtolower(pathinfo($replyItem->document_file, PATHINFO_EXTENSION))=='doc')
				<img src="assets/media/svg/files/doc.svg" alt="">&nbsp;Attachment 
			@elseif(strtolower(pathinfo($replyItem->document_file, PATHINFO_EXTENSION))=='docx')
				<img src="assets/media/svg/files/doc.svg" alt="">&nbsp;Attachment 
			@else
				<img src="assets/media/svg/images.png" alt="">&nbsp;Attachment 
			@endif
			@endif
			</div>
		</a>
		</div>
	</div>
	<!--end::Body-->
</div>
<!--end::Card-->
</div>
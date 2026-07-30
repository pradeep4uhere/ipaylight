<?php $annoucementList =  getAnnouncement();?>
@if($annoucementList->count())
<div class="row">
<div class="col-xl-12">
    <div class="card card-flush  flex-row-fluid overflow-hidden mb-10   bg-light-warning">
        <!--begin::Background-->
        <div class="position-absolute top-0 end-0 opacity-9 pe-none text-start">
            <img src="assets/media/svg/announcement.svg" class="w-175px">
        </div>
        <!--end::Background-->
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title  pe-50">
                <h2><i class="fa fa-bullhorn" aria-hidden="true" style="font-size:18px"></i> Announcement Message</h2>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 ">
            <div class="d-flex flex-column text-start text-danger fw-bold">
             @include('elements.annoucementItem')   
            </div>
        </div>
    </div>
</div>
</div>
@endif

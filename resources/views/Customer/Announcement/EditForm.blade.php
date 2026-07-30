<!--begin:Form-->
<div class="card h-md-1">
<!--begin::Body-->
<div class="card-body d-flexr">
<form  action="{{route('update.announcment',['id'=>encryptString($announcement['id'])])}}" method="post" enctype="multipart/form-data">
            @csrf
            <!--begin::Heading-->
            <div class="mb-13 text-center">
                <!--begin::Title-->
                <h1 class="mb-3">Create Announcement</h1>
                <!--end::Title-->
                <!--begin::Description-->
                <div class="text-gray-400 fw-bold fs-5">Broadcast Message to All Users
                <a href="" class="fw-bolder link-primary">Support Guidelines</a>.</div>
                <!--end::Description-->
            </div>
            <!--end::Heading-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Announcement Title</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify Title For Announcement"></i>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" placeholder="Enter Title For Announcement" name="title" value="{{$announcement['title']}}" />
            </div>
            <!--end::Input group-->
           <!--begin::Input group-->
           <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <label class="required fs-6 fw-bold mb-2">Start Date</label>
                    <input type="date" name="start_date" class="form-control form-control-solid ps-1" value="{{date("Y-m-d",strtotime($announcement['start_date']))}}"/>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <label class="required fs-6 fw-bold mb-2">End Date</label>
                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center">
                        
                        <!--begin::Datepicker-->
                        
                        <input type="date" class="form-control form-control-solid ps-1" placeholder="Select a date" name="end_date" value="{{date("Y-m-d",strtotime($announcement['end_date']))}}" />
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
            </div>
           
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <label class="fs-6 fw-bold mb-2">Description</label>
                <textarea class="form-control form-control-solid" rows="4" name="content"  placeholder="Type details announcement content">{{$announcement['content']}}</textarea>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-8">
                <label class="fs-6 fw-bold mb-2">Attachments</label>
                <input type="file" name="document_file" class="form-control"/>
                <a href="{{ asset('storage/document/' . $announcement['document_file']) }}">
                    <span class="text-mute text-priamry">Uplaoded Document</span>
                </a>
            </div>
            <!--end::Input group-->
             <!--begin::Input group-->
             <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <label class="required fs-6 fw-bold mb-2">Status</label>
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Open" data-hide-search="true" name="is_active">
                        <option value=""></option>
                        <option value="1" selected="selected">Active</option>
                        <option value="0">Closed</option>
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="text-center">
                <button type="reset" id="kt_modal_new_ticket_cancel" class="btn btn-light me-3">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Submit</span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end:Form-->
        </div>
        </div>
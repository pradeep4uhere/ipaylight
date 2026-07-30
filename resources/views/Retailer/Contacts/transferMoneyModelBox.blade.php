<div class="modal fade" id="kt_modal_transfer_money" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered mw-600px">
<div class="modal-content">
    <div class="card-header modal-header justify-content-end ribbon ribbon-start ribbon-clip">
        <div class="ribbon-label fw-bolder">
            <span class="fw-bolder fs-3 ps-3">Transfer Money</span>
            <span class="ribbon-inner bg-danger"></span>
        </div>
        <!--begin::Close-->
        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
            <span class="svg-icon svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Close-->
    </div>
    <!--begin::Stepper-->
    <div class="modal-body py-lg-5 px-lg-5" id="model-body-content">
        <div class="text-center">
            <?php $imagePath = asset("assets/media/loading-gear-3.gif");?>
            <img src="{{$imagePath}}" alt="Loader" width="50px" height="50px"/>
            <div class="fs-6 fw-bold mt-5">Please wait...</div>
            <div class="fs-7 text-mute">Do not refresh this page</div>
            <div class="fs-8 text-mute mb-20">Your ip Address is: {{$_SERVER['REMOTE_ADDR']}}</div>
        </div>
    </div>
    </div>
    </div>
</div>


<div class="card bg-light-primary">
    <!--begin::Card body-->
    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
        <!--begin::Avatar-->
        <div class="symbol symbol-65px symbol-circle mb-5">
            <span class="symbol-label fs-2x fw-bold text-warning bg-light-warning">{{substr($user->name, 0, 1)}}</span>
            <div class="bg-success position-absolute border border-4 border-white h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
        </div>
        <!--end::Avatar-->
        <!--begin::Name-->
        <a href="#" class="fs-4 text-800 text-hover-primary fw-bolder mb-0">{{$user->name}}&nbsp;{{$user->last_name}}</a>
        <!--end::Name-->
        <!--begin::Position-->
        <div class="fw-bolder text-400 mb-2">Agent Code:&nbsp;{{generateAgentCode($user->id)}}</div>
        <div class="fw-bolder text-400 mb-2">Email:&nbsp;XXXXXXXXXXXXXXXXX</div>
        <div class="fw-bolder text-400 mb-6">Mobile:&nbsp;+91-{{$user->mobile}}</div>
        <!--end::Position-->
    </div>
    <!--end::Card body-->
</div>
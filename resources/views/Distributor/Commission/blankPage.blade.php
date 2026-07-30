@extends('Distributor.layouts.Distributor.dashboard')
@section('content')
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
    <div class="row gy-5 g-xl-10">
    <div class="col-xl-12 mb-5 mb-xl-12">
        <!--begin::Engage widget 1-->
        <div class="card h-md-100">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column flex-center">
                <!--begin::Heading-->
                <div class="mb-2">
                    <!--begin::Title-->
                    <h1 class="fw-bold text-gray-800 text-center lh-lg">{{$pageTitle}}
                    
                    <!--end::Title-->
                    <!--begin::Illustration-->
                    <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-300px mh-280px my-5 my-lg-12" style="background-image:url('assets/media/svg/no_data.svg')"></div>
                    <!--end::Illustration-->
                    <?php if($userProfile->role == 'retailer'){ ?>
                        <a href="{{route('ds.retailer_addcommission',['user'=>Crypt::encryptString($userProfile['id'])])}}" class="btn btn-primary  my-1 fs-5">
                    <?php }else{ ?>
                        <a href="{{route('admin.profile_addcommission',['user'=>Crypt::encryptString($userProfile['id'])])}}" class="btn btn-primary  my-1 fs-5">
                    <?php } ?>
                    Add Gateway Commission</a>
                </div>
                <!--end::Heading-->
                <!--begin::Links-->
                <!--end::Links-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Engage widget 1-->
    </div>
    <!--end::Col-->
</div>
</div>
</div>
@endsection
                        
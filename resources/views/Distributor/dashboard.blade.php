@extends('Distributor.layouts.Distributor.dashboard')
@section('content')
<!--start::Row-->
@include('Distributor.DashboardElements.TopSummary')
@if(!empty($dashboardItem['lastPayment']) && !empty($dashboardItem['lastWalletTransactions']))
@include('Distributor.DashboardElements.LastTransactionAndCommission')
@endif
<!--begin::Wrapper-->
    <!--Dashboard start::Row-->
    <div class="row g-5 g-xl-10">
        <div class="col-xl-4 mb-xl-10">
        @include('Distributor.DashboardElements.introBox')
        </div>
        <!--begin::Col-->
<div class="col-xl-8 mb-5 mb-xl-10">
<!--begin::Row-->
<div class="row g-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-6 mb-xl-10">
        @include('Distributor.DashboardElements.paymentLoadSlider')
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6 mb-5 mb-xl-10">
    @include('Distributor.DashboardElements.paymentWidthrowSlider')
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->

@include('Distributor.DashboardElements.contactBanner')									
</div>
</div>

<!--end::Row-->
<!--Dashboard end::Row-->

<!--begin::Row-->
<div class="row g-5 g-xl-10 mb-xl-10">
    <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
        @include('Distributor.DashboardElements.transactionChart')									
    </div>
    

    <!--begin::Col-->
    <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
    @include('Distributor.DashboardElements.paymentWidthrowChart')
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
							
								
<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12 mb-5 mb-xl-10">
        @include('Distributor.DashboardElements.latestTransactionList')
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12 mb-5 mb-xl-10">
        @include('Distributor.DashboardElements.latestWalletTransactionList')
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->

<!--end::Row-->
@include('Distributor.DashboardElements.supportTicketList')					
<!--end::Wrapper-->
@endsection
                        
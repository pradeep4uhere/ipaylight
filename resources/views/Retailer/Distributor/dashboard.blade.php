@extends('Distributor.layouts.Retailer.default')
@section('content')
@include('elements.announcement')

@if(!empty($dashboardItem['lastPayment']))
    @include('Retailer.Distributor.DashboardElements.TopSummary')
@endif

@if(!empty($dashboardItem['lastPayment']))							
    @include('Retailer.Distributor.DashboardElements.LastTransactionAndCommission')
@endif

<div class="row g-5 g-xl-10">
<div class="col-xl-12 mb-xl-10 mb-5">
{!! renderDashboardNotifications($dashboardItem['userPermissionArr']) !!}
</div>
</div>



<div class="row g-5 g-xl-10">
<div class="col-xl-4 mb-xl-10">
@include('Retailer.Distributor.DashboardElements.introBox')
</div>
<div class="col-xl-8 mb-5 mb-xl-10">
<!--begin::Row-->
<div class="row g-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-6 mb-xl-10">
        @include('Retailer.DashboardElements.paymentLoadSlider')
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-6 mb-5 mb-xl-10">
    @include('Retailer.DashboardElements.paymentWidthrowSlider')
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->


@include('Retailer.DashboardElements.contactBanner')									
</div>
<!--end::Col-->

<!--begin::Col-->
</div>

<!--end::Row-->

<!--begin::Row-->
<div class="row g-5 g-xl-10 mb-xl-10">
    <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
        @include('Retailer.DashboardElements.transactionChart')									
    </div>
    

    <!--begin::Col-->
    <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
    @include('Retailer.DashboardElements.paymentWidthrowChart')
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
			
<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12 mb-5 mb-xl-10">
        @include('Retailer.Distributor.DashboardElements.latestTransactionList')
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12 mb-5 mb-xl-10">
        @include('Retailer.Distributor.DashboardElements.latestWalletTransactionList')
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->


<!--begin::Row-->
<div class="row gy-5 g-xl-8">
    <!--begin::Col-->
    <div class="col-xl-4">
    @include('Retailer.DashboardElements.quickPaymentLink')
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-4">
    @include('Retailer.DashboardElements.activitiesList')
    </div>
    <!--end::Col-->
    
    <div class="col-xl-4">
        @include('Retailer.Distributor.DashboardElements.contactsList')
    </div>
</div>
<!--end::Row-->
@include('Retailer.DashboardElements.supportTicketList')			

@endsection
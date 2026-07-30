<!--begin::Col-->
<!--begin::Chart widget 3-->
<div class="card card-flush overflow-hidden h-md-100">
    
    <!--begin::Header-->
    <div class="card-header py-5">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder text-dark">{{getLocalText('transaction_this_months')}}</span>
            <span class="text-gray-400 mt-1 fw-bold fs-6">{{getLocalText('transction_from_all_gateway')}}</span>
        </h3>
        <!--end::Title-->
        
    </div>
    <!--end::Header-->
    <!--begin::Card body-->
    <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
        <!--begin::Statistics-->
        <div class="px-9 mb-5">
            <!--begin::Statistics-->
            <div class="d-flex mb-2">
                <span class="fs-4 fw-bold text-gray-400 me-1">Rs.</span>
                <span class="fs-2hx fw-bolder text-gray-800 me-2 lh-1 ls-n2">{{number_format($dashboardItem['TotalRecivedAmount'],2)}}</span>
            </div>
            <!--end::Statistics-->
            <!--begin::Description-->
            <span class="fs-8 fw-bold text-gray-400">Total {{$dashboardItem['totalCount']}} Number Of Transactions</span>
            <!--end::Description-->
        </div>
        <!--end::Statistics-->
        <!--begin::Chart-->
        <div id="kt_charts_widget_100" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
        <!--end::Chart-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Chart widget 3-->

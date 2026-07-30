<!--begin::Card-->
<div class="card mb-7">
    <!--begin::Card body-->
    <div class="card-body">
        @include('Distributor.Transaction.SearchFilter')
        <!--start::Advance form-->
        <div class="collapse" id="kt_advanced_search_form">
            <!--start::Advance Search Filter Form-->
            @include('Distributor.Transaction.AdvanceSearchFilter')
            <!--end::Advance Search Filter Form-->
            <!--start::Advance Export Search Filter Form-->
            @include('Distributor.Transaction.ExportFilter')
            <!--end::Advance Export Search Filter Form-->
        
        </div>
        <!--end::Advance form-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->

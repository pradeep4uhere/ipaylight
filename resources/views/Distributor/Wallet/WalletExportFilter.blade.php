 <!--begin::Advance form-->
 <div class="collapse" id="kt_advanced_search_form">
 <h1 class="d-flex text-primary fw-bolder fs-3 align-items-center my-1 mt-20">
    <span class="svg-icon svg-icon-2 svg-icon-danger">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>
        </svg>
    </span>&nbsp;Wallet Transaction Export</h1>
    <div class="separator separator-dashed my-3 mt-5 mb-10"></div>

    <form action="{{route('export.wallet-transaction')}}" method="post">
        @csrf
        <div class="row g-5 g-xl-12">
		<!--begin::Col-->
		<div class="col-md-3">
                <input type="text" class="form-control form-control-solid ps-10" name="reference_number" placeholder="Reference Number">
        </div>
        <div class="col-md-3">
                <input type="text" class="form-control form-control-solid ps-10" name="transaction_id" placeholder="Txn ID">
        </div>
        <div class="col-md-3">   
                <input class="form-control form-control-solid" id="kt_daterangepicker_51" placeholder="Pick date rage"  name="date_range"/>
        </div>

        <div class="col-md-3">
            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Transaction Type" data-kt-ecommerce-order-filter="status" name="transaction_type">
                    <option></option>
                    <option value="all">All</option>
                    <option value="Credit">Credit</option>
                    <option value="Debit">Debit</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status" name="status">
                    <option></option>
                    <option value="all">All</option>
                    <option value="Success">Success</option>
                    <option value="Failed">Failed</option>
                    <option value="Pending">Pending</option>
                    <option value="Reversal">Reversal</option>
            </select>
        </div>
       
    <div class="col-md-3">  
        <button type="submit" id="kt_horizontal_search_advanced_link" class="form-control btn btn-sm btn-info fw-bolder fs-4" data-bs-toggle="collapse" href="#kt_advanced_search_form"><span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor"></rect>
            <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor"></path>
            <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4"></path>
        </svg>
        Export Report in CSV
        </button>
    </div>
</div>
</form>
           <!--end::Row-->
           
        </div>
        <!--end::Advance form-->
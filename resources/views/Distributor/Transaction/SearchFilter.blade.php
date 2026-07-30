<h1 class="d-flex text-primary fw-bolder fs-3 align-items-center my-1">
    <span class="svg-icon svg-icon-2 svg-icon-danger">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>
        </svg>
    </span>&nbsp;{{getLocalText('transaction_filter')}}</h1>
    <div class="separator separator-dashed my-5"></div>
    <form action="" method="post">
        @csrf
        <div class="row mb-8">
        <div class="col-lg-3 mb-5">
             <label class="fs-6 form-label fw-bolder text-dark">Mobile Number</label> 
             <input type="text" class="form-control form-control-solid ps-5" name="mobile" placeholder="Mobile Number">
        </div>
        <div class="col-lg-3">
             <label class="fs-6 form-label fw-bolder text-dark">Retailer Agent Code</label> 
             <input type="text" class="form-control form-control-solid ps-5" name="agent_code" placeholder="Agent Code">
        </div>
        <div class="col-lg-3">
                <label class="fs-6 form-label fw-bolder text-dark">Transaction  Number</label>
                <input type="text" class="form-control form-control-solid ps-5" name="txn_number" placeholder="Txn Number">
        </div>
        <div class="col-lg-3">
                <label class="fs-6 form-label fw-bolder text-dark">Date Range</label>
                <input class="form-control form-control-solid" id="kt_daterangepicker_4" placeholder="Pick date rage"  name="date_range"/>
        </div>
        <div class="col-lg-3">
            <label class="fs-6 form-label fw-bolder text-dark">Payment Status</label>
            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status" name="status">
                    <option></option>
                    <option value="all">All</option>
                    <option value="created">Created</option>
                    <option value="Success">Success</option>
                    <option value="Cancelled">Failed</option>
                    <option value="Denied">Denied</option>
                    <option value="Pending">Pending</option>
                    <option value="Processing">Processing</option>
                    <option value="Refunded">Refunded</option>
                </select>
        </div>
        <div class="col-lg-3">
                <label class="fs-6 form-label fw-bolder text-dark">&nbsp;</label>
                <button type="submit" class="form-control btn btn-primary me-5">
                    Search</button>
                
        </div>
        <div class="col-lg-3">
               
                
        </div>
        <div class="col-lg-3">
        <label class="fs-6 form-label fw-bolder text-dark">&nbsp;</label>
        <a id="kt_horizontal_search_advanced_link" class="form-control btn btn-sm btn-danger fw-bolder fs-4" data-bs-toggle="collapse" href="#kt_advanced_search_form">Advance Search</a>
        </div>
        </div>
        </form>
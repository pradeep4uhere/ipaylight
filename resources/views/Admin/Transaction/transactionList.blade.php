@extends('Admin.layouts.Admin.listing')
@section('content')
<!--begin::Products-->
@include('Admin.Transaction.summary')
@include('Admin.Transaction.searchForm')
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Order" />
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <!--begin::Flatpickr-->
            <div class="input-group w-250px">
                <input class="form-control form-control-solid rounded rounded-end-0" placeholder="Pick date range" id="kt_ecommerce_sales_flatpickr" />
                <button class="btn btn-icon btn-light" id="kt_ecommerce_sales_flatpickr_clear">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                            <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </button>
            </div>
            <!--end::Flatpickr-->
            <div class="w-100 mw-150px">
                <!--begin::Select2-->
                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
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
                <!--end::Select2-->
            </div>
            <!--begin::Add product-->
            <a href="{{route('export.admin_transaction')}}" class="btn btn-primary">Export</a>
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                <th class="min-w-100px">Created Date</th>
                <th class="min-w-80px">Customer</th>
                <th class="max-w-80px">Txn No.</th>
                <th class="max-w-80px">Payment Ref</th>
                <th class="min-w-50px">Rate</th>
                <th class="min-w-100px">Amount</th>
                <th class="min-w-100px">Deposite</th>
                <th class="min-w-50px">Status</th>
                <th class="min-w-50px">Gateway</th>
                <!-- <th class="min-w-40px">Settalment</th> -->
                <th class="min-w-40px">Invoice</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-800 fs-7">
            <?php if(isset($transactionList)) { ?>
            <?php foreach($transactionList as $item){ ?>
            <tr class="fs-7">
                <td data-order="{{date('Y-m-d',strtotime($item->created_date))}}">{{getFormatDate($item->created_date,'d M, Y | H:i A')}}</td>
                <!--begin::Checkbox-->
                <td data-kt-ecommerce-order-filter="customer_name">
                <a href="{{route('admin.transaction-view',['tid'=>encryptString($item->id)])}}">{{$item->customer_name}}</a></td>
                <td>{{$item->txn_id}}</td>
                <td id="kt_drawer_example_basic_button_{{$item->id}}" class="kt_drawer_example_basic_button" data-url="{{route('admin.get-transaction-details')}}" data-tid="{{encryptstring($item->id)}}">
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                    <a href="javascript:void(0)">{{$item->gateway_payment_id}}</a>
                    </div>
                </td>
                <!--end::Checkbox-->
                <!--begin::Name=-->
                <td>{{$item->rate_fee}}%</td>
                <!--end::Name=-->
                <!--begin::Email=-->
                <td><span class="fw-bolder text-primary">Rs. {{$item->amount}}</span></td>
                <td>
                @if($item->deposite_amount=='0.00')
                <span class="fw-bolder text-danger">Rs. {{$item->deposite_amount}}</span>
                @else
                <span class="fw-bolder text-success">Rs. {{$item->deposite_amount}}</span>
                @endif
                </td>
                <!--end::Email=-->
                <!--begin::Company=-->
                <!--end::Company=-->
                <!--begin::Payment method=-->
                <td data-order="{!!$item->status!!}">
                    @if($item->status=='Success')
                    <div class="fw-bolder text-success">{!!$item->status!!}</div>
                    @elseif($item->status=='created')
                    <div class="fw-bolder text-warning">{!!$item->status!!}</div>
                    @elseif($item->status=='Failed')
                    <div class="fw-bolder text-danger">{!!$item->status!!}</div>
                    @endif
                    <!-- <span class="badge {{($item->status=='Success') ? 'badge-success': 'badge-danger'}}  fs-7" style="width:80px">{!!$item->status!!}</span> -->
                </td>
                <td>{{$item->Gateway->gateway_name}}</td>
                <!--begin::Action=-->
                <!-- <td class="text-end">{{$item->payment_type}}</td> -->
                <td class="text-end">
                <a href="{{route('pdf.generate',['transactionId'=>encryptString($item->id)])}}" target="_blank">
                    <div class="symbol symbol-30px">
                        <img src="assets/media/svg/files/pdf.svg" alt="">
                    </div>  
                    </a>
                </td>
                <!--end::Action=-->
            </tr>
            <?php }} ?>
            
        </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Products-->
@endsection
                        
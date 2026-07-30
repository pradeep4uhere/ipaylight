
    <!--begin::Table Widget 4-->
    <div class="card card-flush h-xl-100">
        <!--begin::Card header-->
        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-gray-800">{{getLocalText('latest_transactions')}}</span>
                <span class="text-gray-400 mt-1 fw-bold fs-6">{{getLocalText('transction_from_all_gateway')}}</span>
            </h3>
            <!--end::Title-->
            <!--begin::Actions-->
            <div class="card-toolbar">
                <!--begin::Filters-->
                <div class="d-flex flex-stack flex-wrap gap-4">
                   
                    <!--end::Destination-->

                    <!--begin::Status-->
                    <div class="d-flex align-items-center fw-bolder">
                        <!--begin::Label-->
                        <div class="text-gray-400 fs-7 me-2">Status</div>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-4="filter_status">
                            <option></option>
                            <option value="Show All" selected="selected">Show All</option>
                            <option value="Success">Success</option>
                            <option value="Cancle">Cancle</option>
                            <option value="Failed">Failed</option>
                            <option value="Pending">Pending</option>
                        </select>
                        <!--end::Select-->
                    </div>
                    <!--end::Status-->
                    <!--begin::Search-->
                    <div class="position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-table-widget-4="search" class="form-control w-150px fs-7 ps-12" placeholder="Search" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Filters-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-2">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-100px">Reference ID</th>
                        <th class="text-start min-w-150px">Created</th>
                        <th class="text-start min-w-125px">Customer</th>
                        <th class="text-start min-w-100px">Mobile</th>
                        <th class="text-start min-w-100px">Txn ID</th>
                        <th class="text-start min-w-100px">Amount</th>
                        <th class="text-start min-w-50px">Rate</th>
                        <th class="text-start min-w-50px">Status</th>
                        <th class="text-end">View</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold fs-7">
                    <?php $count=0; ?>
                    @if($dashboardItem['transactionList']->count())
                    @foreach($dashboardItem['transactionList'] as $item)
                    
                    <tr>
                        <td>
                        <a href="{{route('ro.transaction-view',['tid'=>encryptString($item->id)])}}">{{$item['gateway_payment_id']}}</a>
                        </td>
                        <td class="text-start">{{$item->created_at}}</td>
                        <td class="text-start">
                            {{$item->customer_name}}
                        </td>
                        <td class="text-start">{{$item->customer_mobile}}</td>
                        <td id="kt_drawer_example_basic_button_{{$item->id}}" class="kt_drawer_example_basic_button" data-url="{{route('ro.get-transaction-details')}}" data-tid="{{encryptstring($item->id)}}">
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <a href="javascript:void(0)">{{$item->txn_id}}</a>
                            </div>
                        </td>
                        <td class="text-start">
                            <span class="py-3 px-4 fs-7  fw-boldest">{{$item->amount}}</span>
                        </td>
                        <td class="text-start">
                            <span class="py-3 px-4 fs-7 fw-boldest">{{$item->rate_fee}}%</span>
                        </td>
                        <td class="text-start">
                            @if($item->status=='Success')
                            <span class="badge py-3 px-4 fs-7 badge-light-success">{{$item->status}}</span>
                            @elseif($item->status=='created')
                            <span class="badge py-3 px-4 fs-7 badge-light-warning">{{$item->status}}</span>
                            @else
                            <span class="badge py-3 px-4 fs-7 badge-light-danger">{{$item->status}}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{route('ro.transaction-view',['tid'=>encryptString($item->id)])}}" class="btn btn-sm btn-icon btn-bg-primary btn-active-color-primary">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#FFFFFF">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="#FFFFFF"></rect>
                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="#FFFFFF"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </td>
                    </tr>
                    @php $count++; @endphp
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9">
                            <div class="text-danger alert alert-danger text-center mt-10">No Transaction Found</div>
                        </td>
                    </tr>
                    @endif
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Table Widget 4-->

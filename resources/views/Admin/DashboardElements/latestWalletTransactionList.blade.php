
    <!--begin::Table Widget 4-->
    <div class="card card-flush h-xl-100">
        <!--begin::Card header-->
        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-gray-800">{{getLocalText('latest_wallet_transaction')}} </span>
                <span class="text-gray-400 mt-1 fw-bold fs-6">{{getLocalText('latest_transactions')}}</span>
            </h3>
            <!--end::Title-->
            
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-2">
        <table class="table align-middle table-row-dashed fs-7 gy-5" id="kt_ecommerce_sales_table">
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-100px">Date</th>
                        <th class="text-start min-w-100px">Description</th>
                        <th class="text-start min-w-100px">Reference No.</th>
                        <th class="text-start min-w-125px">Txn Number</th>
						<th class="text-center min-w-100px">Open Bal.</th>
                        <th class="text-center min-w-100px">Amount</th>
                        <th class="text-center min-w-100px">Type</th>
						<th class="text-center min-w-100px" nowrap="nowrap">Close Bal.</th>
                        <th class="text-center min-w-50px">Status</th>
                        <th class="text-start"></th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <?php if(count($dashboardItem['walletTransactions'])){  $count=0; ?>
                <?php foreach($dashboardItem['walletTransactions'] as $item){  //dd();?>
                    <tr class="">
                        <td nowrap="nowrap">
                            <a href="#" class="text-gray-800 text-hover-primary">{{getFormatDate($item->created_at,'d M Y | H:i A')}}</a>
                        </td>
                        <td class="text-start">{{$item->description}}</td>
                        <td class="text-start">{{$item->reference_number}}</td>
                        <td class="text-start kt_drawer_example_basic_button" id="kt_drawer_example_basic_button_{{$item->transaction_id}}"  data-url="{{route('admin.get-transaction-details')}}" data-tid="{{encryptstring($item->transaction_id)}}">
                            <a  class="text-gray-600 text-hover-primary">{{generateNumberWithPad($item->transaction_id)}}</a>
                        </td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-boldest">₹ {{number_format($item->open_balance,2)}}</span>
                        </td>
                        <td class="text-end">
                            <span class="text-gray-800 fw-boldest">₹ {{number_format($item->amount,2)}}</span>
                        </td>
                        <td class="text-end">
                            <?php if($item->transaction_type == 'Credit'){ ?>

                                <span class="badge badge-success fs-base">
                            <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
                                    <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
                                </svg>
                            </span>&nbsp;
                            {{$item->transaction_type}}</span>
                            <?php } ?>
                            <?php if($item->transaction_type == 'Debit'){ ?>
                                <span class="badge badge-danger fs-base">&nbsp;
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                        <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->&nbsp;{{$item->transaction_type}}&nbsp;&nbsp;</span>
                            <?php } ?>
                        </td>
						<td class="text-end">
                            <span class="text-gray-800 fw-boldest">₹ {{number_format($item->close_balance,2)}}</span>
                        </td>
                        <td class="text-end">
                            <?php if($item->transaction_status == 'Success'){ ?>
                            <span class="badge py-3 px-4 fs-7 badge-light-success">{{$item->transaction_status}}</span>
                            <?php } ?>
                            <?php if($item->transaction_status == 'Failed'){ ?>
                                <span class="badge py-3 px-4 fs-7 badge-light-danger">{{$item->transaction_status}}</span>
                            <?php } ?>
                            <?php if($item->transaction_status == 'Pending'){ ?>
                                <span class="badge py-3 px-4 fs-7 badge-light-info">{{$item->transaction_status}}</span>
                            <?php } ?>
                            <?php if($item->transaction_status == 'Reversal'){ ?>
                                <span class="badge py-3 px-4 fs-7 badge-light-danger">{{$item->transaction_status}}</span>
                            <?php } ?>
                        </td>
                        <td class="text-end"></td>
                    </tr>
                    <?php }}else{ ?>
                    <tr>
                        <td colspan="9">
                            <div class="text-danger alert alert-danger text-center mt-10">No Transaction Found</div>
                        </td>
                    </tr>
                    <?php } ?>
				</table>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Table Widget 4-->

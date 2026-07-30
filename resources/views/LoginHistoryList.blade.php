
        <!--begin::Products-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
               <h3> All Login History</h>
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
                            <th class="text-star min-w-100">IP Address</th>
                            <th class="text-start min-w-100px">Browser</th>
                            <th class="text-start min-w-100px">Device</th>
                            <th class="text-start min-w-100px">Location</th>
                            <th class="text-start min-w-100px">Login Date</th>
                           </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach($list as $item)
                        <!--begin::Table row-->
                        <tr class="fs-7">
                            <!--begin::Checkbox-->
                           
                            <!--end::Checkbox-->
                            <!--begin::Order ID=-->
                            <td data-kt-ecommerce-order-filter="order_id">
                                {{$item->ip_address}}
                            </td>
                            <!--end::Order ID=-->
                            <!--begin::Customer=-->
                            <td class="">
                                {{$item->browser}}
                            </td>
                            <!--end::Customer=-->
                            <!--begin::Status=-->
                            <td>
                               {{$item->device}}
                            </td>
                            <!--end::Status=-->
                            <td class="">
                            <?php $jsonArr = json_decode($item->location, true);
                            //dd($jsonArr); ?>
                            <span class="text-muted fw-bold d-block fs-7">{{$jsonArr['regionName']}}</span>
                            <span class="text-muted fw-bold d-block fs-7">{{$jsonArr['cityName']}}, {{$jsonArr['regionCode']}}</span>
                            <span class="text-muted fw-bold d-block fs-7">{{$jsonArr['zipCode']}}, {{$jsonArr['countryName']}}</span>
                            <span class="text-muted fw-bold d-block fs-7">lat/lng : {{$jsonArr['latitude']}}, {{$jsonArr['longitude']}}</span>
                            </td>
                            <!--begin::Total=-->
                            <td >
                                {{$item->created_at}}
                            </td>
                            
                        </tr>
                        <!--end::Table row-->
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <div class="text-end mt-10">
                {{ $list->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
                </div>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Products-->
   
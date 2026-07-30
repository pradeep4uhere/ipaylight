@extends('Admin.layouts.Admin.dashboard')
@section('content')

<div class="row g-5 g-xl-10">
<div class="col-xl-12">
     <!--begin::Products-->
     <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
               <h3>All Announcement History</h>
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
                            <th class="text-star min-w-100">Start Date</th>
                            <th class="text-start min-w-100px">End Date</th>
                            <th class="text-start min-w-100px">Title</th>
                            <th class="text-start min-w-100px">Message</th>
                            <th>Document</th>
                            <th class="text-start min-w-50px">Status</th>
                            <th class="text-start min-w-50px">Action</th>
                           </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @if($list)
                        @foreach($list as $item)
                        <!--begin::Table row-->
                        <tr class="fs-7">
                            <!--begin::Checkbox-->
                           
                            <!--end::Checkbox-->
                            <!--begin::Order ID=-->
                            <td data-kt-ecommerce-order-filter="order_id">
                                {{getFormatDate($item->start_date)}}
                            </td>
                            <!--end::Order ID=-->
                            <!--begin::Customer=-->
                            <td class="">
                                {{getFormatDate($item->end_date)}}
                            </td>
                            <!--end::Customer=-->
                            <!--begin::Status=-->
                            <td class="fw-bolder">
                               {{$item->title}}
                            </td>
                            <!--end::Status=-->
                            <td class="" style="max-width:600px; text-align:justify">
                                {{$item->content}}
                            </td>
                            <!--begin::Total=-->
                            <!--end::Status=-->
                            <td class="">
                                @if($item->document_file!='')
                                <a href="{{ asset('storage/document/' . $item->document_file) }}" target="_blank">
                                <div class="symbol symbol-30px">
                                    @if(pathinfo($item->document_file, PATHINFO_EXTENSION)=='pdf')
                                    <img src="assets/media/svg/files/pdf.svg" alt="">
                                    @elseif(pathinfo($item->document_file, PATHINFO_EXTENSION)=='docx')
                                    <img src="assets/media/svg/files/doc.svg" alt="">
                                    @elseif(pathinfo($item->document_file, PATHINFO_EXTENSION)=='doc')
                                    <img src="assets/media/svg/files/doc.svg" alt="">
                                    @endif
                                </div>  
                                </a> 
                                @endif
                            </td>
                            <!--begin::Total=-->
                            <td >
                                @if($item->is_active=='1')
                                <div class="fw-bolder text-success fs-6">Active</div>
                                @else
                                <div class="fw-bolder text-danger  fs-6">Closed</div>
                                @endif
                            </td>
                            <!--end::Status=-->
                            <td class="" style="max-width:50px; text-align:justify">
                            <div class="timeline-icon symbol symbol-circle symbol-30px">
                                    <div class="symbol-label bg-light-danger" title="Edit Announcment">
                                        <a href="{{route('edit.announcment',['id'=>encryptString($item->id)])}}">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <span class="svg-icon svg-icon-2 svg-icon-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                      </a>
                                    </div>
                                </div>
                            </td>
                            <!--begin::Total=-->
                            
                        </tr>
                        <!--end::Table row-->
                        @endforeach
                        @endif
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
</div>
@endsection
                   
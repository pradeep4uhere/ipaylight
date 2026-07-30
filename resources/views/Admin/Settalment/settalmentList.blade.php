@extends('Admin.layouts.Admin.listing')
@section('content')
@include('Admin.Settalment.SettalmentSummery')
        <!--begin::Navbar-->
        <div class="card mt-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
            <div class="row gy-5 g-xl-10">
            <div class="col-xl-12 mb-5 mb-xl-12">
                <!--begin::Engage widget 1-->
                <div class="card md-5 mb-xl-10">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        @include('Admin.Settalment.SettalmentFilter')
                        <!--begin::Heading-->
                        <!--end::Heading-->
                        <div class="table-responsive">
											<!--begin::Table-->
                                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                    <!--begin::Table head-->
                                    <thead class="border-gray-200 fs-8 fw-bold bg-lighten">
                                        <tr class="fw-bolder text-muted bg-light">
                                            <th class="ps-4 min-w-100px  fw-bolder text-gray-800 fs-7">Created on</th>
                                            <th class="ps-4 min-w-125px fw-bolder text-gray-800 fs-7">Agent Code</th>
                                            <th class="ps-4 min-w-125px fw-bolder text-gray-800 fs-7">Settlement ID</th>
                                            <th class="ps-4 min-w-125px fw-bolder text-gray-800 fs-7">Reference ID</th>
                                            <th class="ps-4 min-w-100px fw-bolder text-gray-800 fs-7">UTR number&nbsp;
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-custom-class="tooltip-dark"  data-bs-toggle="tooltip" data-bs-html="true" title="A Unique Transaction Reference (UTR) number available across banks, which can be used to track a specific settlement in your bank account" data-bs-original-title="" title=""></i>
                                            </th>
                                            <th class="ps-4 min-w-100px fw-bolder text-gray-800 fs-7">Net Settlement</th>
                                            <th class="ps-4 min-w-100px fw-bolder text-gray-800 fs-7">Process Time</th>
                                            <th class="ps-4 min-w-100px fw-bolder text-gray-800 fs-7">Status</th>
                                            <th class="px-4 min-w-100px fw-bolder text-gray-800 fs-7 text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @if($settlementList->count())
                                        @foreach($settlementList as $item)
                                        <tr class="fs-7">
                                            <td class="text-start p-0 ps-4">{{getFormatDate($item->created_at)}}</td>
                                            <td class="text-start p-0 ps-4">{{$item->user->agent_code}}</td>
                                            <td class="text-start p-0 ps-4">{{$item->settlement_id}}</td>
                                            <td class="text-start p-0 ps-4">{{$item->reference_number}}</td>
                                            <td class="text-start p-0 ps-4">{{($item->utr_number!='')?$item->utr_number:'-NA-'}}</td>
                                            <td class="text-start p-0 ps-4"><div class="fw-bolder">₹ {{$item->net_amount}}</div></td>
                                            <td class="text-start p-0 ps-4">{{($item->settled_at!="")?getFormatDate($item->settled_at):""}}</td>
                                            <td class="text-start p-0 ps-4"><span class="badge 
                                            @if($item->status=='Created') badge-light-warning @endif
                                            @if($item->status=='Processed') badge-light-success @endif
                                            ">{{$item->status}}</span></td>
                                            <td class="text-end px-4">
                                            <a href="{{route('admin.view-settalment',['id'=>encryptString($item->id)])}}" class="fw-bolder">Details
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"></rect>
                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                        <td colspan="9">
                                            <div class="alert alert-danger">No Records Found</div>
                                        </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
											<!--end::Table-->
						</div>
                        <!--begin::Links-->
                        <!--end::Links-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Engage widget 1-->
            </div>
            <!--end::Col-->
        </div>
        </div>
        </div>
@section('script')
@endsection
@endsection
                        
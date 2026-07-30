<!--begin::Row-->
<div class="row gy-5 g-xl-8 mt-10">
<!--begin::Col-->
<div class="col-xl-8">
    <!--begin::Tables widget 8-->
    <div class="card h-xl-100">
        <!--begin::Header-->
        <div class="card-header position-relative py-0 border-bottom-2">
            <!--begin::Nav-->
            <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
                <!--begin::Nav item-->
                <li class="nav-item p-0 ms-0 me-8">
                    <!--begin::Nav link-->
                    <a class="nav-link btn btn-color-muted px-0 show active" data-bs-toggle="tab" href="#kt_table_widget_7_tab_content_1">
                        <!--begin::Title-->
                        <span class="nav-text fs-4 fw-bolder mb-2 text-dark">{{getLocalText('latest_support_ticket')}}</span>
                        <!--end::Title-->
                        <!--begin::Bullet-->
                        <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Nav link-->
                </li>
                <!--end::Nav item-->
                
            </ul>
            <!--end::Nav-->
            
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Tab Content (ishlamayabdi)-->
            <div class="tab-content mb-2">
                <!--begin::Tap pane-->
                <div class="tab-pane fade show active" id="kt_table_widget_7_tab_content_1">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                    @if($dashboardItem['ticketList'])
                    @foreach($dashboardItem['ticketList'] as $item)
                    <div class="d-flex flex-stack py-4">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-45px symbol-circle">
                                @if($item['User']['role']=='admin')
                                <span class="symbol-label bg-light-success text-success fs-6 fw-bolder">{{getFirstChar($item['User']['name'])}}</span>
                                @else
                                <span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">{{getFirstChar($item['User']['name'])}}</span>
                                @endif
                                 <!--begin::Lat seen-->
                                <div class="d-flex flex-column align-items-end mt-2">
                                    @if($item['status']=='Open')
                                    <span class="badge badge-danger">Open</span>
                                    @elseif($item['status']=='Closed')
                                    <span class="badge badge-success">Closed</span>
                                    @else
                                    <span class="badge badge-warning">Pending</span>
                                    @endif
                                </div>
                                <!--end::Lat seen-->
                            </div>
                            
                
                            
                            <!--end::Avatar-->
                            <!--begin::Details-->
                            <div class="ms-5">
                                <a href="#" class="fs-7 fw-bolder text-gray-900 text-hover-primary mb-2">#{{getTicketNumber($item)}}&nbsp;|&nbsp;{{$item['User']['name']}}</a>
                                <span class="float-end">{{getFormatDate($item['created_at'])}}</span>
                                <div class="p-5 bg-light-info text-dark fw-bold w-lg-640px text-start" data-kt-element="message-text" style="min-width:650px;">
                                    <div class="fw-bolder">{{$item['subject']}}</div>
                                    {{$item['description']}}
                                    
                                </div>

                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->
                       
                    </div>
                    <div class="separator separator-dashed"></div>
                    @endforeach
                    @endif





                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Tap pane-->
                
               
            </div>
            <!--end::Tab Content-->
            <!--begin::Action-->
            <div class="float-end">
                <a href="{{route('support.overview')}}" class="btn btn-sm btn-danger">{{getLocalText('view_all_ticket')}}s</a>
            </div>
            <!--end::Action-->
        </div>
        <!--end: Card Body-->
    </div>
    <!--end::Tables widget 8-->
</div>
<!--end::Col-->
<!--begin::Col-->
<div class="col-xl-4">
    <!--begin::Engage widget 3-->
    <div class="card bg-primary h-xl-100">
        <!--begin::Body-->
        <div class="card-body d-flex flex-column pt-13 pb-14">
            <!--begin::Heading-->
            <div class="m-0">
                <!--begin::Title-->
                <h1 class="fw-bold text-white text-center lh-lg mb-9">{{getLocalText('help_suppot_center')}} ?
                <span class="fw-boldest">{{getLocalText('here_we_are_to_help')}}</span></h1>
                <!--end::Title-->
                <!--begin::Illustration-->
                <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 mb-lg-12" style="background-image:url('assets/media/svg/illustrations/easy/6.svg')"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Heading-->
            <!--begin::Links-->
            <div class="text-center">
                <!--begin::Link-->
                <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_ticket" class="btn btn-white fw-bolder fs-8 fs-lg-base text-center">{{getLocalText('create_new_ticket')}}</a>
                <!--end::Link-->
                <!--begin::Link-->
                <a class="btn btn-sm bg-white btn-color-white bg-opacity-20" href="{{route('support.overview')}}">{{getLocalText('view_all_ticket')}}</a>
                <!--end::Link-->
            </div>
            <!--end::Links-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Engage widget 3-->
</div>
<!--end::Col-->
</div>	
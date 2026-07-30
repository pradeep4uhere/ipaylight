@extends('layouts.dashboard')
@section('content')
<div class="card mb-12">
    <!--begin::Hero body-->
    <div class="card-body flex-column p-5">
        <!--begin::Hero content-->
        <div class="d-flex align-items-center h-lg-300px p-5 p-lg-15">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column align-items-start justift-content-center flex-equal me-5">
                <!--begin::Title-->
                <h1 class="fw-bolder fs-4 fs-lg-1 text-gray-800 mb-5 mb-lg-10">How Can We Help You?</h1>
                <!--end::Title-->
                <h6 class="fw-bolder mb-5">Mail Support at
                <a href="#" class="">{{getSupportEmail()}}</a></h6>
                <h6 class="fw-bolder mb-5">Call Support at
                <a href="#" class="">{{getSupportPhone()}}</a></h6>
                <!--begin::Input group-->
                <div class="position-relative w-100">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_ticket" class="btn btn-primary fw-bolder fs-8 fs-lg-base text-center">{{getLocalText('create_new_ticket')}}</a>
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Wrapper-->
            <div class="flex-equal d-flex justify-content-end align-items-end">
                <!--begin::Illustration-->
                <img src="assets/media/svg/support.svg" alt="" class=" mh-125px mh-lg-375px">
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Hero content-->
        
        <!--end::Hero nav-->
    </div>
    <!--end::Hero body-->
</div>

<div class="card">
    <!--begin::Body-->
    <div class="card-body p-10 p-lg-15">
        <!--begin::Classic content-->
        <div class="mb-13">
            <!--begin::Intro-->
            <div class="mb-15">
                <!--begin::Title-->
                <h4 class="fs-2x text-gray-800 w-bolder mb-5">
                <span class="svg-icon svg-icon-danger svg-icon-2x svg-icon-lg-3x">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M13 9V8C13 7.4 13.4 7 14 7H15C16.7 7 18 5.7 18 4V3C18 2.4 17.6 2 17 2C16.4 2 16 2.4 16 3V4C16 4.6 15.6 5 15 5H14C12.3 5 11 6.3 11 8V9H13Z" fill="currentColor"></path>
                                    <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V10C2 9.4 2.4 9 3 9H21C21.6 9 22 9.4 22 10V21C22 21.6 21.6 22 21 22ZM5 12C4.4 12 4 12.4 4 13C4 13.6 4.4 14 5 14C5.6 14 6 13.6 6 13C6 12.4 5.6 12 5 12ZM8 12C7.4 12 7 12.4 7 13C7 13.6 7.4 14 8 14C8.6 14 9 13.6 9 13C9 12.4 8.6 12 8 12ZM11 12C10.4 12 10 12.4 10 13C10 13.6 10.4 14 11 14C11.6 14 12 13.6 12 13C12 12.4 11.6 12 11 12ZM14 12C13.4 12 13 12.4 13 13C13 13.6 13.4 14 14 14C14.6 14 15 13.6 15 13C15 12.4 14.6 12 14 12ZM9 15C8.4 15 8 15.4 8 16C8 16.6 8.4 17 9 17C9.6 17 10 16.6 10 16C10 15.4 9.6 15 9 15ZM12 15C11.4 15 11 15.4 11 16C11 16.6 11.4 17 12 17C12.6 17 13 16.6 13 16C13 15.4 12.6 15 12 15ZM15 15C14.4 15 14 15.4 14 16C14 16.6 14.4 17 15 17C15.6 17 16 16.6 16 16C16 15.4 15.6 15 15 15ZM19 18C18.4 18 18 18.4 18 19C18 19.6 18.4 20 19 20C19.6 20 20 19.6 20 19C20 18.4 19.6 18 19 18ZM7 19C7 18.4 6.6 18 6 18H5C4.4 18 4 18.4 4 19C4 19.6 4.4 20 5 20H6C6.6 20 7 19.6 7 19ZM7 16C7 15.4 6.6 15 6 15H5C4.4 15 4 15.4 4 16C4 16.6 4.4 17 5 17H6C6.6 17 7 16.6 7 16ZM17 14H19C19.6 14 20 13.6 20 13C20 12.4 19.6 12 19 12H17C16.4 12 16 12.4 16 13C16 13.6 16.4 14 17 14ZM18 17H19C19.6 17 20 16.6 20 16C20 15.4 19.6 15 19 15H18C17.4 15 17 15.4 17 16C17 16.6 17.4 17 18 17ZM17 19C17 18.4 16.6 18 16 18H9C8.4 18 8 18.4 8 19C8 19.6 8.4 20 9 20H16C16.6 20 17 19.6 17 19Z" fill="currentColor"></path>
                                </svg>
                            </span>{{getLocalText('all_tickets')}}</h4>
                <!--end::Title-->
                <!--begin::Text-->
                <p class="fw-bold fs-6 text-gray-600 mb-2">Welcome to our Support Ticket Page! At {{env('APP_NAME')}}, we strive to provide exceptional customer support to ensure your satisfaction. If you have encountered any issues, questions, or need assistance with our products or services, you're in the right place. Simply fill out the form below with details about your inquiry, and our dedicated support team will promptly address your concerns. Whether it's troubleshooting technical issues, clarifying product features, or seeking general assistance, we're here to help you every step of the way."</p>
                <!--end::Text-->
            </div>
            <!--end::Intro-->
            <!--begin::Row-->
            <div class="row mb-12">
                <!--begin::Col-->
                <div class="col-md-12 pe-md-10 mb-10 mb-md-0">
                    <!--begin::Section-->
                    @if($ticketList->count())
                    @foreach($ticketList as $item)
                    <!--begin::Section-->
                    <div class="mt-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_4_{{$item->id}}">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                        <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <div class="w-100 d-flex flex-stack mb-1">
                                <!--begin::Container-->
                                <div class="d-flex align-items-center f">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column fw-bold fs-5 text-gray-600 text-dark">
                                        <!--begin::Text-->
                                        <div class="d-flex align-items-center fw-bold">
                                            
                                            <!--begin::Username-->
                                            {{$item->subject}}&nbsp;&nbsp;-&nbsp;&nbsp;{{$item->issue_type}}
                                            <!--end::Username-->
                                            <span class="m-0"></span>
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::Date-->
                                        <span class="text-muted fw-bolder fs-7">Ticket Number: {{getTicketNumber($item)}} &nbsp;|&nbsp;{{getFormatDate($item->created_at)}}</span>
                                        <!--end::Date-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Container-->
                                <!--begin::Actions-->
                                <div class="m-0">
                                    @if($item->status=='Open')
                                    <span class="badge badge-light-danger fw-bolder fs-4 px-5 py-1 ms-1">{{$item->status}}</span>
                                    @elseif($item->status=='Closed')
                                    <span class="badge badge-light-success fw-bolder fs-4 px-5 py-1 ms-1">{{$item->status}}</span>
                                    @else
                                    <span class="badge badge-light-warning fw-bolder fs-4 px-5 py-1 ms-1">{{$item->status}}</span>
                                    @endif

                                </div>
                                <!--end::Actions-->
                            </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_4_{{$item->id}}" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-700 fw-bold fs-5 ps-10">{!!$item->description!!}</div>
                            <div class="float-end mb-10">
                            <a href="#" class="text-gray-800 text-hover-primary d-flex flex-column">
                                <!--begin::Image-->
                                <div class="symbol symbol-20px mb-5">
                                @if($item->document_file!='')
                                @if(strtolower(pathinfo($item->document_file, PATHINFO_EXTENSION))=='pdf')
                                    <img src="assets/media/svg/files/pdf.svg" alt="">&nbsp;Attachment 
                                @elseif(strtolower(pathinfo($item->document_file, PATHINFO_EXTENSION))=='doc')
                                    <img src="assets/media/svg/files/doc.svg" alt="">&nbsp;Attachment 
                                @elseif(strtolower(pathinfo($item->document_file, PATHINFO_EXTENSION))=='docx')
                                    <img src="assets/media/svg/files/doc.svg" alt="">&nbsp;Attachment 
                                @else
                                    <img src="assets/media/svg/images.png" alt="">&nbsp;Attachment 
                                @endif
                                @endif
                                </div>
                            </a>
                            </div>
                            <!--end::Text-->
                            <div class="ps-10 mt-15 mb-10">
                            <div class="separator separator-dashed mb-7 ps-10"></div>
                            @if(array_key_exists('replies', $item->toArray()))
                            @foreach($item->replies as $replayItem)
                            @include('Support.ticketReply',['replyItem'=>$replayItem])
                            @endforeach
                            @endif
                            @if($item->status!='Closed')
                            <div class="mb-0 mt-10 bg-light-warning rounded border-warning border border-dashed p-5">
                                <form action="{{route('support.reply-on-ticket')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex align-items-center text-gray-800 fw-bolder text-hover-primary fs-5 me-3">Write Your Comment</div>
                                    <textarea class="form-control form-control-solid placeholder-gray-600 fw-bolder fs-4 ps-9 pt-7" rows="3" name="message" placeholder="Write Your Comment"></textarea>
                                    <input type="hidden" name="ticket_id" value="{{$item->id}}">
                                    <input type="hidden" name="user_id" value="{{getAuthValue('id')}}">
                                    <div class="row">
									<!--begin::Col-->
									<div class="col-md-6 fv-row fv-plugins-icon-container py-5">
                                    <input type="file" name="document_file" class="form-control"/>
                                    </div>
                                    @if(getAuthValue('role')=='Admin')
                                    <div class="col-md-3 fv-row fv-plugins-icon-container py-5">
                                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Your Query Type" name="status">
                                        <option value="Pending">Ticket Status Pending</option>
                                        <option value="Closed">Ticket Status Closed</option>
                                        <option value="Open">Ticket Status Open</option>
                                    </select>
                                    </div>
                                    @endif

                                    <div class="col-md-3 fv-row fv-plugins-icon-container py-5">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    
                                    </div>
                                    </div>
                                </form>
                                <!--end::Submit-->
                            </div>
                            @endif
                            </div>
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    @endforeach
                    @endif
                    <!--end::Section-->
                    <!--end::Accordion-->
                </div>
                <!--end::Col-->
            </div>
            {{ $ticketList->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
        </div>
        <!--end::Classic content-->
    </div>
    <!--end::Body-->
</div>
@endsection
                        
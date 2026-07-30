
@if(!empty($annoucementList))
@foreach($annoucementList as $item)
<div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-4">
    <!--begin::Icon-->
    <!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path opacity="0.3" d="M22 19V17C22 16.4 21.6 16 21 16H8V3C8 2.4 7.6 2 7 2H5C4.4 2 4 2.4 4 3V19C4 19.6 4.4 20 5 20H21C21.6 20 22 19.6 22 19Z" fill="currentColor"></path>
            <path d="M20 5V21C20 21.6 19.6 22 19 22H17C16.4 22 16 21.6 16 21V8H8V4H19C19.6 4 20 4.4 20 5ZM3 8H4V4H3C2.4 4 2 4.4 2 5V7C2 7.6 2.4 8 3 8Z" fill="currentColor"></path>
        </svg>
    </span>
    <!--end::Svg Icon-->
    <!--end::Icon-->
    <!--begin::Wrapper-->
    <div class="d-flex flex-stack flex-grow-1">
        <!--begin::Content-->
        <div class="fw-bold">
            
            <div class="fs-6 text-gray-700">
            <div class="card-title fw-bolder fs-5">{{$item['title']}}</div>
            {{$item['content']}}
            @if($item['document_file']!='')
            <a href="{{asset('storage/document/'.$item['document_file'])}}" class="fw-bolder" target="_blank">Click Here Download Document</a>
            @endif
            </div>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Wrapper-->
</div>
@endforeach
@endif
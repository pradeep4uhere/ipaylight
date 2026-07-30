@if(!empty($paymentLink))
    <?php  $count=1; ?>
    @foreach($paymentLink as $item)
    <div class="col-xl-12 rounded border border-dashed border-gray-500 py-4 px-6 mb-5">
     <div class="row mt-5">
        <div class="col-xl-9">
            <h4 class="text-gray-800 mb-0 fs-5">{{$item->link_title}}&nbsp;|&nbsp;{{$item->Gateway->gateway_name}}&nbsp;|&nbsp;Expiry: {{date("d M, Y",strtotime($item->expiry_date))}}</h4>
            <p class="fs-6 fw-bold text-gray-600 py-4 m-0 fs-7">{{$item->description}}</p>
        </div>
        <div class="col-xl-3">
            <div class="row">
                <div class="col-xl-6">
                    @if($item->status=='Active')
                    <div class="badge badge-light-success">Active</div>
                    @else
                    <div class="badge badge-light-danger">InActive</div>
                    @endif
                </div>

                <div class="col-xl-6">
                    <form action="{{ route('payment-links.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-light-danger border fw-bolder text-danger">
                    Remove
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex">
          <span class="svg-icon svg-icon-1 me-1 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M18.4 5.59998C18.7766 5.9772 18.9881 6.48846 18.9881 7.02148C18.9881 7.55451 18.7766 8.06577 18.4 8.44299L14.843 12C14.466 12.377 13.9547 12.5887 13.4215 12.5887C12.8883 12.5887 12.377 12.377 12 12C11.623 11.623 11.4112 11.1117 11.4112 10.5785C11.4112 10.0453 11.623 9.53399 12 9.15698L15.553 5.604C15.9302 5.22741 16.4415 5.01587 16.9745 5.01587C17.5075 5.01587 18.0188 5.22741 18.396 5.604L18.4 5.59998ZM20.528 3.47205C20.0614 3.00535 19.5074 2.63503 18.8977 2.38245C18.288 2.12987 17.6344 1.99988 16.9745 1.99988C16.3145 1.99988 15.661 2.12987 15.0513 2.38245C14.4416 2.63503 13.8876 3.00535 13.421 3.47205L9.86801 7.02502C9.40136 7.49168 9.03118 8.04568 8.77863 8.6554C8.52608 9.26511 8.39609 9.91855 8.39609 10.5785C8.39609 11.2384 8.52608 11.8919 8.77863 12.5016C9.03118 13.1113 9.40136 13.6653 9.86801 14.132C10.3347 14.5986 10.8886 14.9688 11.4984 15.2213C12.1081 15.4739 12.7616 15.6039 13.4215 15.6039C14.0815 15.6039 14.7349 15.4739 15.3446 15.2213C15.9543 14.9688 16.5084 14.5986 16.975 14.132L20.528 10.579C20.9947 10.1124 21.3649 9.55844 21.6175 8.94873C21.8701 8.33902 22.0001 7.68547 22.0001 7.02551C22.0001 6.36555 21.8701 5.71201 21.6175 5.10229C21.3649 4.49258 20.9947 3.93867 20.528 3.47205Z" fill="currentColor"></path>
                    <path d="M14.132 9.86804C13.6421 9.37931 13.0561 8.99749 12.411 8.74695L12 9.15698C11.6234 9.53421 11.4119 10.0455 11.4119 10.5785C11.4119 11.1115 11.6234 11.6228 12 12C12.3766 12.3772 12.5881 12.8885 12.5881 13.4215C12.5881 13.9545 12.3766 14.4658 12 14.843L8.44699 18.396C8.06999 18.773 7.55868 18.9849 7.02551 18.9849C6.49235 18.9849 5.98101 18.773 5.604 18.396C5.227 18.019 5.0152 17.5077 5.0152 16.9745C5.0152 16.4413 5.227 15.93 5.604 15.553L8.74701 12.411C8.28705 11.233 8.28705 9.92498 8.74701 8.74695C8.10159 8.99737 7.5152 9.37919 7.02499 9.86804L3.47198 13.421C2.52954 14.3635 2.00009 15.6417 2.00009 16.9745C2.00009 18.3073 2.52957 19.5855 3.47202 20.528C4.41446 21.4704 5.69269 21.9999 7.02551 21.9999C8.35833 21.9999 9.63656 21.4704 10.579 20.528L14.132 16.975C14.5987 16.5084 14.9689 15.9544 15.2215 15.3447C15.4741 14.735 15.6041 14.0815 15.6041 13.4215C15.6041 12.7615 15.4741 12.108 15.2215 11.4983C14.9689 10.8886 14.5987 10.3347 14.132 9.86804Z" fill="currentColor"></path>
                </svg>
            </span>
            @if($item->status=='Active')
            <input id="kt_referral_link_input{{$count}}" type="text" class="form-control form-control-solid me-3 flex-grow-1 bg-light-success" name="search" value="{{env('APP_URL')}}/{{$item->payment_link}}" readonly="readonly">
            <button id="kt_referral_program_link_copy_btn{{$count}}"  class="btn btn-light-danger btn-active-light-danger fw-bolder flex-shrink-0 copyBtn" data-clipboard-target="kt_referral_link_input{{$count}}">Copy Link</button>&nbsp;
            <a href="{{env('APP_URL')}}/{{$item->payment_link}}" class="btn btn-light-primary btn-active-primary fw-bolder flex-shrink-0" target="_blank">View</a>&nbsp;
            <a href="{{route('ro.editLink',['id'=>encryptstring($item->id)])}}" class="btn btn-light-warning btn-active-success fw-bolder flex-shrink-0 editLink" data-edit-target="{{encryptstring($item->id)}}">Edit</a>
            @else
            <input id="kt_referral_link_input{{$count}}" type="text" class="form-control form-control-solid me-3 flex-grow-1 bg-light-default" name="search" value="{{env('APP_URL')}}/{{$item->payment_link}}" disabled="disabled">
            <button id="kt_referral_program_link_copy_btn{{$count}}"  class="btn btn-light btn-active-light-default fw-bolder flex-shrink-0 " data-clipboard-target="kt_referral_link_input{{$count}}" disabled="disabled">Copy Link</button>
            <a href="{{env('APP_URL')}}/{{$item->payment_link}}" class="btn btn-light-primary btn-active-primary fw-bolder flex-shrink-0" target="_blank">View</a>&nbsp;
            <a href="{{route('ro.editLink',['id'=>encryptstring($item->id)])}}" class="btn btn-light-warning btn-active-success fw-bolder flex-shrink-0 editLink" data-edit-target="{{encryptstring($item->id)}}">Edit</a>
            @endif


        </div>
    </div>
    <?php $count++;?>
    @endforeach
    @endif
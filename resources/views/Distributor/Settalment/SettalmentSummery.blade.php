<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-1 pb-1">
        <form action="{{route('ds.settalment')}}" method="get">
        <div class="row g-5 g-xl-8 p-5">
        <div class="col-xl-1 fs-6 py-3">
        <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>
            </svg>
        </span> <span class="fw-bolder"> Filter</span>
        </div>
        <div class="col-xl-3 fs-6">
        <input type="text" class="form-control form-control-solid" name="agent_code" placeholder="Enter Agent Code"/>
        </div>
        
        <div class="col-xl-3 fs-6">
        <select class="form-select form-select-solid fs-4" name="pg" data-control="select2" data-hide-search="true" data-placeholder="Choose Gateway">
            <option value="All">All</option>
            
            @if(!empty($retailerGatewayList))
            @foreach($retailerGatewayList as $key=>$item)
            <option value="{{encryptString($key)}}" @if($key==$gateway_name) selected="selected" @endif>{{$key}}</option>    
            @endforeach
            @endif
        </select>
        </div>
        <div class="col-xl-3 fs-6"><input type="submit" class="form-control btn btn-primary fs-4" value="View Settalment Report"/></div>
        </div>
      </form>
    </div>
</div>
<?php 
if($gateway_name!=''){ 
    $settalmentDetails = $retailerGatewayList[$gateway_name];
    if(!empty($settalmentDetails['settalment'])){
        //dd($settalmentDetails['settalment']);
        $domestic_settlement = $settalmentDetails['settalment']['domestic_settlement'];
        $domestic_settlement_cycle = $settalmentDetails['settalment']['domestic_settlement_cycle'];
        $domestic_settlement_time = $settalmentDetails['settalment']['domestic_settlement_time'];
        $international_settlement = $settalmentDetails['settalment']['international_settlement'];
        $international_settlement_cycle = $settalmentDetails['settalment']['international_settlement_cycle'];
        if(is_numeric($domestic_settlement_time)){
            $domestic_settlement_time = $domestic_settlement_time.' Minutes';
        }else{
            $domestic_settlement_time = $domestic_settlement_time;
        }
        $message = __('messages.SETTALMENT_ENABLED_DESCRIPTION').' '.__('Your Settalment Cycle is '.$domestic_settlement_cycle)
        .' '.__('Your Settalment Time is '.$domestic_settlement_time);
    }else{
        $domestic_settlement = "Not Enabled";
    }
?>
@if($domestic_settlement=='Hold')
@include('Retailer.elements.NotificationBanner.DangerBanner',[
        'title' => __('messages.SETTALMENT_ON_HOLD_TITLE'),
        'message' => __('messages.SETTALMENT_ON_HOLD_DESCRIPTION')])
@elseif($domestic_settlement=='Enable')
@include('Retailer.elements.NotificationBanner.SuccessBanner',[
        'title' => __('messages.SETTALMENT_ENABLED_TITLE'),
        'message' => $message
        ])
@else
@include('Retailer.elements.NotificationBanner.WarnningBanner',[
        'title' => __('messages.SETTALMENT_NOT_ENABLED_TITLE'),
        'message' => __('messages.SETTALMENT_NOT_ENABLED_DESCRIPTION')])
@endif
<?php } ?>
@if($userDetails)
@include('Retailer.elements.NotificationBanner.SuccessBanner',[
        'title' => __($userDetails->name.' '.$userDetails->last_name.' - ['.ucfirst($userDetails->role).']['.$userDetails->agent_code.']'),
        'message' => "Your are looking for above user details settalment report ?"
        ])
@endif
<div class="card mb-10 mb-xl-10">
<div class="card-body pt-1 pb-9">
<div class="row g-5 g-xl-8">
<div class="col-xl-9 col-xs-12 col-md-12 p-5 fs-6 fw-bolder">
<span class="svg-icon svg-icon-2 me-1">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#50cd89">
        <path opacity="0.3" d="M21.6 11.2L19.3 8.89998V5.59993C19.3 4.99993 18.9 4.59993 18.3 4.59993H14.9L12.6 2.3C12.2 1.9 11.6 1.9 11.2 2.3L8.9 4.59993H5.6C5 4.59993 4.6 4.99993 4.6 5.59993V8.89998L2.3 11.2C1.9 11.6 1.9 12.1999 2.3 12.5999L4.6 14.9V18.2C4.6 18.8 5 19.2 5.6 19.2H8.9L11.2 21.5C11.6 21.9 12.2 21.9 12.6 21.5L14.9 19.2H18.2C18.8 19.2 19.2 18.8 19.2 18.2V14.9L21.5 12.5999C22 12.1999 22 11.6 21.6 11.2Z" fill="#50cd89"></path>
        <path d="M11.3 9.40002C11.3 10.2 11.1 10.9 10.7 11.3C10.3 11.7 9.8 11.9 9.2 11.9C8.8 11.9 8.40001 11.8 8.10001 11.6C7.80001 11.4 7.50001 11.2 7.40001 10.8C7.20001 10.4 7.10001 10 7.10001 9.40002C7.10001 8.80002 7.20001 8.4 7.30001 8C7.40001 7.6 7.7 7.29998 8 7.09998C8.3 6.89998 8.7 6.80005 9.2 6.80005C9.5 6.80005 9.80001 6.9 10.1 7C10.4 7.1 10.6 7.3 10.8 7.5C11 7.7 11.1 8.00005 11.2 8.30005C11.3 8.60005 11.3 9.00002 11.3 9.40002ZM10.1 9.40002C10.1 8.80002 10 8.39998 9.90001 8.09998C9.80001 7.79998 9.6 7.70007 9.2 7.70007C9 7.70007 8.8 7.80002 8.7 7.90002C8.6 8.00002 8.50001 8.2 8.40001 8.5C8.40001 8.7 8.30001 9.10002 8.30001 9.40002C8.30001 9.80002 8.30001 10.1 8.40001 10.4C8.40001 10.6 8.5 10.8 8.7 11C8.8 11.1 9 11.2001 9.2 11.2001C9.5 11.2001 9.70001 11.1 9.90001 10.8C10 10.4 10.1 10 10.1 9.40002ZM14.9 7.80005L9.40001 16.7001C9.30001 16.9001 9.10001 17.1 8.90001 17.1C8.80001 17.1 8.70001 17.1 8.60001 17C8.50001 16.9 8.40001 16.8001 8.40001 16.7001C8.40001 16.6001 8.4 16.5 8.5 16.4L14 7.5C14.1 7.3 14.2 7.19998 14.3 7.09998C14.4 6.99998 14.5 7 14.6 7C14.7 7 14.8 6.99998 14.9 7.09998C15 7.19998 15 7.30002 15 7.40002C15.2 7.30002 15.1 7.50005 14.9 7.80005ZM16.6 14.2001C16.6 15.0001 16.4 15.7 16 16.1C15.6 16.5 15.1 16.7001 14.5 16.7001C14.1 16.7001 13.7 16.6 13.4 16.4C13.1 16.2 12.8 16 12.7 15.6C12.5 15.2 12.4 14.8001 12.4 14.2001C12.4 13.3001 12.6 12.7 12.9 12.3C13.2 11.9 13.7 11.7001 14.5 11.7001C14.8 11.7001 15.1 11.8 15.4 11.9C15.7 12 15.9 12.2 16.1 12.4C16.3 12.6 16.4 12.9001 16.5 13.2001C16.6 13.4001 16.6 13.8001 16.6 14.2001ZM15.4 14.1C15.4 13.5 15.3 13.1 15.2 12.9C15.1 12.6 14.9 12.5 14.5 12.5C14.3 12.5 14.1 12.6001 14 12.7001C13.9 12.8001 13.8 13.0001 13.7 13.2001C13.6 13.4001 13.6 13.8 13.6 14.1C13.6 14.7 13.7 15.1 13.8 15.4C13.9 15.7 14.1 15.8 14.5 15.8C14.8 15.8 15 15.7 15.2 15.4C15.3 15.2 15.4 14.7 15.4 14.1Z" fill="#50cd89"></path>
    </svg>
</span>Settalment Overview </div>
<div class="col-xl-3 col-xs-12 col-md-12 p-5 fs-6 text-end fw-bold text-gray-600">
<a href="#" class=" mt-5" data-bs-toggle="modal" data-bs-target="#kt_modal_instant_settalment_cycle">
    <span class="svg-icon svg-icon-2 me-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="#f1416c">
            <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="#f1416c"></path>
            <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="#f1416c"></path>
        </svg>
    </span>
    My Settalment Cycle
    </a>
</div>

</div>
<div class="row g-5 g-xl-8">
<div class="col-xl-3 border border-dashed p-10">
<div class="fw-bold">
<h5 class="text-gray-600 fw-bold">Current Balance
<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-custom-class="tooltip-dark"  data-bs-toggle="tooltip" data-bs-placement="top"  title="This is the total amount that is due to be deposited in your bank account after deduction of taxes, platform fees, any other applicable charges, and adjustment of refunds and credits" ></i>
</h5>
</div>
<h2 class="text-gray-900 fw-bolder">₹ {{$totalAmount}}</h2>
@if($totalAmount>0)
<a href="#" class="btn btn-sm btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#kt_modal_instant_settal">Settal Amount</a>
@endif
</div>


<div class="col-xl-3 border border-dashed p-10">
<div class="fw-bold">
<h5 class="text-gray-600 fw-bold">Settlement due today 
    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-custom-class="tooltip-dark"  data-bs-toggle="tooltip" data-bs-html="true" title="This is the amount initiated for deposit into your bank account and is in processing" data-bs-original-title="" title=""></i>
</h5>
</div>
<h2 class="text-gray-900 fw-bolder">₹{{$todayTotalSettalment}}</h2>

</div>


<div class="col-xl-3 border border-dashed  p-10">
    <div class="fw-bold">
    <h5 class="text-gray-600 fw-bold">Previous settlement
    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-custom-class="tooltip-dark"  data-bs-toggle="tooltip" data-bs-html="true" title="This is the last amount initiated for deposit into your bank account (the settlement may have either processed or failed)" data-bs-original-title="" title=""></i>
    </h5>
    </div>
    <h2 class="text-gray-900 fw-bolder">₹ {{$prevousSettalAmount}}</h2>
    <span class="badge badge-success">Processe on {{getFormatDate($upcommingSettalmentDate)}}</span>
</div>


<div class="col-xl-3  border border-dashed  p-10">
    <div class="fw-bold">
    <h5 class="text-gray-600 fw-bold">Upcoming settlement
    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-custom-class="tooltip-dark"  data-bs-toggle="tooltip" data-bs-html="true" title="This is the amount that’ll be deposited into your bank account next as per your settlement cycle." data-bs-original-title="" title=""></i>
    </h5>
    </div>
    <h2 class="text-gray-900 fw-bolder">₹ {{$upcommingSettalmentAmount}}</h2>
    <span class="badge badge-danger">Processe on {{getFormatDate($upcommingSettalmentDate)}}</span>
    
</div>
</div>
</div>
</div>


@extends('Retailer.layouts.payouts')
@section('content')

<?php 
//$data['Status'] = 'Reverse';
if($data['Status']=='Success'){
    $class = "success";
    }elseif($data['Status']=='Pending'){
    $class = "warning";
    }elseif($data['Status']=='Reverse'){
    $class = "info";
    }elseif($data['Status']=='Cancle'){
    $class = "danger";
    }else{
    $class = "danger";
}
?>
<div class="card bg-light-{{$class}}" id="capture-section">

<div class="card shadow-sm card-rounded  overflow-hidden position-relative m-1" style="font-family: system-ui; ">
    <div class="card-header">
        <div class="card-title p-0">
         <div class="row mt-2">
            <div class="col-md-12 text-start fw-bold fs-5 text-gray-600">
                <img src="logo.svg" alt="logo" width="150px" height="40px"/>
            </div>
            <div class="col-md-12 text-start fw-bold fs-5 text-gray-600">
            {{env('APP_SOLOGN')}}
            </div>
            </div>
            
        </div>
        <div class="card-toolbar">
            <div class="row">
            <div class="col-md-12 text-end fw-bold fs-5 text-gray-600">
                <span class="fw-bolder fs-4">Agent: {{getAuthValue('name')}}&nbsp;|&nbsp;{{getAuthValue('agent_code')}}</span>
            </div>
            <div class="col-md-12 text-end fw-bold fs-5 text-gray-600">
                <span class="fw-bolder">M:-&nbsp;{{getAuthValue('mobile')}}&nbsp;|&nbsp;E:-{{getAuthValue('email')}}</span>
            </div>
            </div>
        </div>
    </div>
<div class="card-body card-scroll">
       <div class="row">
        <div class="col-md-6">
        <div class="fw-bold fs-5 text-gray-600">
            <br><span class="fw-bolder">Receipt No:</span>&nbsp;#{{$data['ReceiptNo']}}
            <br><span class="fw-bolder">Transaction Date:</span>&nbsp;{{$data['TransactionDate']}}
            <br><span class="fw-bolder">Sender Name:</span>&nbsp;{{$data['SenderName']}}
            <br><span class="fw-bolder">Sender Mobile:</span>&nbsp;+91-{{$data['SenderMobile']}}
            <br><span class="fw-bolder">Bank Name:</span>&nbsp;{{$data['BankName']}}
        </div>
        </div>
        <div class="col-md-6 text-end">
        <div class="fw-bold fs-5 text-gray-600">
            <br><span class="fw-bolder">Benificiery Name:</span>&nbsp;{{$data['BenificieryName']}}&nbsp;&nbsp;
            <br><span class="fw-bolder">Account Number:</span>&nbsp;{{$data['BenificieryAccount']}}
            <br/><span class="fw-bolder">IFSC Code:</span>&nbsp;IFSC201301&nbsp;
            <br><span class="fw-bolder">Type:</span>&nbsp;{{$data['BenificieryAccountType']}}
            <br><span class="fw-bolder">Transfer Mode:</span><span class="badge badge-light-info fs-5 fw-bolder">{{$data['TransferMode']}}</span> 
        </div>
        </div>
        </div>
<div class="table-responsive mt-10">
 <table class="table table-striped gy-5 gs-5" >
  <thead>
   <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 bg-light-primary">
    <th class="min-w-100px text-start">Bank Name</th>
    <th class="min-w-100px text-start">Date & time</th>
    <th class="min-w-100px text-start">Txt ID</th>
    <th class="min-w-100px text-start">Ref Number</th>
    <th class="min-w-100px text-start">UTR</th>
    <th class="min-w-100px text-start">Mode</th>
    <th class="min-w-100px text-start">Status</th>
    <th class="min-w-100px  text-center">Amount</th>
   </tr>
  </thead>
  <tbody>
   <tr class="fw-bolder fs-6">
   <td class="text-start"><img src="{{$data['BankIcon']}}" height="30px" width="30px" title="" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="right" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-original-title="{{$data['BankName']}}">&nbsp;{{$data['BankName']}}</td>
   <td class="text-start">{{$data['TransactionDate']}}</td>
    <td class="text-start">{{$data['TransfersReferenceId']}}</td>
    <td class="text-start">{{$data['RefNumber']}}</td>
    <td class="text-start">{{$data['UTR']}}</td>
    <td class="text-start">{{$data['TransferMode']}}</td>
    <td class="text-start"><span class="badge badge-light-{{$class}} me-10 fs-4 fw-bolder">{{$data['Status']}}</span></td>
    <td class="text-end fw-bolder fs-2">₹{{$data['Amount']}}</td>
   </tr>
   <tr class="fw-bolder fs-5">
    <td colspan="7" class="text-end">Convenience Fee</td>
    <td class="text-end fw-bolder">₹{{$data['ConvenienceFee']}}</td>
   </tr>
   <tr class="fw-bolder fs-5">
   <td colspan="6" class="text-start"><span class="fw-bolder text-gray-700">Amount in words:&nbsp;&nbsp;</span>{{UcWords(AmountToWords($data['Total']))}}</td>
   <td class="text-end">Total</td>
    <td class="text-end fw-bolder fs-2">₹{{number_format($data['Total'],2)}}</td>
   </tr>
   
  </tbody>
 </table>
</div>
            
</div>
    
    <div class="ribbon ribbon-triangle ribbon-bottom-start border-{{$class}}">
        <!--begin::Ribbon icon-->
        <div class="ribbon-icon mt-0 ms-n6">
            @if($class=='success')
            <i class="bi bi-check2 fs-2 text-white"></i>
            @elseif( $class=='info')
            <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr059.svg-->
            <span class="svg-icon svg-icon-white svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M21 22H12C11.4 22 11 21.6 11 21V3C11 2.4 11.4 2 12 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22Z" fill="currentColor"/>
                    <path d="M19 11H6.60001V13H19C19.6 13 20 12.6 20 12C20 11.4 19.6 11 19 11Z" fill="currentColor"/>
                    <path opacity="0.3" d="M6.6 17L2.3 12.7C1.9 12.3 1.9 11.7 2.3 11.3L6.6 7V17Z" fill="currentColor"/>
                </svg>
            </span>
            <!--end::Svg Icon-->
            @elseif($class=='danger')
            <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr015.svg-->
            <span class="svg-icon svg-icon-white svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M12 10.6L14.8 7.8C15.2 7.4 15.8 7.4 16.2 7.8C16.6 8.2 16.6 8.80002 16.2 9.20002L13.4 12L12 10.6ZM10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 8.99999 16.4 9.19999 16.2L12 13.4L10.6 12Z" fill="currentColor"/>
                    <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM13.4 12L16.2 9.20001C16.6 8.80001 16.6 8.19999 16.2 7.79999C15.8 7.39999 15.2 7.39999 14.8 7.79999L12 10.6L9.2 7.79999C8.8 7.39999 8.2 7.39999 7.8 7.79999C7.4 8.19999 7.4 8.80001 7.8 9.20001L10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 9 16.4 9.2 16.2L12 13.4L14.8 16.2C15 16.4 15.3 16.5 15.5 16.5C15.7 16.5 16 16.4 16.2 16.2C16.6 15.8 16.6 15.2 16.2 14.8L13.4 12Z" fill="currentColor"/>
                </svg>
            </span>
            <!--end::Svg Icon-->
            @elseif($class=='warning')
            <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr015.svg-->
            <span class="svg-icon svg-icon-white svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/>
                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/>
                </svg>
            </span>
            <!--end::Svg Icon-->
            @else
            <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr015.svg-->
            <span class="svg-icon svg-icon-white svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M12 10.6L14.8 7.8C15.2 7.4 15.8 7.4 16.2 7.8C16.6 8.2 16.6 8.80002 16.2 9.20002L13.4 12L12 10.6ZM10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 8.99999 16.4 9.19999 16.2L12 13.4L10.6 12Z" fill="currentColor"/>
                    <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM13.4 12L16.2 9.20001C16.6 8.80001 16.6 8.19999 16.2 7.79999C15.8 7.39999 15.2 7.39999 14.8 7.79999L12 10.6L9.2 7.79999C8.8 7.39999 8.2 7.39999 7.8 7.79999C7.4 8.19999 7.4 8.80001 7.8 9.20001L10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 9 16.4 9.2 16.2L12 13.4L14.8 16.2C15 16.4 15.3 16.5 15.5 16.5C15.7 16.5 16 16.4 16.2 16.2C16.6 15.8 16.6 15.2 16.2 14.8L13.4 12Z" fill="currentColor"/>
                </svg>
            </span>
            <!--end::Svg Icon-->
            @endif
         
          
        </div>
        <!--end::Ribbon icon-->
    </div>

    <div class="card-footer">
    <div class="text-center fs-8">
        {{env('APP_FULL_NAME')}}. All Rights Reserved<br>
        This is system generated receipt.Hence no seals or signature is required.
    </div>
        
    </div>
</div>

</div>
<div class="text-end mt-5">
<button onclick="captureSection()" class="btn btn-sm btn-success"><i class="fonticon-share"></i>&nbsp;Share On Whatsapp</button>
<button onclick="captureAndDownloadSection()" class="btn btn-sm btn-primary">
<!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr044.svg-->
<span class="svg-icon svg-icon-white svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path d="M21 22H3C2.4 22 2 21.6 2 21C2 20.4 2.4 20 3 20H21C21.6 20 22 20.4 22 21C22 21.6 21.6 22 21 22ZM13 13.4V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V13.4H13Z" fill="currentColor"/>
<path opacity="0.3" d="M7 13.4H17L12.7 17.7C12.3 18.1 11.7 18.1 11.3 17.7L7 13.4Z" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->
Download ScreenShot</button>

<button id="capture-button" class="btn btn-sm btn-danger">
<!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr044.svg-->
<span class="svg-icon svg-icon-white svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path d="M21 22H3C2.4 22 2 21.6 2 21C2 20.4 2.4 20 3 20H21C21.6 20 22 20.4 22 21C22 21.6 21.6 22 21 22ZM13 13.4V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V13.4H13Z" fill="currentColor"/>
<path opacity="0.3" d="M7 13.4H17L12.7 17.7C12.3 18.1 11.7 18.1 11.3 17.7L7 13.4Z" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->
Download PDF</button>
</div>

@endsection
               
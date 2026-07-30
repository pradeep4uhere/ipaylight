@extends('layouts.default')
@section('content')
<?php date_default_timezone_set('Asia/Kolkata'); ?>
<style>html,body { padding: 0; margin:0; }</style>
<div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7;">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;margin:0 auto; padding:0; max-width:600px">
		<tbody>
			<tr>
				<td align="center" valign="center" style="text-align:center; padding: 40px">
					<a href="{{env('APP_URL')}}" rel="noopener" target="_blank">
						<img alt="Logo" src="{{env('LOGO_URL')}}" height="60px" />
					</a>
				</td>
			</tr>
			<tr>
				<td align="left" valign="center">
					<div style="text-align:left; margin: 0 00px; padding: 40px; background-color:#ffffff; border-radius: 6px;  border-top:solid 5px #22a400">
						<!--begin:Email content-->
						<div style="padding-bottom: 30px; font-size: 17px;">
							<strong>Hello {{ $CustomerName }}, </strong>
						</div>
						<div style="padding-bottom: 10px; margin-bottom:10px">Your wallet payment for {{env('APP_NAME')}} with ID <span style="color:black; font-weight:bold">{{$TransactionNumber}}</span> Successfully completed.  <strong></div>
                        <div style="padding-bottom: 10px; margin-bottom:10px">₹ {{$Amount}}</strong> amount has been debited from your wallet on {{$DateCreated}}</div>
                        <div class="table-responsive">
                         <table align="center" border="0" cellpadding="5" cellspacing="0" width="100%" style="border-collapse:collapse;margin:0 auto; padding:0; max-width:600px">
                                <!--begin::Table body-->
                                <tbody class="border-bottom border-dashed">
                                 <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start fs-6 fw-bolder" colspan="2">
                                        <div style="font-size: 15px; font-weight:bold">
                                            <div class="fw-bolder fs-2 text-center">Transaction Status</div>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">Amount</td>  
                                        <td class="fs-5"><strong>Rs. {{$Amount}}</strong></td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">Status</td>  
                                        <?php if($TransactionStatus=='Success'){ $color ="red";}  ?>    
                                        <?php if($TransactionStatus=='Reversal'){ $color ="red";}  ?>    
                                        <?php if($TransactionStatus=='Pending'){ $color ="red";}  ?>  
                                        <td class="fw-bold fs-5" style="color:{{$color}}; font-weight:bold">{{$TransactionStatus}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-5 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">Reference Number</td>  
                                        <td class="fw-bolder fs-5">{{$TransactionNumber}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-5 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">Oppenn Balance</td>  
                                        <td class="fw-bolder fs-5">Rs. {{$OppennBalance}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-5 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">Close Balance</td>  
                                        <td class="fw-bolder fs-5">Rs. {{$CloseBalane}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-5 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">Payment Remarks</td>  
                                        <td class="fw-bolder fs-5">{{$PaymentRemark}}</td>
                                    </tr>
                                    <tr class="fw-semibold text-gray-800 text-center">  
                                        <td class="text-center ps-2 fs-4"colspan="3">Transaction was made on {{$DateCreated}}</td>
                                    </tr>
                                   
                                    <tr>
                                        <td colspan="3">
                                        <div style="padding-bottom: 1px" class="text-mute fs-7 mt-0">
                                        Thanks for using {{env('APP_NAME')}}!</br></br>
                                        Kind Regards,
                                        <br>{{env('APP_NAME')}} Team.
                                        </div>
                                            </td>
                                        </tr>
                                  </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <br/>
                        <div class="text-start" style="font-size:12px">If you have any issue with the service from {{env('APP_NAME')}}, please raise your request here</div>
                        <table width="100%" class="align-middle">
						<tr>
							<td align="center" valign="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;">
								<p>{{env('APP_FULL_NAME')}}</p>
								<p>Copyright ©&nbsp;<a href="{{env('APP_URL')}}" rel="noopener" target="_blank">{{env('APP_NAME')}}</a>&nbsp;|&nbsp;{{env('APP_URL')}}&nbsp;|&nbsp;{{env('APP_SUPPORT_EMAIL')}}</p>
							</td>
						</tr>
                        </table>
						<!--end:Email content-->
						
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>

@endsection
                        
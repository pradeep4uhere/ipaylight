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
						<img alt="Logo" src="https://paygenius.in/black_logo.png" height="60px" />
					</a>
				</td>
			</tr>
			<tr>
				<td align="left" valign="center">
					<div style="text-align:left; margin: 0 00px; padding: 40px; background-color:#ffffff; border-radius: 6px;  border-top:solid 5px #22a400">
						<!--begin:Email content-->
						<div style="padding-bottom: 30px; font-size: 17px;">
							<strong>Hello {{ $customername }}, </strong>
						</div>
						<div style="padding-bottom: 10px; margin-bottom:10px"> <strong>₹ {{$Amount}}</strong> amount has been successfully settled to your bank account on {{$DateCreated}}</div>
                        <div class="table-responsive">
                            <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" cellpadding="5" cellspacing="0" style="font-size:14px" border="1" width="100%" >
                                <!--begin::Table body-->
                                <tbody class="border-bottom border-dashed">
                                 <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start fs-6 fw-bolder" colspan="2">
                                        <div style="font-size: 15px; font-weight:bold">
                                            <div class="fw-bolder fs-2 text-center">Settlement Details</div>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">Settlement Id</td>  
                                        <td class="fs-5">{{$SettalmentID}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">Amount Settled</td>  
                                        <td class="fs-5"><strong>₹ {{$Amount}}</strong></td>
                                    </tr>
                                    
                                    <tr class="fw-semibold fs-5 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">Reference Number</td>  
                                        <td class="fw-bolder fs-5">{{$ReferenceNumber}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-5 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-5">UTR</td>  
                                        <td class="fw-bolder fs-5">{{$UTR}}</td>
                                    </tr>
                                   
                                    <tr class="fw-semibold text-gray-800 text-center">  
                                        <td class="text-center ps-2 fs-4"colspan="3">Settlement was made on {{$DateCreated}}</td>
                                    </tr>
                                  </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <br/>
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" cellpadding="5" cellspacing="0" style="font-size:14px" border="1" width="100%" >
                                <!--begin::Table body-->
                                <tbody class="border-bottom border-dashed">
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start fs-6 fw-bolder" colspan="5">
                                        <div style="font-size: 15px; font-weight:bold">
                                            <div class="fw-bolder fs-2 text-center">Breakup for Settlement</div>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Component</td>  
                                        <td class="text-center ps-2 fs-6">Amount</td>  
                                        <td class="text-center ps-2 fs-6">Tax</td>  
                                        <td class="text-center ps-2 fs-6">Fee</td>  
                                        <td class="text-end ps-2 fs-6">Settled Amount</td>  
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start">Payment</td>  
                                        <td class="text-center">₹ {{$Amount}}</td>
                                        <td class="text-center">₹ {{$Tax}}</td>
                                        <td class="text-center">₹ {{$Fee}}</td>
                                        <td class="text-end">₹ {{$Amount}}</td>
                                    </tr>
                                  </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                            <table width="100%" class="align-middle">
                            <tr>
                                <td align="center" style="font-size:14px;padding-top:24px;padding-right:48px;padding-bottom:24px;padding-left:48px" valign="middle">
                                <a href="{{env('APP_URL')}}/ro/settalment" rel="noopener" style="text-decoration:none;display:inline-block;text-align:center;padding:0.75575rem 1.3rem;font-size:0.925rem;line-height:1.5;border-radius:0.35rem;color:#ffffff;background-color:#009EF7;border:0px;margin-right:0.75rem!important;font-weight:600!important;outline:none!important;vertical-align:middle" target="_blank">View Settalment</a>
                                </td>
                            </tr>
                            </table>
                        </div>
                        <div class="text-start" style="font-size:12px">If you have any issue with the service from Razorpay, please raise your request here</div>
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
                        
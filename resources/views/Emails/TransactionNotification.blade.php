@extends('layouts.default')
@section('content')

<style>html,body { padding: 0; margin:0; }</style>
<div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7">
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
					<div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
						<!--begin:Email content-->
						<div style="padding-bottom: 30px; font-size: 17px;">
							<strong>Hello {{$CustomerName}}!</strong>
						</div>
						<div style="padding-bottom: 30px">Your payment for {{env('APP_NAME')}} with ID <span style="font-weight:bold">{{$TransactionNumber}}</span> Successfully completed.</div>
						<div style="border-bottom: 1px solid #eeeeee; margin:10px 0"></div>
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" cellpadding="5" style="font-size:14px">
                                <!--begin::Table body-->
                                <tbody class="border-bottom border-dashed">
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Customer Name</td>                
                                        <td>:</td>
                                        <td>{{$CustomerName}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Customer Email</td>  
                                        <td>:</td>              
                                        <td>{{$CustomerEmail}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Customer Mobile</td>  
                                        <td>:</td>             
                                        <td>+91-{{$CustomerMobile}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Amount</td>  
                                        <td>:</td>              
                                        <td class="fw-bolder" style=" color:green; font-weight:bold">Rs. {{$Amount}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Payment Status</td>  
                                        <td>:</td>              
                                        <td class="fw-bolder" style=" color:green; font-weight:bold">{{$Status}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Transaction Number</td>  
                                        <td>:</td>              
                                        <td class="fw-bolder" style="color:black; font-weight:bold">{{$TransactionNumber}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Reference Number</td>  
                                        <td>:</td>              
                                        <td class="fw-bolder">{{$ReferenceNumber}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Payment Remark</td>  
                                        <td>:</td>              
                                        <td>{{$PaymentRemark}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Payment Gateway</td>  
                                        <td>:</td>              
                                        <td>{{$PaymentGateway}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Settalment Type</td>  
                                        <td>:</td>              
                                        <td>{{$SettalmentType}}</td>
                                    </tr>
                                    <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                        <td class="text-start ps-2 fs-6">Payment Date</td>  
                                        <td>:</td>              
                                        <td class="fw-bolder" style="font-weight:bold">{{$DateCreated}}</td>
                                    </tr>
                                   
                                  </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>

						<div style="padding-bottom: 50px; word-wrap: break-all;">
							<p style="margin-bottom: 10px;">
                                <div class="text-center mt-5 fs-8" style="font-size:10px">
                                {{env('APP_NAME')}} is an intermediary payment service provider and is nowhere responsible for any product or service. We facilitate payment collection to merchants whose correspondence has been mentioned above. Please write to us on {{env('APP_SUPPORT_EMAIL')}} in case of any issues or doubts. Our terms of use is mentioned here - <a href="{{env('APP_URL')}}/termsandconditions">{{env('APP_URL')}}/termsandconditions</a>
                                </div>
                                <div class="text-center mt-5 fs-8" style="font-size:10px">
                                {{env('APP_NAME')}}. All Rights Reserved</br/>
                                This is system generated receipt.Hence no seals or signature is required.
                            </div>
                            </p>
						</div>
						<!--end:Email content-->
						<div style="padding-bottom: 10px">Kind regards,
						<br>{{env('APP_NAME')}}
						<tr>
							<td align="center" valign="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;">
                                <p>{{env('APP_FULL_NAME')}}</p>
								<p>Copyright ©&nbsp;<a href="{{env('APP_URL')}}" rel="noopener" target="_blank">{{env('APP_NAME')}}</a>&nbsp;|&nbsp;{{env('APP_URL')}}&nbsp;|&nbsp;{{env('APP_SUPPORT_EMAIL')}}</p>
							</td>
						</tr></br></div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>

@endsection
                        
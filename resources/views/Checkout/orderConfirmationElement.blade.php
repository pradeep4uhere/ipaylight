<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="{{env('APP_URL')}}" class="mb-5">
                    <img alt="Logo" src="logo.svg" class="h-50px" />
					</a>
                    <div class="fw-bold fs-7 text-gray-600 mb-5">Please confirm your filled details before making payment.</div>
    
					<!--end::Logo-->
					<!--begin::Wrapper-->
                    
					<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 text-center border-0 bg-light">                       
                                          <th class="min-w-140px fw-bolder" colspan="3"><span class="fw-bolder fs-4">Payment Confirmation</span></th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->

                                    <!--begin::Table body-->
                                    <tbody class="border-bottom border-dashed">
                                        <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                            <td class="text-start ps-6 fs-6">Customer Name</td>                
                                            <td>:</td>
                                            <td>{{$checkoutDetails['customer_name']}}</td>
                                        </tr>
                                        <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                            <td class="text-start ps-6 fs-6">Customer Email</td>  
                                            <td>:</td>              
                                            <td>{{$checkoutDetails['customer_email']}}</td>
                                        </tr>
                                        <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                            <td class="text-start ps-6 fs-6">Customer Mobile</td>  
                                            <td>:</td>             
                                            <td>+91-{{$checkoutDetails['customer_mobile']}}</td>
                                        </tr>
                                        <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                            <td class="text-start ps-6 fs-6">Amount</td>  
                                            <td>:</td>              
                                            <td class="fw-bolder">Rs. {{number_format($checkoutDetails['amount'],2)}}</td>
                                        </tr>
                                        <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                            <td class="text-start ps-6 fs-6">Payment Remark</td>  
                                            <td>:</td>              
                                            <td>Advance Payment For Card Rodation</td>
                                        </tr>
                                        <tr class="fw-semibold fs-6 text-gray-800 text-start">  
                                            <td class="text-start ps-6 fs-6">Payment Gateway</td>  
                                            <td>:</td>              
                                            <td>{{$checkoutDetails['gateway_name']}}</td>
                                        </tr>
                                        <tr class="fw-semibold fs-6 text-gray-800 text-start" style="display:none">  
                                            <td class="text-start ps-6 fs-6">Settalment Type</td>  
                                            <td>:</td>              
                                            <td><?php 
                                            if($checkoutDetails['payemnt_type']=='IN'){ echo "Same Day";}
                                            if($checkoutDetails['payemnt_type']=='ND'){ echo "Next Day";}
                                            if($checkoutDetails['payemnt_type']=='NW'){ echo "Next WeeK";}
                                            ?></td>
                                        </tr>
                                      </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->	 
                            <button id="make_payment_button" class="btn btn-lg btn-primary w-100 mb-5">Make Payment&nbsp;{{$checkoutDetails['amount']}}</button>
                        </div>
                         
                    </div>
                </div>
            </div>
</div>
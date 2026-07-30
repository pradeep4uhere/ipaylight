@extends('Admin.layouts.Admin.dashboard')
@section('content')
<style>
.form-floating .form-select {
     padding-top: 1rem;
}
</style>

<div class="card  mb-xl-10">
<div class="card-body p-5 pb-5">
<div class="card-header border-0">
				<!--begin::Card title-->
                <form action="{{route('admin.profile_addcommission',['user'=>Crypt::encryptString($userProfile->id)])}}" method="post">
				@csrf
				<div class="card-title">
                <div class="row ">
                <!--begin::Col-->
                <div class="col-sm-6 col-md-3 mb-10 mb-sm-0">
                <div class="d-flex align-items-left  my-1">
						<input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px" placeholder="Enter Distributor Code" value="{{$userProfile->agent_code}}" name="agent_code">
					</div>
                </div>
                <div class="col-sm-6 col-md-3  mb-10 mb-sm-0">
                <div class="d-flex align-items-left position-relative my-1 mx-5">
						<input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px" placeholder="Enter Mobile Number">
				</div>
                </div>
                <div class="col-sm-6 col-md-3  mb-10 mb-sm-0">
                <div class="d-flex align-items-left position-relative my-1 mx-5">
                         {!!$paymentGatewayList!!}
                </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-10 mb-sm-0">
                <div class="d-flex align-items-left position-relative my-1 mx-5">
             	    <button type="submit" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Search Distributor</button>
    			</div>
                </div>
                </div>
				</div>
			</div>  
            </form>
   
</div>

</div>
<?php if($userProfile->role == 'retailer'){ ?>
@include('Retailer.Profile.ProfileHeaderSummery')
<?php  }elseif ($userProfile->role == ('distributor' || 'superdistributor')) {?>
    @include('Distributor.Profile.ProfileHeaderSummery')
<?php }else{ ?>
<?php } ?>
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
            <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            
            <!--end::Col-->
            <!--begin::Col-->
            @if(!empty($gatewayDetails))
            <div class="row">
                <form action="{{route('admin.save_payment_type_to_profile',['user'=>Crypt::encryptString($userProfile->id)])}}" method="post">
                @csrf
                <!--begin::Col-->
                <div class="col-lg-12 form-floating">
                <div class="mb-2 fv-row">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack">
                        <!--begin::Label-->
                        <div class="fw-bold me-5 py-10">
                            <label class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Add Gateway To {{$userProfile->role}} - {{$userProfile->name}}[{{$userProfile->agent_code}}]</label>
                            <img src="{{ asset('assets/media/cards/' . getPaymentGatewayIcon($gatewayDetails['gateway_name']))}}" width="100px" height="50px" />
                            <div class="fs-7 text-muted">Allow Payment Type Accepted By {{$gatewayDetails['gateway_name']}} Gateways</div>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <input type="hidden" name="gateway_id" Value="{{$gatewayDetails['id']}}"/>
                            <input type="hidden" name="gateway_name" Value="{{$gatewayDetails['gateway_name']}}"/>
                            <button type="submit" class="btn btn-primary" data-kt-customer-table-select="delete_selected">Save Commission Setings</button>
                            <!--end::Toolbar-->
                            
                        </div>
                    </div>
                    <!--end::Wrapper-->
                    
                </div>
                
                <div>
                <div class="col-lg-6">
               
                <table class="table align-middle table-row-dashed fs-7 gy-5">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-250px">Payment Type</th>
                                        <th class="min-w-125px text-center">Base Rate</th>
                                        <th class="min-w-125px text-center">DS Base Rate</th>
                                        <th class="min-w-125px text-center">ND Base Rate</th>
                                        <th class="min-w-125px text-center">NW Base Rate</th>
                                        <th class="min-w-125px text-center">Rate Type</th>
                                        <th class="min-w-125px text-center">Action</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <tbody>
                                    <?php if($gatewayDetails->PaymentGatewayRate()->exists()) { ?>
                                    <?php foreach($gatewayDetails['PaymentGatewayRate'] as $k=>$item){ //dd($item); ?> 
                                    <tr>
                                    
                                    <td>
                                    <div class="fw-bold me-5">
                                        <label class="form-check form-check-custom form-check-solid">
                                        &nbsp;<img src="{{ asset('assets/media/cards/' . getPaymentTypeIcon($item['payment_type'])) }}" width="60px" />
                                        <span class="form-check-label fw-bold">{{$item['payment_type']}}</span>
                                    </label>
                                    </div>
                                    </td>
                                    
                                        <td>
                                        <div class="d-flex">
                                            <div class="fw-bold me-5">
                                                <input type="number" step="0.01" inputmode="decimal" maxlength="4" class="form-control form-control-solid {{($item['rate']=='0.00')? 'border-danger bg-light-danger': 'border-success bg-light-success'}} " id="kt_inputmask_6" name="base_payment_type_value[{{$item['payment_type']}}]" value="{{$item['rate']}}"  placeholder="2.5" readonly/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="fw-bold me-5">
                                                <input type="number" step="0.01" inputmode="decimal" maxlength="4" class="form-control form-control-solid text-center" id="kt_inputmask_7" name="payment_type_value[{{$item['payment_type']}}]" value="{{getPaymentSettingRate($userPaymentTypeList, $item['payment_type'], 'rate',$item['rate'])}}"  placeholder="2.5"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="fw-bold me-5">
                                                <input type="number" step="0.01" inputmode="decimal" maxlength="4" class="form-control form-control-solid text-center" id="kt_inputmask_8" name="next_day_payment_type_value[{{$item['payment_type']}}]" value="{{getPaymentSettingRate($userPaymentTypeList, $item['payment_type'], 'next_day_rate',$item['rate'])}}"  placeholder="2.5"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="fw-bold me-5">
                                                <input type="number" step="0.01" inputmode="decimal" maxlength="4" class="form-control form-control-solid text-center" id="kt_inputmask_9" name="next_week_payment_type_value[{{$item['payment_type']}}]" value="{{getPaymentSettingRate($userPaymentTypeList, $item['payment_type'], 'next_week_rate',$item['rate'])}}"  placeholder="2.5"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <select name="payment_rate_type[{{$item['payment_type']}}]" aria-label="Select Rate Type" data-control="select2" class="form-select form-select-solid" readonly>
                                            <option value="Percentage" <?php if($item['rate_type']=='Percentage'){ ?> selected <?php } ?>>Percentage</option>
                                            <option value="Flat" <?php if($item['rate_type']=='Flat'){ ?> selected <?php } ?>>Flat</option>
                                        </select>
                                
                                    </td>
                                    <td>
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" name="payment_type_status[{{$item['payment_type']}}]"  value="1" <?php if($item['is_active']=='1'){ ?> checked <?php } ?>>
                                            <span class="form-check-label fw-bold text-muted">Allowed</span>
                                        </label>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php } ?>
                                </tbody>
                    </table>
                </div>
                
                

                <!--end::Col-->
                <!--begin::Col-->
                
                <!--end::Col-->


                </div>
                </form>
            </div>
            @else
            <div class="col-xl-12 mb-5 mb-xl-12">
                <!--begin::Engage widget 1-->
                <div class="card h-md-100">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column flex-center">
                        <!--begin::Heading-->
                        <div class="mb-2">
                            <!--begin::Title-->
                            <h1 class="fw-bold text-gray-800 text-center lh-lg">{{$pageTitle}}
                            <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-300px mh-280px my-5 my-lg-12" style="background-image:url('assets/media/svg/no_records.svg')"></div>
                            <a href="{{route('admin.profile_commission',['user'=>Crypt::encryptString($userProfile->id)])}}" class="btn btn-success  my-1 fs-5">View All Commission</a>
                            <a href="{{route('addgateway')}}" class="btn btn-primary  my-1 fs-5">Add Gateway Commission</a>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Links-->
                        <!--end::Links-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Engage widget 1-->
            </div>
            @endif
                        
            <!--end::Col-->
        </div>
        </div>
        </div>
       
<!--end::Wrapper-->
@endsection
                        
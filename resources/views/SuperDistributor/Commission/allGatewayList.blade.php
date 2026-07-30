@extends('SuperDistributor.layouts.SuperDistributor.dashboard')
@section('content')
<?php if($userProfile->role == 'retailer'){ ?>
@include('Retailer.Profile.ProfileHeaderSummery')
<?php  }?>
<?php if ($userProfile->role == ('distributor' || 'superdistributor')) {?>
    @include('Distributor.Profile.ProfileHeaderSummery')
<?php } ?>
        <!--begin::Navbar-->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-5 g-xl-9">
        <?php if(isset($userCommissionList)){ 
            foreach($userCommissionList as $k=>$item){ 
            $gateway_name = $item[0]['Gateway']['gateway_name'];
            //dd($item[0]['Gateway']);
        ?>

        <!--begin::Col-->
        <div class="col-md-4">
            <!--begin::Card-->
            <div class="card card-flush h-md-100">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                    <?php $iconName = getPaymentGatewayIcon($gateway_name);?>   
                        <p class="py-5 mb-0"> <img src="{{asset('assets/media/cards/'.$iconName)}}" width="100" height="35"></p>
                        <div class="card-toolbar">
                        <?php if($item[0]['Gateway']['gateway_active']==1){ ?>
                            <a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3">Active</a>
                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                    <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#50cd89"></path>
                                    <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
                                </svg>
                            </span>
                        <?php }else{ ?>
                            <a href="#" class="btn btn-sm btn-light-danger fw-bolder ms-2 fs-8 py-1 px-3">InActive</a>
                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#f1416c">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="#f1416c"></rect>
                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="#f1416c"></rect>
                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="#f1416c"></rect>
                            </svg>
                            </span>
                        <?php } ?>
                        </div>
                       
                        
                    </div>
                    
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-1">
                    <!--begin::Permissions-->
                    <div class="d-flex flex-column text-gray-600">
                   
                    <table class="table align-middle table-row-dashed fs-6 gy-2">
				    <tbody class="text-gray-600 fw-bold">
                    <tr>
                        <td class="text-gray-800">
                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                           Payment Type
                        </label>
                        <td>
                        <!--begin::Checkbox-->
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                            <span class="form-check-label" for="kt_roles_select_all">Rate</span>
                        </label>
                        <!--end::Checkbox-->
                    </td>
                    <td>
                        <!--begin::Checkbox-->
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                            <span class="form-check-label" for="kt_roles_select_all">NDay</span>
                        </label>
                        <!--end::Checkbox-->
                    </td>
                    <td>
                        <!--begin::Checkbox-->
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                            <span class="form-check-label" for="kt_roles_select_all">NWeek</span>
                        </label>
                        <!--end::Checkbox-->
                    </td>
                   
                   
                </tr>
                    <?php if(!empty($item)){ ?>
                    <?php foreach($item as $key=>$value){ ?>
                        <tr>
                            <td class="text-gray-800 fs-8">
                              
                                {{Str::replace("_"," ", $value['payment_type'])}}&nbsp;
                            </td>
                            <td>
                                <!--begin::Checkbox-->
                                <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                    <?php if($value['rate'] != '0.00' && $value['is_active']==1){ ?>
                                        <span class="badge badge-light-success fs-7 fw-bolder">{{($value['rate_type']=='Percentage')?'':'₹'}}&nbsp;{{$value['rate']}}&nbsp;{{($value['rate_type']=='Percentage')?'%':''}}</span>
                                    <?php }else{ ?>    
                                    <span class="badge badge-light-danger fs-7 fw-bolder" for="kt_roles_select_all">{{($value['rate_type']=='Percentage')?'':'₹'}}&nbsp;{{$value['rate']}}&nbsp;{{($value['rate_type']=='Percentage')?'%':''}}</span>
                                    <?php } ?>
                                </label>
                                <!--end::Checkbox-->
                            </td>
                            <td>
                                <!--begin::Checkbox-->
                                <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                    <?php if($value['rate'] != '0.00' && $value['is_active']==1){ ?>
                                        <span class="badge badge-light-success fs-7 fw-bolder">{{($value['rate_type']=='Percentage')?'':'₹'}}&nbsp;{{$value['next_day_rate']}}&nbsp;{{($value['rate_type']=='Percentage')?'%':''}}</span>
                                    <?php }else{ ?>    
                                    <span class="badge badge-light-danger fs-7 fw-bolder" for="kt_roles_select_all">{{($value['rate_type']=='Percentage')?'':'₹'}}&nbsp;{{$value['next_day_rate']}}&nbsp;{{($value['rate_type']=='Percentage')?'%':''}}</span>
                                    <?php } ?>
                                </label>
                                <!--end::Checkbox-->
                            </td>
                            <td>
                                <!--begin::Checkbox-->
                                <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                    <?php if($value['rate'] != '0.00' && $value['is_active']==1){ ?>
                                        <span class="badge badge-light-success fs-7 fw-bolder">{{($value['rate_type']=='Percentage')?'':'₹'}}&nbsp;{{$value['next_week_rate']}}&nbsp;{{($value['rate_type']=='Percentage')?'%':''}}</span>
                                    <?php }else{ ?>    
                                    <span class="badge badge-light-danger fs-7 fw-bolder" for="kt_roles_select_all">{{($value['rate_type']=='Percentage')?'':'₹'}}&nbsp;{{$value['next_week_rate']}}&nbsp;{{($value['rate_type']=='Percentage')?'%':''}}</span>
                                    <?php } ?>
                                </label>
                                <!--end::Checkbox-->
                            </td>
                        </tr>
                    <?php }} ?>
                    
                    </tbody>
                    </table>
                    </div>
                    <!--end::Permissions-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer flex-wrap pt-0">
                    <table>
                    <tr>
                        <td>
                            <a href="{{route('sds.profile_addcommission',['user'=>Crypt::encryptString($userProfile->id), 'gatewayname'=>$gateway_name])}}" class="btn btn-primary btn-active-default my-1 fs-7">Edit Gateway</a>
                        </td>
                        <td>
                            <!-- <form action="{{route('admin.removeegateway')}}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{encryptString($userProfile->id)}}"/>
                                <input type="hidden" name="gateway_id" value="{{encryptString($k)}}"/>
                                <button type="submit"  class="btn btn-info btn-default my-1 fs-7">Remove Gateway</button>
                            </form> -->
                        </td>
                    </tr>
                    </table>
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Card-->
        </div>
        <?php }} ?>
									
        <!--begin::Add new card-->
        <div class="col-md-4 center">
            <!--begin::Card-->
            <div class="card h-md-100">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center">
                    <!--begin::Button-->
                    
                    <?php if($userProfile->role == 'retailer'){ ?>
                    <a  class="btn btn-clear d-flex flex-column flex-center" href="{{route('sds.retailer_addcommission', ['user'=>Crypt::encryptString($userProfile->id)])}}">
                    <?php }else{ ?>
                        <a  class="btn btn-clear d-flex flex-column flex-center" href="{{route('sds.profile_addcommission', ['user'=>Crypt::encryptString($userProfile->id)])}}">
                    <?php } ?>
                
                        <!--begin::Illustration-->
                        <img src="assets/media/svg/add_new.svg" alt="" >
                        <!--end::Illustration-->
                        <!--begin::Label-->
                        <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">Add New Gateway</div>
                        <!--end::Label-->
                    </a>
                    <!--begin::Button-->
                </div>
                <!--begin::Card body-->
            </div>
            <!--begin::Card-->
        </div>
        <!--begin::Add new card-->
    
<!--end::Wrapper-->
</div>
@endsection
                        
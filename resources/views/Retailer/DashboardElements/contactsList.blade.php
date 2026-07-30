 <!--begin::List Widget 2-->
 <div class="card card-xl-stretch">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 mt-4">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="fw-bolder mb-2 text-dark">{{getLocalText('latest_contacts')}}</span>
                                            <span class="text-muted fw-bold fs-7">{{getLocalText('new_contact_added')}}</span>
                                        </h3>
                                        </div>
                                        <div class="separator separator-dashed mb-7"></div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body pt-2">
                                        @if(!empty($dashboardItem['userContacts']))
										    @foreach($dashboardItem['userContacts'] as $item)
                                            <?php $array = ['warning','success','info','danger']; 
													$randomKey = array_rand($array); ?>
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center mb-7">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$item['first_name']}}&nbsp;{{$item['last_name']}}">
														<span class="symbol-label bg-light-{{$array[$randomKey]}} text-{{$array[$randomKey]}} fw-bolder fs-4">{{getFirstChar($item['first_name'])}}</span>
													</div>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Text-->
                                                <div class="flex-grow-1">
                                                    <a href="{{route('ro.view-contact',['id'=>encryptString($item['id'])])}}" class="text-dark fw-bolder text-hover-primary fs-6">{{$item['first_name']}}&nbsp;{{$item['last_name']}}</a>
                                                    <span class="text-muted d-block fw-bold">E:&nbsp;{{$item['email']}}</span>
                                                    <span class="text-muted d-block fw-bold">M:&nbsp;{{$item['mobile_number']}}&nbsp;|&nbsp;Status:&nbsp;{{$item['status']}}</span>
                                                    
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Item-->
                                            @endforeach
                                            @endif
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::List Widget 2-->
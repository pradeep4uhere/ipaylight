<div class="row g-5 g-xl-10">
<!--begin::Col-->
<div class="col-xl-8 mb-xl-8 col-md-8">
        <div class="card">
        <div class="card-header">
            <div class="card-title fs-3 fw-bolder">{{getLocalText('quick_payment_link')}}s</div>
            <div class="toolbars py-5">
            <a href="{{route('ds.generate-payment-link',['user'=>encryptUserProfileId($userProfile)])}}" class="btn btn-sm btn-primary fw-bolder fs-6">
            <span class="svg-icon svg-icon-3 m-0 toggle-off">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                </svg>
            </span>
            Generate New Link
            </a>
            </div>
        </div>
        <div class="card-body">
            @include('Distributor.Retailer.PaymentPage.LinkList')
        </div>
    </div>
</div>

<div class="col-xl-4 mb-xl-10">
@if($editPaymentLinkDetails)
<div class="card rounded border border-dashed border-gray-500">
@include('Distributor.Retailer.PaymentPage.EditLink')
</div>
@endif
</div>

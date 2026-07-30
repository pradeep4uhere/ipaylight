<form action="" method="post">
@csrf
<div class="row g-5 g-xl-8 mb-5">
<div class="col-xl-3  fs-6 fw-bolder">
<div class="mb-1">
    <label for="exampleFormControlInput1" class="required form-label">Choose Days</label>
    <input class="form-control form-control-solid" placeholder="Pick date rage" id="kt_daterangepicker_4" name="date_range"/>
</div>
</div>

<div class="col-xl-2  fs-6 fw-bolder">
<div class="mb-1">
    <label for="exampleFormControlInput1" class="required form-label">Settlement ID</label>
    <input type="text" class="form-control form-control-solid" name="settalment_id"/>
</div>
</div>
<div class="col-xl-2 fs-6 fw-bolder">

<div class="mb-1">
    <label for="exampleFormControlInput1" class="required form-label">UTR number</label>
    <input type="text" class="form-control form-control-solid" name="utr_number"/>
</div>
</div>
<div class="col-xl-2 fs-6 fw-bolder">
<div class="mb-1">
    <label for="exampleFormControlInput1" class="required form-label">Status</label>
    <select class="form-select form-select-solid" name="status" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
        <option></option>
        <option value="all">All</option>
        <option value="created">Created</option>
        <option value="Refunded">Initiated</option>
        <option value="Processing">Processed</option>
        <option value="Cancelled">Failed</option>
    </select>
</div>
</div>
<div class="col-xl-2 fs-6 fw-bolder">
<div class="mb-1">
    <label for="exampleFormControlInput1" class="form-label">&nbsp;</label>
    <input type="submit" class="form-control btn btn-primary" value="Search"/>
</div>
</div>
</div>
</form>

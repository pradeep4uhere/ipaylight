
<div class="table-responsive">
 <table class="table table-striped gy-2 gs-2">
  <tbody>
   <tr>
    <td class="fw-bold">Name</td>
    <td>{{$data['user']['name']}}</td>
   </tr>
   <tr>
    <td class="fw-bold">Mobile</td>
    <td>+91-{{$data['user']['mobile_number']}}</td>
   </tr>
   <tr>
    <td class="fw-bold">Monthly Limit</td>
    <td>₹ {{$data['user']['monthly_limit']}}</td>
   </tr>
   <tr>
    <td class="fw-bold">Balance Limit</td>
    <td>₹ {{$data['user']['balance_limit']}}</td>
   </tr>
   <tr>
    <td class="fw-bold">Status</td>
    <td>{{$data['user']['status']}}</td>
   </tr>
   <tr>
    <td>Is KYC</td>
    <td>{{$data['user']['kyc_status']}}</td>
   </tr>

  </tbody>
 </table>
</div>
</div>
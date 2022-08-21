@if(isset($data))
<p>Loan Type: @if($data->loan_type==1) Personal Loan @else Bussiness Loan @endif</p>
<p>Pan Number: {{$data->pan_no}}</p>
@endif
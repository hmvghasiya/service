@if(isset($data))
{{-- <p>Loan Type: @if($data->loan_type==1) Personal Loan @else Bussiness Loan @endif</p> --}}
<p>Bank Name: {{$data->bank_name}}</p>
<p>Account No: {{$data->account_no}}</p>
<p>Account No: {{$data->account_no}}</p>
<p>Ifsc No: {{$data->ifsc_code}}</p>
<p>Card No: {{$data->card_number}}</p>
@endif
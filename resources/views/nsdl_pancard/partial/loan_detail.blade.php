@if(isset($data))
<p>Application Type: @if($data->application_type==1) New Application @else Correction @endif</p>

@if($data->application_type==2)<p> Old Pan Number: {{$data->old_pan_no}}</p> @endif
@endif
@if(isset($data))
<p>Name: {{$data->name}} </p>
<p>Father Name: {{$data->father_name}} </p>
<p>Email: {{$data->email}} </p>
<p>Mobile: {{$data->mobile_no}} </p>
{{-- <p>LandLine Number: {{$data->landline_no}} </p> --}}
<p>DOB: {{$data->dob}} </p>

@if($data->rel_user != null)
<h5>User Detail</h5>
<p>User id: {{$data->rel_user->id}}</p>
<p>User Name{{$data->rel_user->name}}</p>
@endif
@endif
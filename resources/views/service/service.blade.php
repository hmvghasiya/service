@php
  

// Initializing key in some variable. You will receive this key from Eko via email
$key = "0d619438-954f-463d-950a-02a91ee95d54";

// Encode it using base64
$encodedKey = base64_encode($key);

// Get current timestamp in milliseconds since UNIX epoch as STRING
// Check out https://currentmillis.com to understand the timestamp format
$secret_key_timestamp = "".round(microtime(true) * 1000);

// Computes the signature by hashing the salt with the encoded key 
$signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);

// Encode it using base64
$secret_key = base64_encode($signature);



@endphp

@extends('layouts.app')
@section('title', "Aeps Service")
@section('pagetitle', "Aeps Service")
@php
    $table = "yes";
@endphp

@section('content')
<div class="content">
   @if(!$agent)
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Aeps Service Registration</h4>
                    </div>
                    
                </div>
            </div>
        </div>
    @elseif(!$serviceactive)    
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Service Activate</h4>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('serviceactivate')}}" method="post" id="fingkycForm" enctype="multipart/form-data"> 
                            {{ csrf_field() }}
                            
                            <input type="hidden" class="form-control" autocomplete="off" id="user_code" name="user_code" value="{{$user_code}}" >
                            <input type="hidden" class="form-control" autocomplete="off" id="bc_state" name="bc_state" value="{{$state}}" >
                            <input type="hidden" class="form-control" autocomplete="off" name="bc_city"  value="{{$city}}" required>
                            <input type="hidden" class="form-control" autocomplete="off" name="bc_pincode" value="{{$pincode}}"  required>
                            <input type="hidden" class="form-control" autocomplete="off" name="bc_address" placeholder="Enter Address" value="{{$address}}" required>
                            
                            
                             <div class="row">
                               <div class="form-group col-md-4">
                                    <label>Pancard Image </label>
                                    <input type="file" class="form-control" autocomplete="off" accept="image/x-png,image/gif,image/jpeg" name="pancardimg" placeholder="" required>
                                </div>
                                 <div class="form-group col-md-4">
                                    <label>Aadhaarcard Front Image </label>
                                    <input type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" autocomplete="off" name="aadhafront" placeholder="" required>
                                </div>
                                 <div class="form-group col-md-4">
                                    <label>Aadhaarcard Back Image </label>
                                    <input type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" autocomplete="off" name="aadharback" placeholder="" required>
                                </div>
                            </div>
                                <div class="form-group text-center">
                                <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Submitting"><b><i class=" icon-paperplane"></i></b> Activate</button>
                                </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
@else
@if($agent->status == "success")
    <div class="form-group text-center">
        <input type="hidden" class="form-control" autocomplete="off" id="user_code" name="user_code" value="{{$user_code}}"/>
     <button type="submit" onClick="doAeps()" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Submitting"><b><i class=" icon-paperplane"></i></b> Open AePS Gateway</button>
    </div> 
     @else
     <div class="form-group text-center">
        <h4 class="text-danger"> User Document varification process is {{$agent->status}} at Eko panel</h4>
        </div>
    @endif
@endif
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {

        $('.mydatepic').datepicker({
            'autoclose':true,
            'clearBtn':true,
            'todayHighlight':true,
            'format':'dd-mm-yyyy',
        });

        $('form#transactionForm').submit(function() {
            var form= $(this);
            var type = form.find('[name="type"]');
            $(this).ajaxSubmit({
                dataType:'json',
                beforeSubmit:function(){
                    swal({
                        title: 'Wait!',
                        text: 'We are working on request.',
                        onOpen: () => {
                            swal.showLoading()
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    });
                },
                success:function(data){
                    swal.close();
                    
                    switch(data.statuscode){
                        case 'TXN':
                           
                            swal({
                                title:'Suceess', 
                                text : data.message, 
                                type : 'success',
                                onClose: () => {
                                    window.location.reload();
                                }
                            });
                            break;
                        case 'TXF':
                            notify(data.message, 'danger');
                            break;    
                        
                        default:
                            notify(data.message, 'danger');
                            break;
                    }
                },
                error: function(errors) {
                   
                    swal.close();
                    if(errors.status == '400'){
                        notify(errors.responseJSON.message, 'danger');
                    }else{
                        swal(
                          'Oops!',
                          'Something went wrong, try again later.',
                          'error'
                        );
                    }
                }
            });
            return false;
        });
        
         $('form#fingkycForm').submit(function() {
            var form= $(this);
            var type = form.find('[name="type"]');
            $(this).ajaxSubmit({
                dataType:'json',
                beforeSubmit:function(){
                    swal({
                        title: 'Wait!',
                        text: 'We are working on request.',
                        onOpen: () => {
                            swal.showLoading()
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    });
                },
                success:function(data){
                    swal.close();
                    
                    switch(data.statuscode){
                        case 'TXN':
                           
                            swal({
                                title:'Suceess', 
                                text : data.message, 
                                type : 'success',
                                onClose: () => {
                                    window.location.reload();
                                }
                            });
                            break;
                        case 'TXF':
                            notify(data.message, 'danger');
                            break;    
                        
                        default:
                            notify(data.message, 'danger');
                            break;
                    }
                },
                error: function(errors) {
                   
                    swal.close();
                    if(errors.status == '400'){
                        notify(errors.responseJSON.message, 'danger');
                    }else{
                        swal(
                          'Oops!',
                          'Something went wrong, try again later.',
                          'error'
                        );
                    }
                }
            });
            return false;
        });
    });

    function getDistrict(ele){
        $.ajax({
            url:  "{{route('dmt1pay')}}",
            type: "POST",
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend:function(){
                swal({
                    title: 'Wait!',
                    text: 'We are fetching district.',
                    allowOutsideClick: () => !swal.isLoading(),
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            data: {'type':"getdistrict", 'stateid':$(ele).val()},
            success: function(data){
                swal.close();
                var out = `<option value="">Select District</option>`;
                $.each(data.message, function(index, value){
                    out += `<option value="`+value.districtid+`">`+value.districtname+`</option>`;
                });

                $('[name="bc_district"]').html(out);
            }
        });
    }
</script>
           <script>
           
			var aeps = new EkoAEPSGateway();
            var secret_key= "{{$secret_key}}";
            var secret_key_timestamp= "{{$secret_key_timestamp}}";
            const user_code = "{{$user_code}}";
           console.log(user_code);
			aeps.config({
					"partner_name": "KantaRam and Sons",
					"initiator_logo_url": "http://login.adharpe.com/public/logos/logo1.jpeg",
					"initiator_id": "7471112503",
					"developer_key": "23edcb2a5132ba03d342fa815487ac4a",
					"secret_key": secret_key,
					"secret_key_timestamp": secret_key_timestamp,
					"user_code": user_code
					
				});
            aeps.setCallbackURL('https://login.adharpe.com/api/ekoaeps/aeps/initiate');
			function doAeps() {
				aeps.open();
				console.log(aeps);
			}

		</script>
@endpush
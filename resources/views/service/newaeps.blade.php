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
<style>
    a {
    color: black;
    
}
</style>
<div class="content">
   @if(!$agent)
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Aeps Service Registration</h4>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('registration1')}}" method="post" id="transactionForm"> 
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-md-4">
                                    
                                    <label>Firstname </label>
                                    <input type="text" class="form-control" autocomplete="off" name="bc_f_name" placeholder="Enter Your Firstame" value="" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Lastname </label>
                                    <input type="text" class="form-control" name="bc_l_name" autocomplete="off" placeholder="Enter Your Lastname" value="" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email </label>
                                    <input type="email" class="form-control" autocomplete="off" name="emailid" placeholder="Enter Your Email" value="" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Mobile</label>
                                    <input type="text" pattern="[0-9]*" maxlength="10" minlength="10" class="form-control" name="phone1" autocomplete="off" placeholder="Enter Your Mobile" value="" required>
                                </div>
                               <div class="form-group col-md-4">
                                    <label>DOB </label>
                                    <input type="text" class="form-control mydatepic" autocomplete="off" name="bc_dob" placeholder="Enter Your DOB (DD-MM-YYYY)" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>State</label>
                                    <select name="bc_state" class="form-control select"  required>
                                        <option value="">Select State</option>
                                        @foreach ($mahastate as $state)
                                        <option value="{{$state->statename}}">{{$state->statename}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Address </label>
                                    <input type="text" class="form-control" autocomplete="off" name="bc_address" placeholder="Enter Your Address" value="" required>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>City</label>
                                    <input type="text" class="form-control" autocomplete="off" name="bc_city"  value="" placeholder="Enter Your City" required>
                                </div>
                                
                            </div>


                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Pincode </label>
                                    <input type="text" class="form-control" autocomplete="off" name="bc_pincode" placeholder="Enter Your Pincode" pattern="[0-9]*" value="" maxlength="6" minlength="6" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Pancard</label>
                                    <input type="text" class="form-control" name="bc_pan" autocomplete="off" placeholder="Enter Your Pancard" value="" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Shopname</label>
                                    <input type="text" class="form-control" autocomplete="off" name="shopname" value="" placeholder="Enter Your Shopname" required>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Submitting"><b><i class=" icon-paperplane"></i></b> Submit</button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    
@else
    <div class="form-group text-center">
      <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Submitting"><b><i class=" icon-paperplane"></i></b><a href="{{route('service')}}" style="font-color:black;" >Activate Your Service</a></button> 
     
    </div> 
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
           
@endpush
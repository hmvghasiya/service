@php
    $name = explode(" ", Auth::user()->name);
@endphp

@extends('layouts.app')
@section('title', "Aeps Service")
@section('pagetitle', "Aeps Service")
@php
    $table = "yes";
@endphp

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            
            @if(!$agent)
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Aeps Service Registration</h4>
                </div>
                <div class="panel-body">
                    <form action="{{route('aepstransaction')}}" method="post" id="transactionForm" enctype="multipart/form-data"> 
                        {{ csrf_field() }}
                        <input type="hidden" name="transactionType" value="kyc">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Firstname </label>
                                <input type="text" class="form-control" autocomplete="off" name="bc_f_name" placeholder="Enter Your Firstame" value="{{isset($name[0]) ? $name[0] : ''}}" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Lastname </label>
                                <input type="text" class="form-control" name="bc_l_name" autocomplete="off" placeholder="Enter Your Lastname" value="{{isset($name[1]) ? $name[1] : ''}}" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Email </label>
                                <input type="email" class="form-control" autocomplete="off" name="emailid" placeholder="Enter Your Email" value="{{Auth::user()->email}}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Mobile</label>
                                <input type="text" pattern="[0-9]*" maxlength="10" minlength="10" class="form-control" name="phone1" autocomplete="off" placeholder="Enter Your Mobile" value="{{Auth::user()->mobile}}" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>DOB </label>
                                <input type="text" class="form-control mydatepic" autocomplete="off" name="bc_dob" placeholder="Enter Your DOB (DD-MM-YYYY)" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>State</label>
                                <select name="bc_state" class="form-control select" required>
                                    <option value="">Select State</option>
                                    @foreach ($mahastate as $state)
                                    <option value="{{$state->statename}}">{{$state->statename}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>City</label>
                                <input type="text" class="form-control" autocomplete="off" name="bc_city"  value="{{Auth::user()->city}}" placeholder="Enter Your City" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Pincode </label>
                                <input type="text" class="form-control" autocomplete="off" name="bc_pincode" placeholder="Enter Your Pincode" pattern="[0-9]*" value="{{Auth::user()->pincode}}" maxlength="6" minlength="6" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Shopname</label>
                                <input type="text" class="form-control" autocomplete="off" name="shopname" value="{{Auth::user()->shopname}}" placeholder="Enter Your Shopname" required>
                            </div>
                        </div>
                        
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
                        
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Pancard</label>
                                <input type="text" class="form-control" name="bc_pan" autocomplete="off" placeholder="Enter Your Pancard" value="{{Auth::user()->pancard}}" required>
                            </div>
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Submitting"><b><i class=" icon-paperplane"></i></b> Submit</button>
                        </div>
                    </form>
                </div> 
            </div>
            @elseif($agent->bbps_id == 'notactivated')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Service Activate</h4>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('aepstransaction')}}" method="post" id="transactionForm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <input type="hidden" name="transactionType" value="service">
                            
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
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Aeps</h4>
                    </div>
                    <div class="panel-body p-0">
                        <table class="table table-bordered">
                            <tr><td>User ID</td><td>{{$agent->bc_id}}</td></tr>
                            <tr><td>Phone Number</td><td>{{$agent->phone1}}</td></tr>
                        </tbody></table>
                    </div>
                    <form action="{{route('aepstransaction')}}" method="get" target="_blank">
                        <input type="hidden" name="transactionType" value="initiate">
                        <div class="panel-footer text-center">
                            @if($agent->status == "pending")
                            <div class="panel-footer text-center text-danger">
                            Status Pending
                        </div>
                            @endif
                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Paying"><b><i class=" icon-paperplane"></i></b> Initiate Transaction</button>
                        </div>
                    </form>
                    @if(isset($error))
                        <div class="panel-footer text-center text-danger">
                            Error - {{$error}}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
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
                    console.log(type);
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
@extends('layouts.app')
@section('title', ucfirst($type).' Recharge')
@section('pagetitle', ucfirst($type).' Recharge')
@php
    $table = "yes";
@endphp

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ucfirst($type)}} Recharge</h4>
                </div>
                <form id="rechargeForm" action="{{route('rechargepay')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="{{$type}}">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>{{ucfirst($type)}} Number</label>
                            <input type="text" name="number" class="form-control" placeholder="Enter {{$type}} number" onchange="getOperator()" required="">
                        </div>

                        <div class="form-group">
                            <label>Mobile Operator</label>
                            <select name="provider_id" class="form-control select" required>
                                <option value="">Select Operator</option>
                                @foreach ($providers as $provider)
                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Recharge Amount</label>
                            <input type="text" name="amount" class="form-control" placeholder="Enter {{$type}} amount" required="">
                            <label class="label label-primary planlable btn-raised" onclick="getplan()">PLAN</label>
                        </div>
                        
                        <div class="">
                            <div class="form-group">
                            <label>T-Pin</label>
                            <input type="password" name="pin" class="form-control" placeholder="Enter transaction pin" required="">
                            <a href="{{url('profile/view?tab=pinChange')}}" target="_blank" class="text-primary pull-right">Generate Or Forgot Pin??</a>
                        </div>
                    </div>
                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Paying"><b><i class=" icon-paperplane"></i></b> Pay Now</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
					<h4 class="panel-title">Recent {{ucfirst($type)}} Recharge</h4>
				</div>
				<div class="panel-body">
				</div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Recharge Details</th>
                            <th>Amount/Commission</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="mplanModal" class="modal fade right" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-slate">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Recharge Plans</h6>
            </div>
            <div class="modal-body p-0 planData">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-raised legitRipple" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn bg-slate btn-raised legitRipple" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Submitting">Submit</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@push('script')
	<script type="text/javascript">
    $(document).ready(function () {
        var url = "{{url('statement/fetch')}}/rechargestatement/0";

        var onDraw = function() {};

        var options = [
            { "data" : "name",
                render:function(data, type, full, meta){
                    return `<div>
                            <span class=''>`+full.apiname +`</span><br>
                            <span class='text-inverse m-l-10'><b>`+full.id +`</b> </span>
                            <div class="clearfix"></div>
                        </div><span style='font-size:13px' class="pull=right">`+full.created_at+`</span>`;
                }
            },
            { "data" : "bank",
                render:function(data, type, full, meta){
                    return `Number - `+full.number+`<br>Operator - `+full.providername;
                }
            },
            { "data" : "bank",
                render:function(data, type, full, meta){
                    return `Amount - <i class="fa fa-inr"></i> `+full.amount+`<br>Profit - <i class="fa fa-inr"></i> `+full.profit;
                }
            },
            { "data" : "status",
                render:function(data, type, full, meta){
                    if(full.status == "success"){
                        var out = `<span class="label label-success">Success</span>`;
                    }else if(full.status == "pending"){
                        var out = `<span class="label label-warning">Pending</span>`;
                    }else if(full.status == "reversed"){
                        var out = `<span class="label bg-slate">Reversed</span>`;
                    }else{
                        var out = `<span class="label label-danger">Failed</span>`;
                    }
                    return out;
                }
            }
        ];

        datatableSetup(url, options, onDraw);

        $( "#rechargeForm" ).validate({
            rules: {
                provider_id: {
                    required: true,
                    number : true,
                },
                number: {
                    required: true,
                    number : true,
                    minlength: 8
                },
                amount: {
                    required: true,
                    number : true,
                    min: 10
                },
            },
            messages: {
                provider_id: {
                    required: "Please select {{$type}} operator",
                    number: "Operator id should be numeric",
                },
                number: {
                    required: "Please enter {{$type}} number",
                    number: "Mobile number should be numeric",
                    min: "Mobile number length should be atleast 8",
                },
                amount: {
                    required: "Please enter {{$type}} amount",
                    number: "Amount should be numeric",
                    min: "Min {{$type}} amount value rs 10",
                }
            },
            errorElement: "p",
            errorPlacement: function ( error, element ) {
                if ( element.prop("tagName").toLowerCase() === "select" ) {
                    error.insertAfter( element.closest( ".form-group" ).find(".select2") );
                } else {
                    error.insertAfter( element );
                }
            },
            submitHandler: function () {
                var form = $('#rechargeForm');
                var id = form.find('[name="id"]').val();
                form.ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button[type="submit"]').button('loading');
                    },
                    success:function(data){
                        form.find('button[type="submit"]').button('reset');
                        if(data.status == "success" || data.status == "pending"){
                            getbalance();
                            form[0].reset();
                            form.find('select').select2().val(null).trigger('change')
                            form.find('button[type="submit"]').button('reset');
                            notify("Recharge Successfully Submitted", 'success');
                            $('#datatable').dataTable().api().ajax.reload();
                        }else{
                            notify("Recharge "+data.status+ "! "+data.description, 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form);
                    }
                });
            }
        });
    });

    function getplan() {
        var operator = $('[name="provider_id"]').val();
        var number = $('[name="number"]').val();
        if(number != '' && operator != ''){
            $.ajax({
                url: '{{route("getplan")}}',
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {"operator" : operator, 'number' : number},
                beforeSend : function(){
                    swal({
                        title: 'Wait!',
                        text: 'Please wait, we are fetching commission details',
                        onOpen: () => {
                            swal.showLoading()
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    });
                }
            })
            .success(function(data) {
                swal.close();
                console.log(data);
                if(data.statuscode == "TXN"){
                    // var tabdata = `<table class="table table-bordered table-striped">
                    //     <thead>
                    //         <tr>
                    //             <th width="150px">Plan Type</th>
                    //             <th width="150px">Amount</th>
                    //             <th width="150px">Validity</th>
                    //             <th>Description</th>
                    //         </tr>
                    //     </thead>

                    //     <tbody>`;
                    // var plandata = ``;
                    // $.each(data.data, function(index, value) {
                    //     plandata += `<tr><td>`+value.recharge_short_description+`</td><td><button class="btn btn-xs btn-primary" onclick="setAmount('`+value.recharge_value+`')" style="width: 70px;padding:2px 0px;font-size: 15px;"><i class="fa fa-inr"></i> `+value.recharge_value+`</button></td><td>`+value.recharge_validity+`</td><td>`+value.recharge_description+`</td>
                    //                 </tr>`;
                    // });
                    // tabdata += plandata+`</tbody>
                    //         </table>`;

                    // $('.planData').html(tabdata);
                    // $('#planModal').modal();
                    
                    var head = `<ul class="nav nav-tabs nav-bordered nav-justified">`;
                                    var tabdata = ``;
                                    
                                    var count = 0;
                                    $.each(data.data, function(index, val) {
                                        count = count+1;
                                        if(count == "1"){
                                            var active = "active";
                                        }else{
                                            var active = "";
                                        }
                                        head += `<li class="`+active+`">
                                            <a href="#`+count+`-tab" data-toggle="tab" class="nav-link" aria-expanded="false">`+index+` Plan</a>
                                        </li>`;
                                        
                                        var plandata = ``;
                                        $.each(val, function(index, value) {
                                             @if($type == "mobile")
                                                plandata += `<tr><td><button class="btn btn-xs btn-primary" onclick="setAmount('`+value.rs+`')" style="width: 70px;padding:2px 0px;font-size: 15px;"><i class="fa fa-inr"></i> `+value.rs+`</button></td><td>`+value.validity+`</td><td>`+value.desc+`</td>
                                                    </tr>`;
                                            @else
                                                var rss = '';
                                                var validitys = '';
                                                $.each(value.rs, function( validity, rs) {
                                                    rss = rs;
                                                    validitys = validity;
                                                });
                                                
                                                plandata += `<tr><td><button class="btn btn-xs btn-primary" onclick="setAmount('`+rss+`')" style="width: 70px;padding:2px 0px;font-size: 15px;"><i class="fa fa-inr"></i> `+rss+`</button></td><td>`+validitys+`</td><td>`+value.desc+`</td>
                                                    </tr>`;
                                            @endif
                                        });

                                        tabdata += `<div class="tab-pane `+active+`" id="`+count+`-tab">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="150px">Amount</th>
                                                        <th width="150px">Validity</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    `+plandata+`
                                                </tbody>
                                            </table>
                                        </div>`;
                                    });
                                    head += '</ul>';

                                    var htmldata = head+`<div class="tab-content">
                                                `+tabdata+`
                                            </div>`;

                                    
                                    $('#mplanModal').find('.planData').html(htmldata);
                                    $('#mplanModal').modal();
                }else{
                    notify(data.message, 'warning');
                }
            })
            .fail(function() {
                swal.close();
                notify('Somthing went wrong', 'warning');
            });
        }else{
            notify('Mobile number and operator field required', 'warning');
        }
    }
    
    function setAmount(amount) {
        $("[name='amount']").val(amount);
        $('#planModal').modal('hide');
        $('#mplanModal').modal('hide');
    } 

    function getOperator() {
        var number = $('[name="number"]').val();
        if(number != ''){
            $.ajax({
                url: '{{route("getproviderInfo")}}',
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {"type" : "{{$type}}", 'number' : number},
                beforeSend : function(){
                    swal({
                        title: 'Wait!',
                        text: 'Please wait, we are fetching commission details',
                        onOpen: () => {
                            swal.showLoading()
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    });
                }
            })
            .success(function(data) {
                swal.close();
                console.log(data);
                if(data.statuscode == "TXN"){
                    $('[name="provider_id"]').val(data.provider_id).select2().trigger('change');
                }else{
                    notify(data.message, 'warning');
                }
            })
            .fail(function() {
                swal.close();
                notify('Somthing went wrong', 'warning');
            });
        }else{
            notify('Mobile number and operator field required', 'warning');
        }
    }
</script>
@endpush
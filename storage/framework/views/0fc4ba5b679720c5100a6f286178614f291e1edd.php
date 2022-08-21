
<?php $__env->startSection('title', "Aeps Fund Request"); ?>
<?php $__env->startSection('pagetitle',  "Aeps Fund Request"); ?>

<?php
    $table = "yes";
    $export = "aepsfundrequest";
    $status['type'] = "Fund";
    $status['data'] = [
        "success" => "Success",
        "pending" => "Pending",
        "failed" => "Failed",
        "approved" => "Approved",
        "rejected" => "Rejected",
    ];
?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Settlement Details</h4>
                </div>
                <table class="table table-bordered" id="datatable2">
                    <thead>
                        <tr>
                            <th>Settlement Time</th>
                            <th colspan="4">Settlement Charge</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>NEFT</th>
                            <th>IMPS Upto 1000</th>
                            <th></th>
                            <th>IMPS 25001 To 2Lac</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo nl2br($batch); ?></td>
                            <td><?php echo e($settlementcharge); ?> /- Rs</td>
                            <td><?php echo e($settlementcharge1k); ?> /- Rs</td>
                            <td><?php echo e($settlementcharge25k); ?> /- Rs</td>
                            <td><?php echo e($settlementcharge2l); ?> /- Rs</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Aeps Fund Request</h4>
                    <div class="heading-elements">
                        <button type="button" data-toggle="modal" data-target="#fundRequestModal" class="btn bg-slate btn-xs btn-labeled legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Searching"><b><i class="icon-plus2"></i></b> New Request</button>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th width="160px">#</th>
                            <th>User Details</th>
                            <th>Bank Details</th>
                            <th width="200px">Description</th>
                            <th>Remark</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="fundRequestModal" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-slate">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Wallet Fund Request</h6>
            </div>
            <form id="fundRequestForm" action="<?php echo e(route('fundtransaction')); ?>" method="post">
                <div class="modal-body">
                    <?php if(Auth::user()->bank != '' && Auth::user()->ifsc != '' && Auth::user()->account != ''): ?>
                        <table class="table table-bordered p-b-15" cellspacing="0" style="margin-bottom: 30px">
                            <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Bank</th>
                                    <th>Ifsc</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo e(Auth::user()->account); ?></td>
                                    <td><?php echo e(Auth::user()->bank); ?></td>
                                    <td><?php echo e(Auth::user()->ifsc); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <input type="hidden" name="user_id">
                    <?php echo e(csrf_field()); ?>

                    <?php if(Auth::user()->bank == '' && Auth::user()->ifsc == '' && Auth::user()->account == ''): ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Account Number</label>
                            <input type="text" class="form-control" name="account" placeholder="Enter Value" required="" value="<?php echo e(Auth::user()->account); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Ifsc Code</label>
                            <input type="text" class="form-control" name="ifsc" placeholder="Enter Value" required="" value="<?php echo e(Auth::user()->ifsc); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Bank Name</label>
                            <input type="text" class="form-control" name="bank" placeholder="Enter Value" required="" value="<?php echo e(Auth::user()->bank); ?>">
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <input type="hidden" name="type" value="bank"/>
                        <div class="form-group col-md-6">
                            <label>Amount</label>
                            <input type="number" class="form-control" name="amount" placeholder="Enter Value" required="">
                        </div>
                    </div>
                    <p class="text-danger">Note - If you want to change bank details, please send mail with account details to update your bank details.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-raised legitRipple" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn bg-slate btn-raised legitRipple" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Submitting">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable2').dataTable({
            dom: '<"datatable-scroll"t>',
            ordering: false,
        });

        var url = "<?php echo e(url('statement/fetch')); ?>/aepsfundrequest/0";
        var onDraw = function() {};
        var options = [
            { "data" : "name",
                render:function(data, type, full, meta){
                    var out = '';
                    if(full.api){
                        out +=  `<span class='myspan'>`+full.api.api_name +`</span><br>`;
                    }
                    out += `<span class='text-inverse'>`+full.id +`</span><br><span style='font-size:12px'>`+full.created_at+`</span>`;
                    return out;
                }
            },
            { "data" : "account",
                render:function(data, type, full, meta){
                    return full.user.name+`<br>`+full.user.mobile;
                }
            },
            { "data" : "bank",
                render:function(data, type, full, meta){
                    if(full.type == "wallet"){
                        return "Wallet"
                    }else{
                        return full.user.account +" ( "+full.user.bank+" )<br>"+full.user.ifsc;
                    }
                }
            },
            { "data" : "description",
                render:function(data, type, full, meta){
                    return `<span class='text-inverse'><i class="fa fa-rupee"></i> `+full.amount +`</span> / `+full.type;
                }
            },
            { "data" : "remark"},
            { 
                "data": "action",
                render:function(data, type, full, meta){
                    if(full.status == "approved"){
                        var btn = '<span class="label label-success text-uppercase"><b>'+full.status+'</b></span>';
                    }else if(full.status== 'pending'){
                        var btn = '<span class="label label-warning text-uppercase"><b>'+full.status+'</b></span>';
                    }else{
                        var btn = '<span class="label label-danger text-uppercase"><b>'+full.status+'</b></span>';
                    }
                    return btn;
                }
            }
        ];

        datatableSetup(url, options, onDraw);

        $( "#fundRequestForm").validate({
            rules: {
                amount: {
                    required: true
                },
                type: {
                    required: true
                },
            },
            messages: {
                amount: {
                    required: "Please enter request amount",
                },
                type: {
                    required: "Please select request type",
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
                var form = $('#fundRequestForm');
                form.ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button:submit').button('loading');
                    },
                    complete: function () {
                        form.find('button:submit').button('reset');
                    },
                    success:function(data){
                        if(data.status == "success"){
                            form.closest('.modal').modal('hide');
                            notify("Fund Request submitted Successfull", 'success');
                            $('#datatable').dataTable().api().ajax.reload();
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form);
                    }
                });
            }
        });
    });

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/finoviti/public_html/Reseller/nikatby.co.in/Reseller/login.kishalaypay.com/resources/views/fund/aeps.blade.php ENDPATH**/ ?>
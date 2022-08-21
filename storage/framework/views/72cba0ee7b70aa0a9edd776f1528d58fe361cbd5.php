<?php $__env->startSection('title', "Uti Pancard"); ?>
<?php $__env->startSection('pagetitle', "Uti Pancard"); ?>
<?php
    $table = "yes";
?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title pull-left">Uti Pancard</h4>
                    <a class="btn bg-slate legitRipple pull-right" href="http://www.psaonline.utiitsl.com/psaonline/" target="_blank">Login UTI Portal</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body p-0">
                    <table class="table table-bordered">
                        <tr><td>1 Token</td><td>1 PAN Application</td></tr>
                        <tr><td>Username</td><td><?php echo e(($vledata) ? $vledata->vleid : ''); ?></td></tr>
                        <tr><td>Password</td><td><?php echo e(($vledata) ? $vledata->vlepassword : ''); ?></td></tr>
                    </table>
                </div>
                <form id="pancardForm" action="<?php echo e(route('pancardpay')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="actiontype" value="purchase">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>No Of Tokens</label>
                            <input type="number" class="form-control" name="tokens" placeholder="Enter No. of tokens" required="">
                        </div>
                        <div class="form-group">
                            <label>Total Price in Rs</label>
                            <input type="number" class="form-control" id = "price" value = "" readonly>
                        </div>
                        <div class="form-group">
                            <label>Vle Id</label>
                            <input type="text" class="form-control" name="vleid" value="<?php echo e(($vledata) ? $vledata->vleid : ''); ?>" required="">
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <?php if($vledata && $vledata->status == "success"): ?>
                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Paying"><b><i class=" icon-paperplane"></i></b> Pay Now</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title pull-left">Recent Uti Pancard Token</h4>
                    <?php if(!$vledata): ?>
                        <a class="btn bg-slate legitRipple pull-right" href="javascript:void(0)" data-toggle="modal" data-target="#addModal">Request For Vle-id</a>
                    <?php elseif($vledata && $vledata->status != "success"): ?>
                        <button disabled="disabled" class="btn bg-danger pull-right">Utiid Request is <?php echo e($vledata->status); ?>, <?php echo e($vledata->remark); ?></button>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                </div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User Details</th>
                            <th>Transaction Details</th>
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
<!-- Footer -->
<div class="footer text-muted">
    <div class="row">
        <div class="col-md-6">
            <h4><strong>Important T&amp;Cs:</strong></h4>
            <ul>
                <li>The fee for processing PAN application is ₹107 inclusive of GST.</li>
                <li>PAN card application can be processed using eKYC or physical documents.</li>
            </ul>
        </div>
        <div class="col-md-6 text-right">
            <div>Powered by</div>
            <img src="<?php echo e(asset('')); ?>/assets/images/uti.png" style="position: relative;">
        </div>
    </div>
</div>
<!-- /footer -->

<div id="addModal" class="modal fade right" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-slate">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">New Id Request</h4>
            </div>
            <form id="transferForm" method="post" action="<?php echo e(route('pancardpay')); ?>">
                <input type="hidden" name="actiontype" value="vleid">
                <div class="modal-body">
                    <div class="row">
                        <?php echo csrf_field(); ?>

                        <div class="form-group col-md-6">
                            <label>Vle Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Value" value="<?php echo e(Auth::user()->name); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Comtact Person</label>
                            <input type="text" class="form-control" name="contact_person" placeholder="Enter Value" value="<?php echo e(Auth::user()->name); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Value" value="<?php echo e(Auth::user()->email); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" pattern="[0-9]*" maxlength="10" minlength="10" placeholder="Enter Value" value="<?php echo e(Auth::user()->mobile); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pancard</label>
                            <input type="text" class="form-control" name="pancard" required="" placeholder="Enter Value" value="<?php echo e(Auth::user()->pancard); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Address</label>
                            <input type="text" class="form-control" name="location" placeholder="Enter Value" value="<?php echo e(Auth::user()->city); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" required="" placeholder="Enter Value" value="<?php echo e(Auth::user()->state); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pincode</label>
                            <input type="text" class="form-control" name="pincode" placeholder="Enter Value" value="<?php echo e(Auth::user()->pincode); ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-raised legitRipple" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn bg-slate btn-raised legitRipple" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Submitting">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
    $(document).ready(function () {
        var url = "<?php echo e(url('statement/fetch')); ?>/utipancardstatement/0";
        var onDraw = function() {
        };
        var options = [
            { "data" : "name",
                render:function(data, type, full, meta){
                    return `<div>
                            <span class='text-inverse m-l-10'><b>`+full.id +`</b> </span>
                            <div class="clearfix"></div>
                        </div><span style='font-size:13px' class="pull=right">`+full.created_at+`</span>`;
                }
            },
            { "data" : "bank",
                render:function(data, type, full, meta){
                    return full.user.name+` ( `+full.user.id+` )<br>`+full.user.mobile+` ( `+full.user.role.name+` )`;
                }
            },
            { "data" : "bank",
                render:function(data, type, full, meta){
                    return `Vle Id - `+full.number+`<br>Tokens - `+full.option1;
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
                    }else{
                        var out = `<span class="label label-danger">Failed</span>`;
                    }

                    var menu = ``;
                    <?php if(Myhelper::can('Utipancard_statement_edit')): ?>
                    menu += `<li class="dropdown-header">Setting</li>
                            <li><a href="javascript:void(0)" onclick="editReport(`+full.id+`,'`+full.refno+`','`+full.txnid+`','`+full.payid+`','`+full.remark+`', '`+full.status+`', 'utipancard')"><i class="icon-pencil5"></i> Edit</a></li>`;
                    <?php endif; ?>

                    out +=  `<ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        `+menu+`
                                    </ul>
                                </li>
                            </ul>`;

                    return out;
                }
            }
        ];

        datatableSetup(url, options, onDraw);

        $('[name="tokens"]').keyup(function(){
             $("#price").val($(this).val() * 107);

        });

        $( "#pancardForm" ).validate({
            rules: {
                tokens: {
                    required: true,
                    number : true,
                    min : 1
                },
                vleid: {
                    required: true
                }
            },
            messages: {
                tokens: {
                    required: "Please enter token number",
                    number: "Token should be numeric",
                    min: "Minimum one token is required",
                },
                vleid: {
                    required: "Please enter vle id",
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
                var form = $('#pancardForm');
                var id = form.find('[name="id"]').val();
                form.ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button[type="submit"]').button('loading');
                    },
                    success:function(data){
                        form.find('button[type="submit"]').button('reset');
                        if(data.status == "success"){
                            getbalance();
                            form[0].reset();
                            notify("Pancard Token Request Successfully Submitted", 'success');
                            $('#datatable').dataTable().api().ajax.reload();
                        }else{
                            notify("Pancard "+data.status+ "! "+data.description, 'warning', 'inline', form);
                        }
                    },
                    error: function(errors) {
                        showError(errors, form);
                    }
                });
            }
        });

        $( "#transferForm" ).validate({
            rules: {
                vleid: {
                    required: true,
                },
                name: {
                    required: true,
                },
                contact_person: {
                    required: true,
                },
                email: {
                    required: true,
                },
                mobile: {
                    required: true,
                },
                pancard: {
                    required: true,
                },
                location: {
                    required: true,
                },
                state: {
                    required: true,
                },
                pincode: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Please enter name",
                },
                vleid: {
                    required: "Please enter vleid",
                },
                contact_person: {
                    required: "Please enter contact_person",
                },
                email: {
                    required: "Please enter email",
                },
                pancard: {
                    required: "Please enter pancard",
                },
                location: {
                    required: "Please enter location",
                },
                state: {
                    required: "Please enter state",
                },
                pincode: {
                    required: "Please enter pincode",
                },
                mobile: {
                    required: "Please enter mobile",
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
                var form = $('#transferForm');
                form.ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button[type="submit"]').button('loading');
                    },
                    success:function(data){
                        if(data.status == "success"){
                            swal({
                                type: "success",
                                title: "Success",
                                text: "Uti id request submitted successfull",
                                onClose: () => {
                                    window.location.reload();
                                }
                            });
                        }else{
                            notify(data.status, 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form);
                    }
                });
            }
        });
    });
    <?php if(Myhelper::can('uti_vle_creation')): ?>
        function vlerequest(){
            $.ajax({
                url: "<?php echo e(route('pancardpay')); ?>",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType:'json',
                data : {"actiontype" : 'vleid'},
                beforeSend:function(){
                    swal({
                        title: 'Wait!',
                        text: 'We are feching details.',
                        onOpen: () => {
                            swal.showLoading()
                        }
                    });
                }
            })
            .success(function(data) {
                if(data.status == "success"){
                    swal({
                        type: "success",
                        title: "Success",
                        text: "Uti id request submitted successfull",
                        onClose: () => {
                            window.location.reload();
                        }
                    });
                }else{
                    swal.close();
                    notify(data.status, 'warning');
                }
            })
            .error(function(errors) {
                swal.close();
                showError(errors, $('#pancardForm'));
            });
        }
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/finoviti/public_html/Reseller/nikatby.co.in/Reseller/login.kishalaypay.com/resources/views/service/uti.blade.php ENDPATH**/ ?>
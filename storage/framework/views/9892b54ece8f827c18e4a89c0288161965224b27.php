<?php $__env->startSection('title', ucfirst($type).' Bill Payment'); ?>
<?php $__env->startSection('pagetitle', ucfirst($type).' Bill Payment'); ?>
<?php
    $table = "yes";
?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><?php echo e(ucfirst($type)); ?> Bill Payment</h4>
                </div>
                <form id="billpayForm" action="<?php echo e(route('billpay')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="type" value="getbilldetails">
                    <input type="hidden" name="TransactionId">
                    <div class="panel-body">
                        <?php if($mydata['billnotice'] != null && $mydata['billnotice'] != ''): ?>
                            <div class="alert bg-info alert-styled-left no-margin mb-20" style="font-size:20px">
                                <span class="text-semibold">Note !</span> <?php echo e($mydata['billnotice']); ?>.
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label><?php echo e(ucfirst($type)); ?> Operator</label>
                                <select name="provider_id" class="form-control select" required="" onchange="SETTITLE()">
                                    <option value="">Select Operator</option>
                                    <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="billdata">
                              
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" id="fetch" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Fetching"><b><i class="icon-paperplane"></i></b> Fetch Bill</button>

                        <button type="submit" style="display: none" id="pay" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Paying"><b><i class=" icon-paperplane"></i></b> Pay Now</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
          <h4 class="panel-title">Recent <?php echo e(ucfirst($type)); ?> Bill Payment</h4>
        </div>
        <div class="panel-body">
        </div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User Details</th>
                            <th>Transaction Details</th>
                            <th>Refrence Details</th>
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

<div id="receipt" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header bg-slate">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Receipt</h4>
          </div>
          <div class="modal-body p-0">
              <div class="panel panel-primary">
              <div class="panel-body">
                  <div class="clearfix">
                      <div class="pull-left">
                            <h4><?php echo e(Auth::user()->company->companyname); ?></h4>
                      </div>
                      <div class="pull-right">
                          <h4>Bill Payment Invoice</h4>
                      </div>
                  </div>
                  <hr class="m-t-10 m-b-10">
                  <div class="row">
                      <div class="col-md-12">
                          
                          <div class="pull-left m-t-10">
                              <address class="m-b-10">
                                <strong><?php echo e(Auth::user()->name); ?></strong><br>
                                <?php echo e(Auth::user()->company->companyname); ?><br>
                                Phone : <?php echo e(Auth::user()->mobile); ?>

                                </address>
                          </div>
                          <div class="pull-right m-t-10">
                              <address class="m-b-10">
                                <strong>Date: </strong> <span class="created_at"></span><br>
                                <strong>Order ID: </strong> <span class="order_id"></span><br>
                                </address>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="table-responsive">
                              <h4>Bill Details :</h4>
                              <table class="table m-t-10">
                                  <thead>
                                      <tr>
                                          <th>Electricity Board</th>
                                          <th>Consumer Number</th>
                                          <th>Amount</th>
                                          <th>Ref No.</th></tr></thead>
                                  <tbody>
                                      <tr>
                                          <td class="provider"></td>
                                          <td class="number"></td>
                                          <td class="amount"></td>
                                          <td class="refno"></td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
                  <div class="row" style="border-radius: 0px;">
                      <div class="col-md-6 col-md-offset-6">
                          <h4 class="text-right">Bill Amount : <span class="amount"></span></h4>
                      </div>
                  </div>
                  <hr>
                  <div class="hidden-print">
                      <div class="pull-right">
                          <a href="javascript:void(0)"  id="print" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                      </div>
                  </div>
              </div>
          </div>
          </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('/assets/js/core/jQuery.print.js')); ?>"></script>
  <script type="text/javascript">
    $(document).ready(function () {
        
        var url = "<?php echo e(url('statement/fetch')); ?>/billpaystatement/0";

        var onDraw = function() {};

        var options = [
            { "data" : "name",
                render:function(data, type, full, meta){
                    return `<div>
                            <span class='text-inverse m-l-10'><b>`+full.id +`</b> </span>
                            <div class="clearfix"></div>
                        </div><span style='font-size:13px' class="pull=right">`+full.created_at+`</span>`;
                }
            },
            { "data" : "username"},
            { "data" : "bank",
                render:function(data, type, full, meta){
                    return `Number - `+full.number+`<br>Operator - `+full.providername;
                }
            },
            { "data" : "bank",
                render:function(data, type, full, meta){
                    return `Ref No.  - `+full.refno+`<br>Txnid - `+full.txnid;
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

        $('#print').click(function(){
            $('#receipt').find('.modal-body').print();
        });

        $( "#billpayForm" ).validate({
            rules: {
                provider_id: {
                    required: true,
                    number : true,
                },
                amount: {
                    required: true,
                    number : true,
                    min: 10
                },
                biller: {
                    required: true
                },
                duedate: {
                    required: true,
                },
            },
            messages: {
                provider_id: {
                    required: "Please select recharge operator",
                    number: "Operator id should be numeric",
                },
                amount: {
                    required: "Please enter recharge amount",
                    number: "Amount should be numeric",
                    min: "Min recharge amount value rs 10",
                },
                biller: {
                    required: "Please enter biller name",
                },
                duedate: {
                    required: "Please enter biller duedate",
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
                var form = $('#billpayForm');
                var id   = form.find('[name="id"]').val();
                var type = form.find('[name="type"]').val();

                form.ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button[type="submit"]').button('loading');

                        if(type == "getbilldetails"){
                            swal({
                                title: 'Wait!',
                                text: 'We are fetching bill details',
                                onOpen: () => {
                                    swal.showLoading()
                                },
                                allowOutsideClick: () => !swal.isLoading()
                            });
                        }
                    },
                    success:function(data){
                        swal.close();
                        form.find('button[type="submit"]').button('reset');

                        if(data.statuscode == "TXN"){
                            $('#billpayForm').find('[name="type"]').val("payment");
                            $('#billpayForm').find('[name="TransactionId"]').val(data.data.TransactionId);
                            $('.billdata').append(`
                                <div class="form-group col-md-4">
                                    <label>Consumer Name</label>
                                    <input type="text" name="biller" value="`+data.data.customername+`" class="form-control" placeholder="Enter name" required="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Due Date</label>
                                    <input type="text" name="duedate" value="`+data.data.duedate+`" class="form-control" placeholder="Enter due date" required="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Amount</label>
                                    <input type="text" name="amount" value="`+data.data.dueamount+`" class="form-control" placeholder="Enter amount" required="">
                            </div>`);

                            $('#fetch').hide();
                            $('#pay').show();
                        }else if(data.status == "success" || data.status == "pending"){
                            $('#fetch').show();
                            $('#pay').hide();
                            form[0].reset();
                            $('#billpayForm').find('[name="type"]').val("getbilldetails");
                            form.find('select').select2().val(null).trigger('change');
                            getbalance();
                            form.find('button[type="submit"]').button('reset');
                            notify("Billpayment Successfully Submitted", 'success');

                            $('#receipt').find('.created_at').text(data.data.created_at);
                            $('#receipt').find('.amount').text(data.data.amount);
                            $('#receipt').find('.refno').text(data.data.txnid);
                            $('#receipt').find('.number').text(data.data.number);
                            $('#receipt').find('.order_id').text(data.data.id);
                            $('#receipt').find('.provider').text(data.data.provider.name);
                            $('#receipt').modal();
                            $('#datatable').dataTable().api().ajax.reload();
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        swal.close();
                        showError(errors, form);
                    }
                });
            }
        });
    });

    function SETTITLE() {
        var providerid = $('[name="provider_id"]').val();
        if(providerid != ''){
            $.ajax({
                url: "<?php echo e(route('getprovider')); ?>",
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend:function(){
                    swal({
                        title: 'Wait!',
                        text: 'We are fetching bill details',
                        onOpen: () => {
                            swal.showLoading()
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    });
                },
                data: { "provider_id" : providerid}
            })
            .done(function(data) {
                swal.close();
                $('.billdata').empty();
                $.each(data.paramname, function(i,val) {
                    if(data.ismandatory[i] == "TRUE" ){
                        var html =   '<div>';
                        html     +=  '<div class="form-group col-md-4">';
                        html     +=  '<label>'+data.paramname[i]+'</label>';
                        html     +=  '<input type="text" name="number'+i+'" minlength="'+data.minlength[i]+'" maxlength="'+data.maxlength[i]+'" class="form-control" placeholder="Enter value">';
                        html     +=  '</div>';
                        html     +=  '</div>';
                        $('.billdata').append(html);
                    }
                });
            })
            .fail(function(errors) {
                swal.close();
                showError(errors, $('#billpayForm'));
            });
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/finoviti/public_html/Reseller/nikatby.co.in/Reseller/login.kishalaypay.com/resources/views/service/billpayment.blade.php ENDPATH**/ ?>
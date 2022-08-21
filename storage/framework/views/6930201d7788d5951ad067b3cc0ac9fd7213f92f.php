
<?php $__env->startSection('title', "Aeps Wallet Statement"); ?>
<?php $__env->startSection('pagetitle',  "Aeps Wallet Statement"); ?>

<?php
    $table = "yes";
    $export = "awallet";
?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Aeps Wallet Statement</h4>
                </div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="150px">Refrence Details</th>
                            <th>Transaction Details</th>
                            <th width="100px">TXN Type</th>
                            <th width="100px">ST Type</th>
                            <th>Status</th>
                            <th width="130px">Opening Bal.</th>
                            <th width="130px">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        var url = "<?php echo e(url('statement/fetch')); ?>/awalletstatement/<?php echo e($id); ?>";
        var onDraw = function() {
            $('[data-popup="tooltip"]').tooltip();
            $('[data-popup="popover"]').popover({
                template: '<div class="popover border-teal-400"><div class="arrow"></div><h3 class="popover-title bg-teal-400"></h3><div class="popover-content"></div></div>'
            });
        };
        var options = [
            { "data" : "name",
                render:function(data, type, full, meta){
                    var out = "";
                    out += `</a><span style='font-size:13px' class="pull=right">`+full.created_at+`</span>`;
                    return out;
                }
            },
            { "data" : "username"},
            { "data" : "bank",
                render:function(data, type, full, meta){
                    if(full.transtype == "fund" ){
                        return `<b>`+full.payid+`</b><br> `+full.remark;
                    }else{
                        if(full.status == "success"){
                            return full.aadhar+` / `+full.mobile+' / '+full.refno;
                        }else{
                            return full.aadhar+` / `+full.mobile+' / '+full.mytxnid;
                        }
                    }
                }
            },
            { "data" : "transtype"},
            { "data" : "rtype"},
            { "data" : "status"},
            { "data" : "bank",
                render:function(data, type, full, meta){
                    return `<i class="fa fa-inr"></i> `+full.balance;
                }
            },
            { "data" : "bank",
                render:function(data, type, full, meta){
                    if(full.type == "credit"){
                        return `<i class="text-success icon-plus22"></i> <i class="fa fa-inr"></i> `+ (full.amount + full.charge);
                    }else if(full.type == "debit"){
                        return `<i class="text-danger icon-dash"></i> <i class="fa fa-inr"></i> `+ (full.amount + full.charge);
                    }else{
                        return `<i class="fa fa-inr"></i> `+ (full.amount + full.charge);
                    }
                }
            }
        ];

        datatableSetup(url, options, onDraw , '#datatable', {columnDefs: [{
                    orderable: false,
                    width: '80px',
                    targets: [0]
                }]});
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/finoviti/public_html/Reseller/nikatby.co.in/Reseller/login.kishalaypay.com/resources/views/statement/awallet.blade.php ENDPATH**/ ?>
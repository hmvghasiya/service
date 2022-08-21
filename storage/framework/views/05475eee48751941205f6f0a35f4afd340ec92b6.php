<?php $__env->startSection('title', "Account Statement"); ?>
<?php $__env->startSection('pagetitle',  "Account Statement"); ?>

<?php
    $table = "yes";
    $export = "wallet";
?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Account Statement</h4>
                </div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="150px">Refrence Details</th>
                            <th>Product</th>
                            <th>Provider</th>
                            <th>Txnid</th>
                            <th>Number</th>
                            <th width="100px">ST Type</th>
                            <th>Status</th>
                            <th width="130px">Opening Bal.</th>
                            <th width="130px">Amount</th>
                            <th width="130px">Closing Bal.</th>
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
        var url = "<?php echo e(url('statement/fetch')); ?>/accountstatement/<?php echo e($id); ?>";
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
            { "data" : "full.username",
                render:function(data, type, full, meta){
                    var uid = "<?php echo e(Auth::id()); ?>";
                    if(full.credited_by == uid){
                        var name = full.username;
                    }else{
                        var name = full.sendername;
                    }
                    return name;
                }
            },
            { "data" : "product"},
            { "data" : "providername"},
            { "data" : "id"},
            { "data" : "number"},
            { "data" : "rtype"},
            { "data" : "status"},
            { "data" : "bank",
                render:function(data, type, full, meta){
                    return `<i class="fa fa-inr"></i> `+full.balance;
                }
            },
            { "data" : "bank",
                render:function(data, type, full, meta){
                    if(full.trans_type == "credit"){
                        return `<i class="text-success icon-plus22"></i> <i class="fa fa-inr"></i> `+ (full.amount + full.charge - full.profit).toFixed(2);
                    }else if(full.trans_type == "debit"){
                        return `<i class="text-danger icon-dash"></i> <i class="fa fa-inr"></i> `+ (full.amount + full.charge - full.profit).toFixed(2);
                    }else{
                        return `<i class="fa fa-inr"></i> `+ (full.amount + full.charge - full.profit).toFixed(2);
                    }
                }
            },
            { "data" : "bank",
                render:function(data, type, full, meta){
                    if(full.status == "pending" || full.status == "success" || full.status == "reversed" || full.status == "refunded"){
                        if(full.trans_type == "credit"){
                            return `<i class="fa fa-inr"></i> `+ (full.balance + (full.amount + full.charge - full.profit)).toFixed(2);
                        }else if(full.trans_type == "debit"){
                            return `<i class="fa fa-inr"></i> `+ (full.balance - (full.amount + full.charge - full.profit)).toFixed(2);
                        }else{
                            return `<i class="fa fa-inr"></i> `+ (full.balance - (full.amount + full.charge - full.profit)).toFixed(2); 
                        }
                    }else{
                        return `<i class="fa fa-inr"></i> `+full.balance;
                    }
                }
            },
        ];

        datatableSetup(url, options, onDraw , '#datatable', {columnDefs: [{
                    orderable: false,
                    width: '80px',
                    targets: [0]
                }]});
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/statement/account.blade.php ENDPATH**/ ?>
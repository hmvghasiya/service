<!-- Page header -->
<div class="page-header page-header-default mb-10">
    <div class="page-header-content">
        <div class="page-title">
            <div class="row">
                <h4 class="col-md-3"><span class="text-semibold"><?php echo $__env->yieldContent('pagehead', 'Home'); ?></span> - <?php echo $__env->yieldContent('pagetitle'); ?></h4>
                <?php if($mydata['news'] != '' && $mydata['news'] != null): ?>
                <h4 class="col-md-9 text-danger"><marquee style="height: 25px" onmouseover="this.stop();" onmouseout="this.start();"><?php echo e($mydata['news']); ?></marquee></h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php if(!Request::is('dashboard') && !Request::is('profile/*') && !Request::is('recharge/*') && !Request::is('billpay/*') && !Request::is('pancard/*') && !Request::is('member/*/create') && !Request::is('profile') && !Request::is('profile/*') && !Request::is('dmt') && !Request::is('resources/companyprofile') && !Request::is('aeps/*') && !Request::is('developer/*') && !Request::is('resources/commission') && !Request::is('setup/portalsetting')): ?>
<!-- /page header -->
<div class="content p-b-0">
    <form id="searchForm">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Search</h4>
                <div class="heading-elements">
                    <button type="submit" class="btn bg-slate btn-xs btn-labeled legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Searching"><b><i class="icon-search4"></i></b> Search</button>
                    <button type="button" class="btn btn-warning btn-xs btn-labeled legitRipple" id="formReset" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Refreshing"><b><i class="icon-rotate-ccw3"></i></b> Refresh</button>
                    <button type="button" class="btn btn-primary btn-xs btn-labeled legitRipple <?php echo e(isset($export) ? '' : 'hide'); ?>" product="<?php echo e($export ?? ''); ?>" id="reportExport"><b><i class="icon-cloud-download2"></i></b> Export</button></div>
            </div>
            <div class="panel-body p-tb-10">
                <?php if(isset($mystatus)): ?>
                    <input type="hidden" name="status" value="<?php echo e($mystatus); ?>">
                <?php endif; ?>
                <div class="row">
                    <div class="form-group col-md-2 m-b-10">
                        <input type="text" name="from_date" class="form-control mydate" placeholder="From Date">
                    </div>
                    <div class="form-group col-md-2 m-b-10">
                        <input type="text" name="to_date" class="form-control mydate" placeholder="To Date">
                    </div>
                    <div class="form-group col-md-2 m-b-10">
                        <input type="text" name="searchtext" class="form-control" placeholder="Search Value">
                    </div>
                    <?php if(Myhelper::hasNotRole(['retailer', 'apiuser'])): ?>
                        <div class="form-group col-md-2 m-b-10 <?php echo e(isset($agentfilter) ? $agentfilter : ''); ?>">
                            <input type="text" name="agent" class="form-control" placeholder="Agent Id / Parent Id">
                        </div>
                    <?php endif; ?>

                    <?php if(isset($status)): ?>
                    <div class="form-group col-md-2">
                        <select name="status" class="form-control select">
                            <option value="">Select <?php echo e($status['type'] ?? ''); ?> Status</option>
                            <?php if(isset($status['data']) && sizeOf($status['data']) > 0): ?>
                                <?php $__currentLoopData = $status['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <?php endif; ?>

                    <?php if(isset($product)): ?>
                    <div class="form-group col-md-2">
                        <select name="product" class="form-control select">
                            <option value="">Select <?php echo e($product['type'] ?? ''); ?></option>
                            <?php if(isset($product['data']) && sizeOf($product['data']) > 0): ?>
                                <?php $__currentLoopData = $product['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>
</div>
<?php endif; ?><?php /**PATH /home/loginsalairechar/public_html/resources/views/layouts/pageheader.blade.php ENDPATH**/ ?>
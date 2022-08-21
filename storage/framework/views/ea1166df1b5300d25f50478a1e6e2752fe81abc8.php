<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <?php if(Auth::user()->company->logo): ?>
            <a class="navbar-brand no-padding" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('')); ?>public/logos/<?php echo e(Auth::user()->company->logo); ?>" class=" img-responsive" alt="" style="width: 260px;height: 56px;">
            </a>
        <?php else: ?>
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>" style="padding: 20px">
                <span class="companyname" style="color: white"><?php echo e(Auth::user()->company->companyname); ?></span>
            </a>
        <?php endif; ?>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            <?php if(Myhelper::hasRole('admin')): ?>
            <li><a href="javascript:void(0)" style="padding: 13px"><button type="button" class="btn bg-slate btn-labeled btn-xs legitRipple" data-toggle="modal" data-target="#walletLoadModal"><b><i class="icon-wallet"></i></b> Load Wallet</button></a></li>
            <?php endif; ?>
        </ul>

        <div class="navbar-right">
            <p class="navbar-text"><i class="icon-wallet"></i> Wallet : <span class="mainwallet"><?php echo e(Auth::user()->mainwallet); ?></span> /-</p>
            <a class="navbar-text" href="<?php echo e(route('fund', ['type' => 'aeps'])); ?>"> <span>Payout Request</span></a>
            <!--<p class="navbar-text"><i class="icon-wallet"></i> Aeps : <span class="aepsbalance"><?php echo e(Auth::user()->aepsbalance); ?></span> /-</p>-->
            <a class="navbar-text" href="<?php echo e(route('logout')); ?>"><i class="icon-switch2"></i> <span>Logout</span></a>
        </div>
    </div>
</div>
<!-- /main navbar --><?php /**PATH /home/loginkishalaypay/public_html/resources/views/layouts/topbar.blade.php ENDPATH**/ ?>
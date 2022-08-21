<?php $__env->startSection('title', 'Scheme Manager'); ?>
<?php $__env->startSection('pagetitle',  'Scheme Manager'); ?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">My Commission</h6>
                </div>

                <div class="panel-body no-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified no-margin">
                            <?php $__currentLoopData = $commission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e(($key == 'mobile') ? 'active' : ''); ?>"><a href="#<?php echo e($key); ?>" data-toggle="tab" class="legitRipple" aria-expanded="true"><?php echo e(ucfirst($key)); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="tab-content">
                            <?php $__currentLoopData = $commission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <div class="tab-pane <?php echo e(($key == 'mobile') ? 'active' : ''); ?>" id="<?php echo e($key); ?>">
                                    <table class="table table-bordered" cellspacing="0" style="width:100%">
                                        <thead>
                                            <th>Provider</th>
                                            <th>Type</th>
                                            <?php if(Myhelper::hasRole(['whitelable'])): ?>
                                            <th>Whitelable</th>
                                            <?php endif; ?>
                                            <?php if(Myhelper::hasRole(['statehead'])): ?>
                                            <th>State Head</th>
                                            <?php endif; ?>
                                            <?php if(Myhelper::hasRole(['md'])): ?>
                                            <th>Md</th>
                                            <?php endif; ?>
                                            <?php if(Myhelper::hasRole(['distributor'])): ?>
                                            <th>Distributor</th>
                                            <?php endif; ?>
                                            <?php if(Myhelper::hasRole(['retailer'])): ?>
                                            <th>Retailer</th>
                                            <?php endif; ?>
                                    </thead>

                                        <tbody>
                                            <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                                <tr>
                                                    <td><?php echo e(ucfirst($comm->provider->name)); ?></td>
                                                    <td><?php echo e(ucfirst($comm->type)); ?></td>
                                                    <?php if(Myhelper::hasRole(['admin','whitelable'])): ?>
                                                    <td><?php echo e(ucfirst($comm->whitelable)); ?></td>
                                                    <?php endif; ?>
                                                    <?php if(Myhelper::hasRole(['admin','statehead'])): ?>
                                                    <td><?php echo e(ucfirst($comm->statehead)); ?></td>
                                                    <?php endif; ?>
                                                    <?php if(Myhelper::hasRole(['admin','md'])): ?>
                                                    <td><?php echo e(ucfirst($comm->md)); ?></td>
                                                    <?php endif; ?>
                                                    <?php if(Myhelper::hasRole(['admin','distributor'])): ?>
                                                    <td><?php echo e(ucfirst($comm->distributor)); ?></td>
                                                    <?php endif; ?>
                                                    <?php if(Myhelper::hasRole(['admin','retailer'])): ?>
                                                    <td><?php echo e(ucfirst($comm->retailer)); ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            

                            <div class="tab-pane" id="bottom-justified-tab2">
                                Food truck fixie locavore, accusamus mcsweeneys marfa nulla single-origin coffee squid laeggin.
                            </div>

                            <div class="tab-pane" id="bottom-justified-tab3">
                                DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
                            </div>

                            <div class="tab-pane" id="bottom-justified-tab4">
                                Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/loginkishalaypay/public_html/resources/views/resource/commission.blade.php ENDPATH**/ ?>
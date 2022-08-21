<?php $__env->startSection('title', 'Prepaid Card Kyc View Detail'); ?>
<?php $__env->startSection('pagetitle', 'Prepaid Card Kyc View Detail'); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prepaid Card Kyc View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                           
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($prepaidcard_kyc->getPhotoImageUrl()); ?>" width="200px" height="200px">
                                </div>
                                
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($prepaidcard_kyc->getPanCardImageUrl()); ?>" width="200px" height="200px">
                                </div>
                                
                            </div>

                            <div class="form-group col-md-4">
                                <label>Passbook  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($prepaidcard_kyc->getPassBookImageUrl()); ?>" width="200px" height="200px">
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($prepaidcard_kyc->getAdharCardImageUrl()); ?>" width="200px" height="200px">
                                </div>
                            </div>

                           
                           
                       
                    </div>
                </div>
            </div>
          

           

            
        </div>
   
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/prepaidcard_kyc/view.blade.php ENDPATH**/ ?>
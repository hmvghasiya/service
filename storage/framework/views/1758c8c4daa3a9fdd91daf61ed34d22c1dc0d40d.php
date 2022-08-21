<?php $__env->startSection('title', 'Digital Signature View Detail'); ?>
<?php $__env->startSection('pagetitle', 'Digital Signature View Detail'); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Digital Signature View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                           
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    
                                    <?php if( pathinfo($digital_signature->getPhotoImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($digital_signature->getPhotoImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($digital_signature->getPhotoImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>

                                </div>
                                
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    
                                    <?php if( pathinfo($digital_signature->getPanCardImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($digital_signature->getPanCardImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($digital_signature->getPanCardImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>


                                </div>
                                
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    
                                    <?php if( pathinfo($digital_signature->getBankImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($digital_signature->getBankImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($digital_signature->getBankImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    
                                     <?php if( pathinfo($digital_signature->getAdharCardImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($digital_signature->getAdharCardImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($digital_signature->getAdharCardImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    
                                      <?php if( pathinfo($digital_signature->getAddressImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($digital_signature->getAddressImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($digital_signature->getAddressImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/digital_signature/view.blade.php ENDPATH**/ ?>
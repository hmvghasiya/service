<?php $__env->startSection('title', 'Itr Registration View Detail'); ?>
<?php $__env->startSection('pagetitle', 'Itr Registration View Detail'); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Itr Registration View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    
                                     <?php if( pathinfo($itr_reg->getPhotoImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($itr_reg->getPhotoImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($itr_reg->getPhotoImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    
                                     <?php if( pathinfo($itr_reg->getPanCardImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($itr_reg->getPanCardImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($itr_reg->getPanCardImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>
                                </div>
                                
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">

                                    
                                     <?php if( pathinfo($itr_reg->getBankImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($itr_reg->getBankImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($itr_reg->getBankImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <?php if( pathinfo($itr_reg->getAdharCardImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>
                                    <img src="<?php echo e($itr_reg->getAdharCardImageUrl()); ?>" width="200px" height="200px">
                                    <?php else: ?>
                                    <a href="<?php echo e($itr_reg->getAdharCardImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <?php if( pathinfo($itr_reg->getAddressImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($itr_reg->getAddressImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($itr_reg->getAddressImageUrl()); ?>" target="_blank">View Detail</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                           
                            <div class="form-group col-md-4">
                                <label>Signature  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    
                                     <?php if( pathinfo($itr_reg->getSignatureImageUrl(), PATHINFO_EXTENSION) !='pdf'): ?>

                                    <img src="<?php echo e($itr_reg->getSignatureImageUrl()); ?>" width="200px" height="200px">
                                      <?php else: ?>
                                    <a href="<?php echo e($itr_reg->getSignatureImageUrl()); ?>" target="_blank">View Detail</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/itr_reg/view.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Nsdl Pancard Registration View Detail'); ?>
<?php $__env->startSection('pagetitle', 'Nsdl Pancard Registration View Detail'); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nsdl Pancard Registration View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Application Type</label>
                                <div class="form-control"> 
                                    <?php if($nsdl_pancard->application_type==1): ?>
                                        <span>New Application</span>
                                    <?php else: ?>
                                        <span>Correction</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($nsdl_pancard->getPhotoImageUrl()); ?>" width="200px" height="200px">
                                </div>
                                
                            </div>
                             

                           

                            <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($nsdl_pancard->getAdharCardImageUrl()); ?>" width="200px" height="200px">
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Signature Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($nsdl_pancard->getSignatureImageUrl()); ?>" width="200px" height="200px">
                                </div>
                            </div>

                            <?php if($nsdl_pancard->application_type==1): ?>
                            <div class="form-group col-md-4">
                                <label>Nsdl Form  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($nsdl_pancard->getNsdlFormImageUrl()); ?>" width="200px" height="200px">
                                </div>
                            </div>

                            <?php endif; ?>
                        
                       
                    </div>
                </div>
            </div>
          

           

            
        </div>
   
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/nsdl_pancard/view.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Loan View Detail'); ?>
<?php $__env->startSection('pagetitle', 'Loan View Detail'); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Loan View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Loan Type</label>
                                <div class="form-control"> 
                                    <?php if($loan->loan_type==1): ?>
                                        <span>Personal Loan</span>
                                    <?php else: ?>
                                        <span>Bussiness Loan</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($loan->getPhotoImageUrl()); ?>" width="200px" height="200px">
                                </div>
                                
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($loan->getPanCardImageUrl()); ?>" width="200px" height="200px">
                                </div>
                                
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($loan->getBankImageUrl()); ?>" width="200px" height="200px">
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($loan->getAdharCardImageUrl()); ?>" width="200px" height="200px">
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($loan->getAddressImageUrl()); ?>" width="200px" height="200px">
                                </div>
                            </div>

                            <?php if($loan->loan_type==2): ?>
                            

                            <div class="form-group col-md-4">
                                <label>ITR 3 year  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="<?php echo e($loan->getItrImageUrl()); ?>" width="200px" height="200px">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/loan/view.blade.php ENDPATH**/ ?>
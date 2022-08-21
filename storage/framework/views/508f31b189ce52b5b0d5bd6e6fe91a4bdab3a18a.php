<?php if(isset($data)): ?>
<p>Loan Type: <?php if($data->loan_type==1): ?> Personal Loan <?php else: ?> Bussiness Loan <?php endif; ?></p>
<p>Pan Number: <?php echo e($data->pan_no); ?></p>
<?php endif; ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/itr_reg/partial/loan_detail.blade.php ENDPATH**/ ?>
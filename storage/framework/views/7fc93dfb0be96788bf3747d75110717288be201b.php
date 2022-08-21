<?php if(isset($data)): ?>
<p>Application Type: <?php if($data->application_type==1): ?> New Application <?php else: ?> Correction <?php endif; ?></p>

<?php if($data->application_type==2): ?><p> Old Pan Number: <?php echo e($data->old_pan_no); ?></p> <?php endif; ?>
<?php endif; ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/nsdl_pancard/partial/loan_detail.blade.php ENDPATH**/ ?>
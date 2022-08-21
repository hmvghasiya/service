<?php if(isset($data)): ?>
<p>Name: <?php echo e($data->f_name); ?> <?php echo e($data->l_name); ?> <?php echo e($data->m_name); ?></p>
<p>Email: <?php echo e($data->email); ?> </p>
<p>Mobile: <?php echo e($data->mobile_no); ?> </p>
<p>LandLine Number: <?php echo e($data->landline_no); ?> </p>
<p>DOB: <?php echo e($data->dob); ?> </p>
<?php endif; ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/gst_reg/partial/name.blade.php ENDPATH**/ ?>
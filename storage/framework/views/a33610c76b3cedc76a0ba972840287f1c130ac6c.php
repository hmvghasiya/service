<?php if(isset($data)): ?>
<p>Name: <?php echo e($data->f_name); ?> <?php echo e($data->l_name); ?> <?php echo e($data->m_name); ?></p>
<p>Email: <?php echo e($data->email); ?> </p>
<p>Mobile: <?php echo e($data->mobile_no); ?> </p>
<p>LandLine Number: <?php echo e($data->landline_no); ?> </p>
<p>DOB: <?php echo e($data->dob); ?> </p>

<?php if($data->rel_user != null): ?>
<h5>User Detail</h5>
<p>User id: <?php echo e($data->rel_user->id); ?></p>
<p>User Name<?php echo e($data->rel_user->name); ?></p>
<?php endif; ?>
<?php endif; ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/digital_signature/partial/name.blade.php ENDPATH**/ ?>
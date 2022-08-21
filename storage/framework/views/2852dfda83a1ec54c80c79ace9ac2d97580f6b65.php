 <form id="reasonForm" class="reasonForm" method="post" action="<?php echo e(route('digital_signature.reason')); ?>">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="id" value="<?php echo e($res->id); ?>">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Reason For Making Status <?php echo e(getStatus($res->status)); ?></label>
                                <input type="text" class="form-control" name="reason" required>
                            </div><br>
                            <div class="form-group col-md-4">
                                <label style="width:100%">&nbsp;</label>
                                <button class="btn bg-slate btn-raised legitRipple" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Submitting">Submit</button>
                                <button type="button" class="btn btn-default btn-raised legitRipple" data-dismiss="modal" aria-hidden="true">Close</button>
                            </div>
                        </div>
                    </div>
                </form>

          
<?php /**PATH E:\laragon\www\open_aisa\resources\views/digital_signature/partial/reason_modal.blade.php ENDPATH**/ ?>
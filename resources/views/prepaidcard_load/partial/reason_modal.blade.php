 <form id="reasonForm" class="reasonForm" method="post" action="{{ route('prepaidcard_load.reason') }}">
                    <div class="modal-body">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$res->id}}">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Reason For Making Status {{getStatus($res->status)}}</label>
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

         {{--        <script type="text/javascript">
                    $(document).ready(function () {
        $( ".reasonForm" ).validate({
            
            submitHandler: function () {
                var form = $('form.reasonForm');
                form.find('span.text-danger').remove();
                $('form.reasonForm').ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button:submit').button('loading');
                    },
                    complete: function () {
                        form.find('button:submit').button('reset');
                    },
                    success:function(data){
                        if(data.status == true){
                            form[0].reset();
                            $('select').val('');
                            $('select').trigger('change');
                            notify("Member Successfully Created" , 'success');
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form);
                    }
                });
            }
        });
    });
                </script> --}}

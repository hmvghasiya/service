@if($nsdl_id ==2)
<div class="form-group col-md-4">
                                <label>Old Pan Card Number</label>
                                <input type="text" name="old_pan_no" class="form-control" value=""  placeholder="Enter Value">
                      </div>
@elseif($nsdl_id==1)
<div class="form-group col-md-12">
                                    <label>Nsdl Form  Photo</label>
                                    <input type="file" name="nsdl_form" class="form-control" value="" placeholder="Enter Value">
                                </div>
@endif
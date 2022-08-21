@extends('layouts.app')
@section('title', 'Prepaid Card View Detail')
@section('pagetitle', 'Prepaid Card View Detail')
@section('content')
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prepaid Card View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Loan Type</label>
                                <div class="form-control"> 
                                    @if($e_sharm->loan_type==1)
                                        <span>Personal Loan</span>
                                    @else
                                        <span>Bussiness Loan</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$e_sharm->getPhotoImageUrl()}}" width="200px" height="200px">
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$e_sharm->getPanCardImageUrl()}}" width="200px" height="200px">
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$e_sharm->getBankImageUrl()}}" width="200px" height="200px">
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$e_sharm->getAdharCardImageUrl()}}" width="200px" height="200px">
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$e_sharm->getAddressImageUrl()}}" width="200px" height="200px">
                                </div>
                            </div>

                            @if($e_sharm->loan_type==2)
                            

                            <div class="form-group col-md-4">
                                <label>ITR 3 year  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$e_sharm->getItrImageUrl()}}" width="200px" height="200px">
                                </div>
                            </div>

                            @endif
                        
                       
                    </div>
                </div>
            </div>
          

           

            
        </div>
   
</div>
@endsection

@section('script')


@endsection

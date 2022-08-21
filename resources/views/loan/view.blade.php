@extends('layouts.app')
@section('title', 'Loan View Detail')
@section('pagetitle', 'Loan View Detail')
@section('content')
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
                                    @if($loan->loan_type==1)
                                        <span>Personal Loan</span>
                                    @else
                                        <span>Bussiness Loan</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$loan->getPhotoImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($loan->getPhotoImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$loan->getPhotoImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$loan->getPhotoImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$loan->getPanCardImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($loan->getPanCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$loan->getPanCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$loan->getPanCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$loan->getBankImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($loan->getBankImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$loan->getBankImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$loan->getBankImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$loan->getAdharCardImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($loan->getAdharCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$loan->getAdharCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$loan->getAdharCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$loan->getAddressImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($loan->getAddressImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$loan->getAddressImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$loan->getAddressImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                            @if($loan->loan_type==2)
                            

                            <div class="form-group col-md-4">
                                <label>ITR 3 year  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$loan->getItrImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($loan->getItrImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$loan->getItrImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$loan->getItrImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
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

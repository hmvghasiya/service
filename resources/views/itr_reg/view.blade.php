@extends('layouts.app')
@section('title', 'Itr Registration View Detail')
@section('pagetitle', 'Itr Registration View Detail')
@section('content')
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Itr Registration View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$itr_reg->getPhotoImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($itr_reg->getPhotoImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$itr_reg->getPhotoImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$itr_reg->getPhotoImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$itr_reg->getPanCardImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($itr_reg->getPanCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$itr_reg->getPanCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$itr_reg->getPanCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">

                                    {{-- <img src="{{$itr_reg->getBankImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($itr_reg->getBankImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$itr_reg->getBankImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$itr_reg->getBankImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    @if( pathinfo($itr_reg->getAdharCardImageUrl(), PATHINFO_EXTENSION) !='pdf')
                                    <img src="{{$itr_reg->getAdharCardImageUrl()}}" width="200px" height="200px">
                                    @else
                                    <a href="{{$itr_reg->getAdharCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    @if( pathinfo($itr_reg->getAddressImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$itr_reg->getAddressImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$itr_reg->getAddressImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                           
                            <div class="form-group col-md-4">
                                <label>Signature  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$itr_reg->getSignatureImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($itr_reg->getSignatureImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$itr_reg->getSignatureImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$itr_reg->getSignatureImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>


                        
                       
                    </div>
                </div>
            </div>
          

           

            
        </div>
   
</div>
@endsection

@section('script')


@endsection

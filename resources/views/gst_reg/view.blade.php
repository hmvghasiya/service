@extends('layouts.app')
@section('title', 'Gst Registration View Detail')
@section('pagetitle', 'Gst Registration View Detail')
@section('content')
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Gst Registration View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$gst_reg->getPhotoImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($gst_reg->getPhotoImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$gst_reg->getPhotoImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$gst_reg->getPhotoImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$gst_reg->getPanCardImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($gst_reg->getPanCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$gst_reg->getPanCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$gst_reg->getPanCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$gst_reg->getBankImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($gst_reg->getBankImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$gst_reg->getBankImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$gst_reg->getBankImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$gst_reg->getAdharCardImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($gst_reg->getAdharCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$gst_reg->getAdharCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$gst_reg->getAdharCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$gst_reg->getAddressImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($gst_reg->getAddressImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$gst_reg->getAddressImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$gst_reg->getAddressImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Signature  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$gst_reg->getSignatureImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($gst_reg->getSignatureImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$gst_reg->getSignatureImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$gst_reg->getSignatureImageUrl()}}" target="_blank">View Detail</a>
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

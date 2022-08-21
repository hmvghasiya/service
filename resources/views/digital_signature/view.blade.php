@extends('layouts.app')
@section('title', 'Digital Signature View Detail')
@section('pagetitle', 'Digital Signature View Detail')
@section('content')
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Digital Signature View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                           
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$digital_signature->getPhotoImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($digital_signature->getPhotoImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$digital_signature->getPhotoImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$digital_signature->getPhotoImageUrl()}}" target="_blank">View Detail</a>
                                    @endif

                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$digital_signature->getPanCardImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($digital_signature->getPanCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$digital_signature->getPanCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$digital_signature->getPanCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif


                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$digital_signature->getBankImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($digital_signature->getBankImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$digital_signature->getBankImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$digital_signature->getBankImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$digital_signature->getAdharCardImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($digital_signature->getAdharCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$digital_signature->getAdharCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$digital_signature->getAdharCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$digital_signature->getAddressImageUrl()}}" width="200px" height="200px"> --}}
                                      @if( pathinfo($digital_signature->getAddressImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$digital_signature->getAddressImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$digital_signature->getAddressImageUrl()}}" target="_blank">View Detail</a>
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

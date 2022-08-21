@extends('layouts.app')
@section('title', 'Ration Card View Detail')
@section('pagetitle', 'Ration Card View Detail')
@section('content')
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ration Card View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$ration_card->getPhotoImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($ration_card->getPhotoImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$ration_card->getPhotoImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$ration_card->getPhotoImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$ration_card->getPanCardImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($ration_card->getPanCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$ration_card->getPanCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$ration_card->getPanCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$ration_card->getBankImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($ration_card->getBankImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$ration_card->getBankImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$ration_card->getBankImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$ration_card->getAdharCardImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($ration_card->getAdharCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$ration_card->getAdharCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$ration_card->getAdharCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$ration_card->getAddressImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($ration_card->getAddressImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$ration_card->getAddressImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$ration_card->getAddressImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                            
                            <div class="form-group col-md-4">
                                <label>Nationality  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$ration_card->getNationImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($ration_card->getNationImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$ration_card->getNationImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$ration_card->getNationImageUrl()}}" target="_blank">View Detail</a>
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

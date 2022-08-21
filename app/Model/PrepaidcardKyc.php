<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PrepaidcardKyc extends Model
{
    protected $table="prepaidcard_kyc";

     public function rel_user()
    {
        return $this->belongsTo('\App\User','user_id','id');
    }
    public function getPhotoImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_PREPAIDCARD_KYC_PHOTO_UPLOAD_PATH().$this->photo;
        $imageUrl=ADMIN_PREPAIDCARD_KYC_PHOTO_UPLOAD_URL().$this->photo;
        if (isset($this->photo) && !empty($this->photo) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }  

    public function getPanCardImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_PREPAIDCARD_KYC_PAN_UPLOAD_PATH().$this->pancard_photo;
        $imageUrl=ADMIN_PREPAIDCARD_KYC_PAN_UPLOAD_URL().$this->pancard_photo;
        if (isset($this->pancard_photo) && !empty($this->pancard_photo) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    } 

    public function getPassBookImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_PREPAIDCARD_KYC_PASS_BOOK_UPLOAD_PATH().$this->passbook_photo;
        $imageUrl=ADMIN_PREPAIDCARD_KYC_PASS_BOOK_UPLOAD_URL().$this->passbook_photo;
        if (isset($this->passbook_photo) && !empty($this->passbook_photo) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }  

    public function getAdharCardImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_PREPAIDCARD_KYC_ADHAR_UPLOAD_PATH().$this->addhar_card_photo;
        $imageUrl=ADMIN_PREPAIDCARD_KYC_ADHAR_UPLOAD_URL().$this->addhar_card_photo;
        if (isset($this->addhar_card_photo) && !empty($this->addhar_card_photo) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    } 

    public function getNationImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_PREPAIDCARD_KYC_NATION_UPLOAD_PATH().$this->nationalilty;
        $imageUrl=ADMIN_PREPAIDCARD_KYC_NATION_UPLOAD_URL().$this->nationalilty;
        if (isset($this->nationalilty) && !empty($this->nationalilty) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }
     public function getItrImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_PREPAIDCARD_KYC_ITR_UPLOAD_PATH().$this->itr_3_year;
        $imageUrl=ADMIN_PREPAIDCARD_KYC_ITR_UPLOAD_URL().$this->itr_3_year;
        if (isset($this->itr_3_year) && !empty($this->itr_3_year) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }  
    public function getAddressImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_PREPAIDCARD_KYC_ADDRESS_UPLOAD_PATH().$this->address_proof;
        $imageUrl=ADMIN_PREPAIDCARD_KYC_ADDRESS_UPLOAD_URL().$this->address_proof;
        if (isset($this->address_proof) && !empty($this->address_proof) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }  
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GstReg extends Model
{
    protected $table="gst_reg";

     public function rel_user()
    {
        return $this->belongsTo('\App\User','user_id','id');
    }
    public function getPhotoImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_GST_REG_PHOTO_UPLOAD_PATH().$this->photo;
        $imageUrl=ADMIN_GST_REG_PHOTO_UPLOAD_URL().$this->photo;
        if (isset($this->photo) && !empty($this->photo) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }  

    public function getPanCardImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_GST_REG_PAN_UPLOAD_PATH().$this->pancard_photo;
        $imageUrl=ADMIN_GST_REG_PAN_UPLOAD_URL().$this->pancard_photo;
        if (isset($this->pancard_photo) && !empty($this->pancard_photo) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    } 

    public function getBankImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_GST_REG_BANK_STATE_UPLOAD_PATH().$this->bank_statement_photo;
        $imageUrl=ADMIN_GST_REG_BANK_STATE_UPLOAD_URL().$this->bank_statement_photo;
        if (isset($this->bank_statement_photo) && !empty($this->bank_statement_photo) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }  

    public function getAdharCardImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_GST_REG_ADHAR_UPLOAD_PATH().$this->addhar_card_photo;
        $imageUrl=ADMIN_GST_REG_ADHAR_UPLOAD_URL().$this->addhar_card_photo;
        if (isset($this->addhar_card_photo) && !empty($this->addhar_card_photo) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    } 

    public function getSignatureImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_GST_REG_SIGN_UPLOAD_PATH().$this->signature;
        $imageUrl=ADMIN_GST_REG_SIGN_UPLOAD_URL().$this->signature;
        if (isset($this->signature) && !empty($this->signature) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }
     public function getItrImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_GST_REG_ITR_UPLOAD_PATH().$this->itr_3_year;
        $imageUrl=ADMIN_GST_REG_ITR_UPLOAD_URL().$this->itr_3_year;
        if (isset($this->itr_3_year) && !empty($this->itr_3_year) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }  
    public function getAddressImageUrl(){

        $imageUrl_u=NO_IMAGE_URL();
        $imagePath=ADMIN_GST_REG_ADDRESS_UPLOAD_PATH().$this->address_proof;
        $imageUrl=ADMIN_GST_REG_ADDRESS_UPLOAD_URL().$this->address_proof;
        if (isset($this->address_proof) && !empty($this->address_proof) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }  
}

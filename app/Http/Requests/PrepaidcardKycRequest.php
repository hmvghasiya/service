<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class PrepaidcardKycRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $r)
    {
         $input = $r->all();
        $id    = !empty($input['id']) ? $input['id'] : "";
         $data=[
            'name' => 'required',
            'father_name' => 'required',
            'bank_name' => 'required',
            'ifsc_code' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'card_number' => 'required',
            'full_address' => 'required',
            'photo' => 'required',
            'pancard_photo' => 'required',
            'passbook_photo' => 'required',
            'addhar_card_photo' => 'required',

        ];


        return $data;
            

    
    }

    public function message()
    {
        return [
            'name.required' => 'Name is required',
            'father_name.required' => 'Father Name is required',
            'bank_name.required' => 'Bank Name is required',
            'ifsc_code.required' => 'Ifsc Code is required',
            'account_no.required' => 'Account Number is required',
            'mobile_no.required' => 'Mobile is required',
            'email.required' => 'Email is required',
            'dob.required' => 'Date of birth required',
            'card_number.required' => 'Card No is required',
            'full_address.required' => 'Address is required',
            'photo.required' => 'Profile photo is required',
            'pancard_photo.required' => 'Pan Card is required',
            'passbook_photo.required' => 'Passbook photo is required',
            'addhar_card_photo.required' => 'Adharcard photo is required',
           
        ];
    }
}

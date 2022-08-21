<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class PrepaidCardLoadRequest extends FormRequest
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
            'card_number' => 'required',
            'atm' => 'required',
            'mobile_no' => 'required',
            'bank_name' => 'required',

        ];

       

        return $data;
            

    
    }

    public function message()
    {
        return [
            'name.required' => 'Name is required',
            'card_number.required' => 'Card Number is required',
            'atm.required' => 'Atm is required',
            'mobile_no.required' => 'Mobile is required',
            'bank_name.required' => 'Bank Name is required',
           
        ];
    }
}

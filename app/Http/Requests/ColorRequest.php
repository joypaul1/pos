<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
    public function rules(){
        if(isset($this->id)){
            return [
                'color_name'  => 'required|unique:colors,color_name,'.$this->id
            ];
        }
        return [
            'color_name'=>'required|unique:colors',
        ];
    }
}

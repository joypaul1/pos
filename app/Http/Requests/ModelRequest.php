<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelRequest extends FormRequest
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
    public function rules()
    {
        if(isset($this->id)){
            return [
                'model_name'  => 'required|unique:product_models,model_name,'.$this->id
            ];
        }
        return [
            'model_name'=>'required|unique:product_models',
        ];
    }
}

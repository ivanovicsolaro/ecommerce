<?php

namespace App\Http\Requests;

use Vanilo\Framework\Http\Requests\CreateProduct as BaseCreateProduct;

class CreateProduct extends BaseCreateProduct
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
            $rules = parent::rules();

            // Extend the rules with a new mandatory field:
            $rules['stock'] = 'required';
            $rules['sku'] = '';
            $rules['state'] = '';
            $rules['name'] = 'max:30';

            return $rules;
    }
}

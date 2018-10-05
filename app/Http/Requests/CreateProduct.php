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
            $rules['categoria_id'] = 'required';
            $rules['subcategoria_id'] = 'required';
            $rules['price'] = 'numeric|required|min:1|max:99999999';
            $rules['price_real'] = 'numeric|required|min:1|max:99999999';
            $rules['name'] = 'required|max:30';
            $rules['sku'] = 'unique:products';
            $rules['state'] = '';

            return $rules;
    }
}

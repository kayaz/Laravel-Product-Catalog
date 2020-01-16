<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProduct extends FormRequest
{

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nazwa produktu jest wymagana',
            'name.unique' => 'Taki produkt już istnieje',
            'name.max.string' => 'Maksymalnie 255 znaków',
            'price.required'  => 'Cena produktu jest wymagana',
            'price.numeric'  => 'Cena produktu - tylko liczby',
            'description.required'  => 'Opis produktu jest wymagana',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'PUT') {
            $rules = [
                'name' => 'required|string|max:255|unique:products,name,'.$this->products->id,
                'price' => 'required|numeric',
                'description' => 'required'
            ];
        } else {
            $rules = [
                'name' => 'required|string|max:255|unique:products,name',
                'price' => 'required|numeric',
                'description' => 'required'
            ];
        }
        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
{
    //Determine if the user is authorized to make this request.
    public function authorize()
    {
        if ($this->user()->role->id == 1)
            return true;
        else
            return false;
    }



    //Get the validation rules that apply to the request.
    public function rules()
    {
        return [ 'name'           => 'required|alpha|unique:products,name',
                 'short_desc'     => 'required|string',
                 'long_desc'      => 'required|string',
                 'thumbnail'      => 'bail|file|mimes:jpeg,bmp,png|dimensions:max_width=2048,ratio=1',
                 'price'          => 'required|numeric|min:0',
                 'discount'       => 'required|numeric|min:0|max:100',
                 'stock'          => 'required|integer|min:0',
                 'color_id'       => 'exists:colors,id',
                 'size_id'        => 'exists:sizes,id',
                 'subcategory_id' => 'exists:subcategories,id',
                 'created_at'     => 'date',
                 'updated_at'     => 'date|nullable',
                 'deleted_at'     => 'date|nullable',
        ];
    }



    //Get the error messages for the defined validation rules.
    public function messages()
    {
        return [
                 'required'       => 'Este campo es obligatorio.',
                 'string'         => 'Debe contener texto.',
                 'alpha'          => 'Este campo no puede contener números o símbolos.',
                 'numeric'        => 'Debe ser numérico.',
                 'min:0'          => 'No debe ser un número negativo.',
                 'max:100'        => 'No debe ser mayor a 100.',
                 'integer'        => 'Debe ser un número entero.',
                 'exists'         => 'No es un :attribute válido.',
                 'date'           => 'Debe ser una fecha válida.',
                 'file'           => 'Debe ser un archivo válido',
                 'mimes'          => 'Debe ser del tipo jpg, bmp o png.',
                 'dimensions'     => 'Debe ser de 2048 pixels como máximo y ser cuadrada.',
                 'name.unique'    => 'Este nombre ya existe. Por favor elija otro.',
        ];
    }



   //Get custom attribute names for validator errors.
   public function attributes()
   {
       return [
                'name'           => 'nombre',
                'short_desc'     => 'descripción corta',
                'long_desc'      => 'descripción larga',
                'thumbnail'      => 'imagen',
                'price'          => 'precio',
                'discount'       => 'descuento',
                'stock'          => 'stock',
                'color_id'       => 'color',
                'size_id'        => 'tamaño',
                'subcategory_id' => 'subcategoria',
                'created_at'     => 'creado',
                'updated_at'     => 'actualizado',
                'deleted_at'     => 'borrado',
       ];
   }
}

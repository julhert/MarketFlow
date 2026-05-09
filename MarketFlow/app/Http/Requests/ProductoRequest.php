<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'descripcion' => 'required',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'portada' => 'required|image|mimes:jpg,png,webp|max:5120',
            'fotos_extra' => 'nullable|array|max:4',
            'fotos_extra.*' => 'image|mimes:jpg,png,webp|max:5120',
        ];
    }
}

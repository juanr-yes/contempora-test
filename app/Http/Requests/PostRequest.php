<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PostRequest extends FormRequest
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
        return [
          "nombre" => "required|string|max:255",
          "email" => "required|email|max:255",
          "genero" => "required|string|max:255|in:male,female",
          "activo" => "required|in:active,inactive",
        ];
    }
    public function failedValidation(Validator $validator) {
      throw new HttpResponseException(response()->json([
        "exito" => false,
        "mensaje" => "Errores de validación",
        "detalle" => $validator->errors()
      ]));
    }
    public function messages() {
      return [
        "nombre.required" => "El campo 'nombre' es requerido.",
        "nombre.string" => "El campo 'nombre' debe ser texto.",
        "email.required" => "El campo 'email' es requerido.",
        "email.email" => "Debe utilizarse una dirección de 'email' valida.",
        "genero.required" => "El campo 'genero' es requerido.",
        "genero.string" => "El campo 'genero' debe ser texto.",
        "genero.in" => "El campo 'genero' debe contener los valores 'male' o 'female'.",
        "activo.required" => "El campo 'activo' es requerido.",
        "activo.in" => "El campo 'activo' debe contener los valores 'active' o 'inactive'.",
      ];
    }
}

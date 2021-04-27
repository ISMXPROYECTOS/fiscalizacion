<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class InspeccionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (! request()->user()) {
            return false;
        }

        /*$user = User::where('usuario', request()->user()->usuario)->first();
        return request()->user()->usuario === $user->usuario;*/
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
            'cantidad' => ['required', 'integer'],
            'ejerciciofiscal_id' => ['required', 'integer'],
            'tipoinspeccion_id' => ['required', 'integer'],
            'encargado_id' => ['required', 'integer']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'message' => 'Invalid data',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }

    protected function failedAuthorization()
    {
        $response = response()->json([
            'errors' => 'No estás autorizado para realizar esta acción.'
        ], 401);

        throw new HttpResponseException($response);
    }
}

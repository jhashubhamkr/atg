<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueByPin;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class StoreUser extends FormRequest
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
            'name'      =>  'required|max:30',
            'pincode'   =>  'required|digits:6',
            'email'     =>  ['required','max:254','email:rfc,dns',new UniqueByPin($this->pincode)],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
            $response = new Response();

            $response->status = 0;
            $response->message="There are errors";
            $response->errors=$errors;

        throw new HttpResponseException(response()->json($response));

        // throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}

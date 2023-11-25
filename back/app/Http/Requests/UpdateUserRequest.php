<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        $user = User::where('id', $this->id)->get();
        return [
            'name' => ['string', 'max:50'],
            'surname' => ['string', 'max:50'],
            'address' => ['string', 'max:200'],
            'phone_number' => ['string', 'max:20'],
            'role' => '',
            'profile_photo'=>'',
            'passport_front' => 'mimes:jpg,bmp,png,jpeg',
            'passport_back' => 'mimes:jpg,bmp,png,jpeg',
        ];

    }
}

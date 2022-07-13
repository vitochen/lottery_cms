<?php

namespace App\Http\Requests;

use App\Traits\RuntimeFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class MemberCreateRequest extends FormRequest
{
    use RuntimeFormRequest;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }
}

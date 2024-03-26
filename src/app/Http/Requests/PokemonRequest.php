<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * リクエストに対するバリデーションルールを定義するメソッド。
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'string|unique:pokemon,name', 'regex:/^[ぁ-んゝゞー()]+$/u'
        ];
    }

    /**
     * バリデーションエラーメッセージを定義するメソッド。
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.string' => 'ポケモン名が、入力されていません。また、文字列で指定してください。',
            'name.unique' => 'このポケモンは、すでに登録されています。',
        ];
    }
}

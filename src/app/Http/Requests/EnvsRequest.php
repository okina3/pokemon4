<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnvsRequest extends FormRequest
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
            'new_envs' => 'string|unique:envs,name',
        ];
    }

    /**
     * バリデーションエラーメッセージを定義するメソッド。
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'new_envs.string' => '環境が、入力されていません。また、文字列で指定してください。',
            'new_envs.unique' => 'この環境は、すでに登録されています。',
        ];
    }
}

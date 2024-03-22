<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BattleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rank' => 'string ',
            // 相手チームのバリデーション
            'opp_teams.1' => 'required',
            'opp_teams.2' => 'required',
            'opp_teams.3' => 'required',
            'opp_teams.4' => 'required',
            'opp_teams.5' => 'required',
            'opp_teams.6' => 'required',

            // 相手の選出のバリデーション
            'opp_selects.1' => 'required',
            'opp_selects.2' => 'required',
            'opp_selects.3' => 'required',

            // 自分の選出のバリデーション
            'player_selects.1' => 'required',
            'player_selects.2' => 'required',
            'player_selects.3' => 'required',

            'envs' => 'required',
            'judgment' => 'string | nullable ',
            'comment' => 'string | nullable',
        ];
    }
    /**
     * バリデーションエラーメッセージを定義するメソッド。
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'rank.string' => '順位が空です。また、文字列で指定してください。',
            // 相手チームのバリデーション
            'opp_teams.1.required' => '相手のチームの1ポケモンを入力してください。',
            'opp_teams.2.required' => '相手のチームの2ポケモンを入力してください。',
            'opp_teams.3.required' => '相手のチームの3ポケモンを入力してください。',
            'opp_teams.4.required' => '相手のチームの4ポケモンを入力してください。',
            'opp_teams.5.required' => '相手のチームの5ポケモンを入力してください。',
            'opp_teams.6.required' => '相手のチームの6ポケモンを入力してください。',

            // 相手選出のバリデーション
            'opp_selects.1.required' => '相手の選出1ポケモンを入力してください。',
            'opp_selects.2.required' => '相手の選出2ポケモンを入力してください。',
            'opp_selects.3.required' => '相手の選出3ポケモンを入力してください。',

            // 相手選出のバリデーション
            'player_selects.1.required' => '自分の選出1ポケモンを入力してください。',
            'player_selects.2.required' => '自分の選出2ポケモンを入力してください。',
            'player_selects.3.required' => '自分の選出3ポケモンを入力してください。',

            'envs.required' => '環境が空です。選択してください。',
        ];
    }
}

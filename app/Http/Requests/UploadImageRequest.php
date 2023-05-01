<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool //認証されているユーザーが使えるかどうか
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array //バリデーションのルールを作る
    {
        return [
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'files.*.image' => 'required|image|mimes:jpg,jpeg,png|max:2048', 
            // 'files.*.image'の書き方で配列のバリデーションが可能
        ];
    }

    public function messages() //それぞれのエラー発生時のメッセージをカスタマイズする
    {
        return[
            'image' => '指定されたファイルが画像ではありません。',
            'mimes' => '指定された拡張子(jpg/jpeg/png)ではありません。',
            'max' => 'ファイルサイズは2MB以内にしてください。',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        // 投稿を作成する際のバリデーション。タイトルと本文は必ず記載が必要というバリデーション。imageは画像のパスを記載
        return [
            'title' => 'required',
            'body' => 'required',
            'image' => 'file|image|max:1999'
        ];
    }
}

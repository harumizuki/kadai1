<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required|in:1,2,3',
            'email' => 'required|email|max:255',
            'tel' => 'required|regex:/^[0-9\-]+$/|max:15',
            'address' => 'required|string|max:255',
            'building_name' => 'nullable|string|max:255',
            'category_id' => 'required|in:1,2,3,4,5',
            'content' => 'required|string|max:120',
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required' => '姓を入力してください。',
            'first_name.required' => '名を入力してください。',
            'gender.required' => '性別を選択してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'tel.required' => '電話番号を入力してください。',
            'tel.regex' => '電話番号は数字とハイフンで入力してください。',
            'address.required' => '住所を入力してください。',
            'category_id.required' => 'お問い合わせの種類を選択してください。',
            'content.required' => 'お問い合わせ内容を入力してください。',
            'content.max' => 'お問い合わせ内容は120文字以内で入力してください。',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * 判斷用戶是否有權限進行此請求
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 獲取適用於請求的驗證規則
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'sometimes|required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ];
    }

    /**
     * 獲取已定義驗證規則的錯誤訊息
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => '文章標題不能為空',
            'title.max' => '文章標題不能超過 255 個字符',
            'content.required' => '文章內容不能為空',
            'status.in' => '文章狀態無效',
            'published_at.date' => '發布時間格式不正確',
        ];
    }
} 
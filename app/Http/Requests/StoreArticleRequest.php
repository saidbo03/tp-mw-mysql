<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title' => ['required','min:3'],
            'content' => ['required','min:10'],
            'image' => ['nullable','image','max:2048'], // 2MB
        ];
    }
}


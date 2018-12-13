<?php

namespace App\Http\Requests;

use App\Models\ItemCategory;
use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:200|min:3',
            'content' => 'required|string|max:2000|min:3',
            'thumbnail' => 'image|max:102400',
            'category_id' => 'required|in:' . ItemCategory::get()->implode('id', ','),
        ];
    }
}

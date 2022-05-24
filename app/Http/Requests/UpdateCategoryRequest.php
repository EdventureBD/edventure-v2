<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'nullable|numeric',
            'time_allotted' => 'nullable|numeric',
            'full_solutions' => 'nullable|numeric',
            'paper_final' => 'nullable|numeric',
            'subject_final' => 'nullable|numeric',
            'final_exam' => 'nullable|numeric',
            'details' => 'nullable',
            'teachers' => 'nullable|array',
            'routine_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1000',
            'category_video' => 'nullable',
            'offer_price' => 'nullable|numeric|lte:price',
        ];
    }
}

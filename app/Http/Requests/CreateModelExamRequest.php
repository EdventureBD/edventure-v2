<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateModelExamRequest extends FormRequest
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
            'title' => 'required|string',
            'exam_topic_id' => 'required|exists:exam_topics,id',
            'exam_category_id' => 'required|exists:exam_categories,id',
            'question_limit' => 'required|Numeric|min:1',
            'exam_type' => 'required|Numeric',
            'duration' => 'required|Numeric|min:1',
            'negative_marking' => 'required|boolean',
            'negative_marking_value' => 'nullable|Numeric',
            'visibility' => 'nullable|boolean',
            'per_question_marks' => 'nullable|Numeric',
            'total_exam_marks' => 'nullable|Numeric',
            'solution_pdf' => 'nullable|mimes:pdf|max:10000',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:10000',
            'solution_video' => 'nullable|string',
            'exam_price' => 'nullable|Numeric',
        ];
    }
}

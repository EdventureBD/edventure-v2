<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateMcqQuestionRequest extends FormRequest
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
            'question' => 'required',
            'exam_tag_id' => 'required|exists:exam_tags,id',
            'field_1' => 'required',
            'field_2' => 'required',
            'field_3' => 'required',
            'field_4' => 'required',
            'answer' => 'required',
            'explanation' => 'required',
        ];
    }
}

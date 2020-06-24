<?php

namespace App\Http\Requests;

class SheetCreateRequest extends FormRequest
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
        $rules = [];



        foreach(request()->route('form')->questions as $question)
        {
            $rules['questions.' . $question->id] = $question->is_required ? 'required' : '' ;
        }

       return $rules;
    }

    public function messages()
    {
        return [
            'questions.*.required' => 'This field is required',
        ];
    }
}

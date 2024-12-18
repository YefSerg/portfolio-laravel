<?php

/** @noinspection PhpPluralMixedCanBeReplacedWithArrayInspection */

namespace App\Http\Requests\Admin\Project;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $project = $this->route()->parameter('project');

        return [
            'title' => 'required|string|unique:projects,title,'.$project->id,
            'image' => 'nullable|image',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}

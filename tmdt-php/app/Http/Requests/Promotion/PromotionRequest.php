<?php

namespace App\Http\Requests\Promotion;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumb' => 'required',
            'active' => 'required',
        ];
    }
    public function messages(){
        return [
           'name.required' => 'Vui lòng nhập tên khuyến mại',
            'description.required' => 'Vui lòng nhập mô tả khuyến mại',
            'content.required' => 'Vui lòng nhập mô tả chi tiết khuyến mại',
            'thumb.required' => 'Vui lòng tải lên ảnh khuyến mại',
            'active.required' => 'Vui lòng chọn trạng thái kích hoạt',
        ];
    }
}
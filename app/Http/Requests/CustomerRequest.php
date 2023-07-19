<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Chuyển thành true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [];

        // Lấy phương thức đang hoạt động
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'add_customer': // cái name của route
                        $rules = [
                            'name' => 'required',
                            'address' => 'max:255',
                            'email' => 'required',
                            'phone_number' => 'required|max:10',
                            'date_of_birth' => 'required'
                        ];
                        break;
                    
                    default:
                        break;
                }
                break;
        }

        return $rules;
    }

    // Tùy chỉnh thông báo hiển thị
    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc phải điền tên',
            'address.max' => 'Địa chỉ nhập quá dài',
            'email.required' => 'Bắt buộc phải điền tên',
            'email.unique' => 'Email của bạn đã được sử dụng',
        ];
    }
}

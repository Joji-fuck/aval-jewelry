<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRingOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ring_model_id' => ['required', 'exists:ring_models,id'],
            'material_id'   => ['required', 'exists:materials,id'],
            'ring_size'     => ['required', 'numeric', 'min:14', 'max:23'],

            'surname'       => ['required', 'string', 'max:255'],
            'name'          => ['required', 'string', 'max:255'],
            'patronymic'    => ['nullable', 'string', 'max:255'],
            'phone'         => ['required', 'string', 'max:20'],
            'email'         => ['nullable', 'email', 'max:255'],

            'country'       => ['required', 'string', 'max:100'],
            'city'          => ['required', 'string', 'max:100'],
            'street'        => ['required', 'string', 'max:255'],
            'house_number'  => ['required', 'string', 'max:20'],
            'zip_code'      => ['required', 'string', 'max:20'],

            'comment'       => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле обязательно для заполнения',
            'email'    => 'Введите корректный email',
            'numeric'  => 'Должно быть числом',
            'exists'   => 'Выбрано некорректное значение',
        ];
    }

    public function attributes(): array
    {
        return [
            'surname'      => 'Фамилия',
            'name'         => 'Имя',
            'phone'        => 'Телефон',
            'country'      => 'Страна',
            'city'         => 'Город',
            'street'       => 'Улица',
            'house_number' => 'Номер дома',
            'zip_code'     => 'Индекс',
        ];
    }
}

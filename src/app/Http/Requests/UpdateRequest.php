<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\Product;


class UpdateRequest extends FormRequest
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
            'name' => ['required'],
            'price' => ['required', 'numeric', 'min:0', 'max:10000'],
            'image' => ['nullable', 'mimes:png,jpeg'],
            'season' => ['required'],
            'description' => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '0～10000円以内で入力してください',
            'price.max' => '0～10000円以内で入力してください',
            //'image.required' => '画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'season.required' => '季節を選択してください',
            'description.required' => '商品説明をしてください',
            'description.max' => '120文字以内で入力してください',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $productId = $this->route('productId');
            $product = Product::find($productId);

           if (!$this->hasFile('image') && !$product->image) {
            $validator->errors()->add('image', '画像を登録してください');
            }
        });
    }

}

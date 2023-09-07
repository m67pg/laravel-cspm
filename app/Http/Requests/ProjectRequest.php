<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * クラウドソーシングフォームリクエスト
 */
class ProjectRequest extends FormRequest
{
    /**
     * ユーザーがこのリクエストの権限を持っているかを判断する
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * リクエストに適用するバリデーションルールを取得
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:1024',
            'crowd_sourcing_id' => 'required',
            'orderer_id' => 'required',
            'progress_id' => 'required',
            'contract_amount_excluding_tax' => 'numeric|nullable',
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     */
    public function attributes(): array
    {
        return [
            'name' => '名前',
            'crowd_sourcing_id' => 'クラウドソーシング',
            'orderer_id' => '発注者',
            'progress_id' => '進捗',
            'contract_amount_excluding_tax' => '契約金額(税抜)',
        ];
    }
}

<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;

/**
 * マスターリポジトリ
 */
abstract class MasterRepository extends BaseRepository
{
    /**
     * 一覧の取得
     */
    public function get($input = []): mixed
    {
        Log::debug('MasterRepository::get()');

        $list = $this->model->orderByRaw('sort_order, updated_at DESC');

        return array_key_exists('listType', $input) && $input['listType'] == 'page' ? $list->paginate(10) : $list->where('display', 1)->get();
    }
}

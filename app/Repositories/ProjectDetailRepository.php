<?php

namespace App\Repositories;

use App\Models\ProjectDetail;
use Illuminate\Support\Facades\Log;

/**
 * プロジェクト詳細リポジトリ
 */
class ProjectDetailRepository extends BaseRepository
{
    /**
     * プロジェクト詳細モデルの取得
     */
    protected function getModel()
    {
        Log::debug('ProjectDetailRepository::getModel()');

        $this->model = app(ProjectDetail::class);
    }

    /**
     * プロジェクト詳細一覧の取得
     */
    public function get($input = []): mixed
    {
        Log::debug('ProjectDetailRepository::get()');

        $order_by = array_key_exists('order_by', $input) ? $input['order_by'] : 'desc';

        return $this->model
                    ->where('project_id', $input['project_id'])
                    ->whereRaw('display = 1')
                    ->orderByRaw('sort_order ' . $order_by)
                    ->orderByRaw('created_at ' . $order_by)
                    ->get();
    }
}

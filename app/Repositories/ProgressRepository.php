<?php

namespace App\Repositories;

use App\Models\Progress;
use Illuminate\Support\Facades\Log;

/**
 * 進捗リポジトリ
 */
class ProgressRepository extends MasterRepository
{
    /**
     * 進捗モデルの取得
     */
    protected function getModel()
    {
        Log::debug('ProgressRepository::getModel()');

        $this->model = app(Progress::class);
    }
}

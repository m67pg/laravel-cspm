<?php

namespace App\Services;

use App\Repositories\ProgressRepository;
use Illuminate\Support\Facades\Log;

/**
 * 進捗サービス
 */
class ProgressService extends MasterService
{
    /**
     * 進捗リポジトリの取得
     */
    protected function getRepository()
    {
        Log::debug('ProgressService::getRepository()');

        $this->repository = app(ProgressRepository::class);
    }
}

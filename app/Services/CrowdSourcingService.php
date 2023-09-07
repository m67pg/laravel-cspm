<?php

namespace App\Services;

use App\Repositories\CrowdSourcingRepository;
use Illuminate\Support\Facades\Log;

/**
 * クラウドソーシングサービス
 */
class CrowdSourcingService extends MasterService
{
    /**
     * クラウドソーシングリポジトリの取得
     */
    protected function getRepository()
    {
        Log::debug('CrowdSourcingService::getRepository()');

        $this->repository = app(CrowdSourcingRepository::class);
    }
}

<?php

namespace App\Repositories;

use App\Models\CrowdSourcing;
use Illuminate\Support\Facades\Log;

/**
 * クラウドソーシングリポジトリ
 */
class CrowdSourcingRepository extends MasterRepository
{
    /**
     * クラウドソーシングモデルの取得
     */
    protected function getModel()
    {
        Log::debug('CrowdSourcingRepository::getModel()');

        $this->model = app(CrowdSourcing::class);
    }
}

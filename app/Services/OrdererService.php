<?php

namespace App\Services;

use App\Repositories\OrdererRepository;
use Illuminate\Support\Facades\Log;

/**
 * 発注者サービス
 */
class OrdererService extends MasterService
{
    /**
     * 発注者リポジトリの取得
     */
    protected function getRepository()
    {
        Log::debug('OrdererService::getRepository()');

        $this->repository = app(OrdererRepository::class);
    }
}

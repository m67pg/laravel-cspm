<?php

namespace App\Repositories;

use App\Models\Orderer;
use Illuminate\Support\Facades\Log;

/**
 * 発注者リポジトリ
 */
class OrdererRepository extends MasterRepository
{
    /**
     * 発注者モデルの取得
     */
    protected function getModel()
    {
        Log::debug('OrdererRepository::getModel()');

        $this->model = app(Orderer::class);
    }
}

<?php

namespace App\Services;

/**
 * ベースサービスインターフェイス
 */
interface BaseServiceInterface
{
    public function index($params = []): array;
    public function createOrEdit($params = []): array;
    public function storeOrUpdate($params = []);
}

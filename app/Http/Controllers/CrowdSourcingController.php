<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrowdSourcingRequest;
use App\Services\CrowdSourcingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * クラウドソーシングコントローラー
 */
class CrowdSourcingController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     */
    public function __construct(CrowdSourcingService $service)
    {
        Log::debug('CrowdSourcingController::__construct()');

        $this->service = $service;
    }

    /**
     * クラウドソーシング一覧
     */
    public function index(Request $request): JsonResponse
    {
        Log::debug('CrowdSourcingController::index()');

        return response()->json($this->service->index([$request]));
    }

    /**
     * クラウドソーシング作成
     */
    public function create(Request $request): JsonResponse
    {
        Log::debug('CrowdSourcingController::create()');

        return response()->json([ 'data' => $this->service->createOrEdit([$request]) ]);
    }

    /**
     * クラウドソーシング保存
     */
    public function store(CrowdSourcingRequest $request): JsonResponse
    {
        Log::debug('CrowdSourcingController::store()');

        $this->service->storeOrUpdate([$request]);
        return response()->json([ 'success' => 'クラウドソーシングの保存が完了しました。' ]);
    }

    /**
     * クラウドソーシング編集
     */
    public function edit(Request $request, $id): JsonResponse
    {
        Log::debug('CrowdSourcingController::edit()');

        return response()->json([ 'data' => $this->service->createOrEdit([$request, $id]) ]);
    }

    /**
     * クラウドソーシング更新
     */
    public function update(CrowdSourcingRequest $request, $id): JsonResponse
    {
        Log::debug('CrowdSourcingController::update()');

        $this->service->storeOrUpdate([$request, $id]);
        return response()->json([ 'success' => 'クラウドソーシングの更新が完了しました。' ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdererRequest;
use App\Services\OrdererService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * 発注者コントローラー
 */
class OrdererController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     */
    public function __construct(OrdererService $service)
    {
        Log::debug('OrdererController::__construct()');

        $this->service = $service;
    }

    /**
     * 発注者一覧
     */
    public function index(Request $request): JsonResponse
    {
        Log::debug('OrdererController::index()');

        return response()->json($this->service->index([$request]));
    }

    /**
     * 発注者作成
     */
    public function create(Request $request): JsonResponse
    {
        Log::debug('OrdererController::create()');

        return response()->json([ 'data' => $this->service->createOrEdit([$request]) ]);
    }

    /**
     * 発注者保存
     */
    public function store(OrdererRequest $request): JsonResponse
    {
        Log::debug('OrdererController::store()');

        $this->service->storeOrUpdate([$request]);
        return response()->json([ 'success' => '発注者の保存が完了しました。' ]);
    }

    /**
     * 発注者編集
     */
    public function edit(Request $request, $id): JsonResponse
    {
        Log::debug('OrdererController::edit()');

        return response()->json([ 'data' => $this->service->createOrEdit([$request, $id]) ]);
    }

    /**
     * 発注者更新
     */
    public function update(OrdererRequest $request, $id): JsonResponse
    {
        Log::debug('OrdererController::update()');

        $this->service->storeOrUpdate([$request, $id]);
        return response()->json([ 'success' => '発注者の更新が完了しました。' ]);
    }
}

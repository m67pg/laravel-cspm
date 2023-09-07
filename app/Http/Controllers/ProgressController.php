<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgressRequest;
use App\Services\ProgressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * 進捗コントローラー
 */
class ProgressController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     */
    public function __construct(ProgressService $service)
    {
        Log::debug('ProgressController::__construct()');

        $this->service = $service;
    }

    /**
     * 進捗一覧
     */
    public function index(Request $request): JsonResponse
    {
        Log::debug('ProgressController::index()');

        return response()->json($this->service->index([$request]));
    }

    /**
     * 進捗作成
     */
    public function create(Request $request): JsonResponse
    {
        Log::debug('ProgressController::create()');

        return response()->json([ 'data' => $this->service->createOrEdit([$request]) ]);
    }

    /**
     * 進捗保存
     */
    public function store(ProgressRequest $request): JsonResponse
    {
        Log::debug('ProgressController::store()');

        $this->service->storeOrUpdate([$request]);
        return response()->json([ 'success' => '進捗の保存が完了しました。' ]);
    }

    /**
     * 進捗編集
     */
    public function edit(Request $request, $id): JsonResponse
    {
        Log::debug('ProgressController::edit()');

        return response()->json([ 'data' => $this->service->createOrEdit([$request, $id]) ]);
    }

    /**
     * 進捗更新
     */
    public function update(ProgressRequest $request, $id): JsonResponse
    {
        Log::debug('ProgressController::update()');

        $this->service->storeOrUpdate([$request, $id]);
        return response()->json([ 'success' => '進捗の更新が完了しました。' ]);
    }
}

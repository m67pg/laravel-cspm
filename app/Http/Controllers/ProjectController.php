<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * プロジェクトコントローラー
 */
class ProjectController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     */
    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    /**
     * プロジェクト一覧
     */
    public function index(Request $request): JsonResponse
    {
        Log::debug('ProjectController::index()');

        $projectInfo = $this->service->index([$request]);
        return response()->json([ 'list' => compact('projectInfo') ]);
    }

    /**
     * プロジェクト作成
     */
    public function create(): JsonResponse
    {
        Log::debug('ProjectController::create()');

        $projectInfo = $this->service->createOrEdit();
        return response()->json([ 'data' => compact('projectInfo') ]);
    }

    /**
     * プロジェクト保存
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        Log::debug('ProjectController::store()');

        $this->service->storeOrUpdate([$request]);
        return response()->json([ 'success' => 'プロジェクトの保存が完了しました。' ]);
    }

    /**
     * プロジェクト編集
     */
    public function edit($id): JsonResponse
    {
        Log::debug('ProjectController::edit()');

        $projectInfo = $this->service->createOrEdit([$id]);
        return response()->json([ 'data' => compact('projectInfo') ]);
    }

    /**
     * プロジェクト更新
     */
    public function update(ProjectRequest $request, $id): JsonResponse
    {
        Log::debug('ProjectController::update()');

        $this->service->storeOrUpdate([$request, $id]);
        return response()->json([ 'success' => 'プロジェクトの更新が完了しました。' ]);
    }

    /**
     * プロジェクト情報の表示
     */
    public function show(Request $request, $id): JsonResponse
    {
        Log::debug('ProjectController::show()');

        $projectInfo = $this->service->show([$id]);
        return response()->json([ 'data' => compact('projectInfo') ]);
    }
}

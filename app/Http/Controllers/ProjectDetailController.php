<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectDetailRequest;
use App\Services\ProjectDetailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * プロジェクト詳細コントローラー
 */
class ProjectDetailController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     */
    public function __construct(ProjectDetailService $service)
    {
        Log::debug('ProjectDetailController::__construct()');

        $this->service = $service;
    }

    /**
     * プロジェクト詳細一覧
     */
    public function index($project_id): JsonResponse
    {
        Log::debug('ProjectDetailController::index()');

        $projectDetailInfo = $this->service->index([$project_id]);
        return response()->json([ 'list' => compact('projectDetailInfo') ]);
    }

    /**
     * プロジェクト詳細作成
     */
    public function create($project_id): JsonResponse
    {
        Log::debug('ProjectDetailController::create()');

        $projectDetailInfo = $this->service->createOrEdit([$project_id]);
        return response()->json([ 'data' => compact('projectDetailInfo') ]);
    }

    /**
     * プロジェクト詳細保存
     */
    public function store(ProjectDetailRequest $request, $project_id): JsonResponse
    {
        Log::debug('ProjectDetailController::store()');

        $this->service->storeOrUpdate([$request->merge(['project_id' => $project_id])]);
        return response()->json([ 'success' => 'プロジェクト詳細の保存が完了しました。' ]);
    }

    /**
     * プロジェクト詳細編集
     */
    public function edit($project_id, $id): JsonResponse
    {
        Log::debug('ProjectDetailController::edit()');

        $projectDetailInfo = $this->service->createOrEdit([$project_id, $id]);
        return response()->json([ 'data' => compact('projectDetailInfo') ]);
    }

    /**
     * プロジェクト詳細更新
     */
    public function update(ProjectDetailRequest $request, $project_id, $id): JsonResponse
    {
        Log::debug('ProjectDetailController::update()');

        $this->service->storeOrUpdate([$request, $id]);
        return response()->json([ 'success' => 'プロジェクト詳細の更新が完了しました。' ]);
    }

    /**
     * プロジェクト詳細ファイルのダウンロード
     */
    public function download($project_id, $id): StreamedResponse
    {
        Log::debug('ProjectDetailController::download()');

        return $this->service->download($id);
    }
}

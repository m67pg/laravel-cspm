<?php

namespace App\Services;

use App\Repositories\ProjectDetailRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * プロジェクト詳細サービス
 */
class ProjectDetailService implements BaseServiceInterface
{
    private $projectDetailRepository;

    /**
     * 新しいインスタンスの生成
     */
    public function __construct(ProjectDetailRepository $projectDetailRepository)
    {
        Log::debug('ProjectDetailService::__construct()');

        $this->projectDetailRepository = $projectDetailRepository;
    }

    /**
     * プロジェクト詳細一覧の取得
     */
    public function index($params = []): array
    {
        Log::debug('ProjectDetailService::index()');

        $project_id = $params[0];

        $projectDetailInfo = array();
        $projectDetailInfo['project_id'] = $project_id;
        $projectDetailInfo['project_details'] = $this->projectDetailRepository->get(['project_id' => $project_id]);
        return $projectDetailInfo;
    }

    /**
     * プロジェクト詳細の作成・編集
     */
    public function createOrEdit($params = []): array
    {
        Log::debug('ProjectDetailService::createOrEdit()');

        $project_id = $params[0];
        $id = array_key_exists(1, $params) ? $params[1] : 0;

        $projectDetailInfo = array();
        $projectDetailInfo['project_id'] = $project_id;
        if ($id > 0) {
            $projectDetailInfo['project_detail'] = $this->projectDetailRepository->find($id);
        }
        return $projectDetailInfo;
    }

    /**
     * プロジェクト詳細の保存・更新
     */
    public function storeOrUpdate($params = [])
    {
        Log::debug('ProjectDetailService::storeOrUpdate()');

        DB::transaction(function () use ($params) {
            $request = $params[0];
            $id = array_key_exists(1, $params) ? $params[1] : 0;

            // アップロードファイルの削除するボタン
            if ($request->has('delete_button') && $request->input('delete_button') == 1) {
                $projectDetail = $this->projectDetailRepository->find($id);
                $file_name = $projectDetail->id . '-' . $projectDetail->upload_file;
                $projectDetail->upload_file = null;
                $projectDetail->save();

                Storage::delete('public/' . $file_name);
            }
            // 登録するボタンまたは編集するボタン
            else
            {
                $projectDetail = $this->projectDetailRepository->save($request->all(), $id);
                if ($request->file('upload_file')) {
                    $projectDetail->upload_file = $request->file('upload_file')->getClientOriginalName();
                    $projectDetail->save();

                    // アップロードしたファイルはpublic\storage(storage\app\public)に保存
                    // なおファイル名は「プロジェクト詳細ID-アップロードしたファイルの名前」に変更して保存
                    $request->file('upload_file')->storeAs('public', $projectDetail->id . '-' . $projectDetail->upload_file);
                }
            }
        });
    }

    /**
     * プロジェクト詳細ファイルのダウンロード
     */
    public function download($id): StreamedResponse
    {
        Log::debug('ProjectDetailService::download()');

        $projectDetail = $this->projectDetailRepository->find($id);
        $path = 'public/' . $projectDetail->id . '-' . $projectDetail->upload_file;
        $name = $projectDetail->upload_file;
        $mimeType = Storage::mimeType($path);
        $headers = [['Content-Type' => $mimeType]];
        return Storage::download($path, $name, $headers);
    }
}

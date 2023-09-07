<?php

namespace App\Services;

use App\Repositories\CrowdSourcingRepository;
use App\Repositories\OrdererRepository;
use App\Repositories\ProgressRepository;
use App\Repositories\ProjectDetailRepository;
use App\Repositories\ProjectProgressRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * プロジェクトサービス
 */
class ProjectService implements BaseServiceInterface
{
    private $crowdSourcingRepository;
    private $ordererRepository;
    private $progressRepository;
    private $projectProgressRepository;
    private $projectRepository;

    /**
     * 新しいインスタンスの生成
     */
    public function __construct(CrowdSourcingRepository $crowdSourcingRepository,
                                OrdererRepository $ordererRepository,
                                ProgressRepository $progressRepository,
                                ProjectDetailRepository $projectDetailRepository,
                                ProjectProgressRepository $projectProgressRepository,
                                ProjectRepository $projectRepository)
    {
        Log::debug('ProjectService::__construct()');

        $this->crowdSourcingRepository = $crowdSourcingRepository;
        $this->ordererRepository = $ordererRepository;
        $this->progressRepository = $progressRepository;
        $this->projectDetailRepository = $projectDetailRepository;
        $this->projectProgressRepository = $projectProgressRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * プロジェクト一覧の取得
     */
    public function index($params = []): array
    {
        Log::debug('ProjectService::index()');

        $request = $params[0];
        $projectInfo = $this->getProjectInfo();
        $projectInfo['projects'] = $this->projectRepository->get($request->all());
        return $projectInfo;
    }

    /**
     * プロジェクトの作成・編集
     */
    public function createOrEdit($params = []): array
    {
        Log::debug('ProjectService::createOrEdit()');

        $id = array_key_exists(0, $params) ? $params[0] : 0;

        $projectInfo = $this->getProjectInfo();
        $projectInfo['current_progress_id'] = 0;
        if ($id > 0) {
            $projectInfo['project'] = $this->projectRepository->find($id);
            $project_progress = $this->projectProgressRepository->find($id);
            $projectInfo['current_progress_id'] = $project_progress->count() == 0 ? 0 : $project_progress[0]->progress_id;
        }

        return $projectInfo;
    }

    /**
     * プロジェクトの保存・更新
     */
    public function storeOrUpdate($params = [])
    {
        Log::debug('ProjectService::storeOrUpdate()');

        DB::transaction(function () use ($params) {
            $request = $params[0];
            $id = array_key_exists(1, $params) ? $params[1] : 0;
            $project = $this->projectRepository->save($request->all(), $id);
            $this->projectProgressRepository->save(['project_id' => $project->id, 'progress_id' =>$request->input('progress_id', 0)]);
        });
    }

    /**
     * プロジェクトの表示
     */
    public function show($params = []): array
    {
        Log::debug('ProjectService::show()');

        $id = array_key_exists(0, $params) ? $params[0] : 0;

        if ($id > 0) {
            $projectInfo['project'] = $this->projectRepository->getById($id);

            if (array_key_exists(0, $projectInfo['project'])) {
                $projectInfo['project'] = $projectInfo['project'][0];
                $project_progress = $this->projectProgressRepository->find($id);
                $current_progress_id = $project_progress->count() == 0 ? 0 : $project_progress[0]->progress_id;
                $projectInfo['current_progress'] = $this->progressRepository->find($current_progress_id);
                $projectInfo['project_progresses'] = $this->projectProgressRepository->get([$id]);
                $projectInfo['project_details'] = $this->projectDetailRepository->get(['project_id' => $id, 'order_by' => 'asc']);
            } else {
                unset($projectInfo['project']);
            }
        }

        return $projectInfo;
    }

    /**
     * 選択一覧の取得
     */
    private function getProjectInfo(): array
    {
        $projectInfo = array();
        $projectInfo['crowd_sourcings'] = $this->crowdSourcingRepository->get();
        $projectInfo['orderers'] = $this->ordererRepository->get();
        $projectInfo['progresses'] = $this->progressRepository->get();

        return $projectInfo;
    }

}

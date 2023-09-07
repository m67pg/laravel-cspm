<?php

namespace App\Repositories;

use App\Models\ProjectProgress;
use Illuminate\Support\Facades\Log;

/**
 * プロジェクト進捗リポジトリ
 */
class ProjectProgressRepository extends BaseRepository
{
    /**
     * プロジェクト進捗モデルの取得
     */
    protected function getModel()
    {
        Log::debug('ProjectProgressRepository::getModel()');

        $this->model = app(ProjectProgress::class);
    }

    /**
     * プロジェクト進捗一覧の取得
     */
    public function get($input = []): mixed
    {
        Log::debug('ProjectProgressRepository::get()');

        $id = array_key_exists(0, $input) ? $input[0] : 0;

        return $this->model->select('progresses.name', 'project_progresses.created_at')
                           ->join('progresses', 'project_progresses.progress_id', '=', 'progresses.id')
                           ->where('project_progresses.project_id', $id)
                           ->where('progresses.display', 1)
                           ->orderByDesc('project_progresses.created_at')
                           ->get();
    }

    /**
     * プロジェクト進捗モデルを取得
     */
    public function find($id): mixed
    {
        Log::debug('ProjectProgressRepository::find()');

        return $this->model->select('project_progresses.*')
                           ->join('progresses', 'project_progresses.progress_id', '=', 'progresses.id')
                           ->where('project_progresses.project_id', $id)
                           ->where('progresses.display', 1)
                           ->orderByDesc('project_progresses.created_at')
                           ->limit(1)
                           ->get();
    }

    /**
     * プロジェクト進捗モデルの保存
     */
    public function save($input, $id = 0): mixed
    {
        Log::debug('ProjectProgressRepository::save()');

        $project_id = array_key_exists('project_id', $input) ? $input['project_id'] : 0;
        $progress_id = array_key_exists('progress_id', $input) ? $input['progress_id'] : 0;

        $project_progress = $this->find($project_id);
        $current_progress_id = $project_progress->count() == 0 ? 0 : $project_progress[0]->progress_id;
        if ($current_progress_id == 0 ||
           ($current_progress_id > 0 && $current_progress_id != $progress_id)) {
            $this->model->fill($input)->save();
        }

        return $project_progress;
    }
}

<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;

/**
 * ベースリポジトリ
 */
abstract class BaseRepository
{
    protected $model;

    /**
     * 新しいインスタンスの生成
     */
    public function __construct()
    {
        Log::debug('BaseRepository::__construct()');

        $this->getModel();
    }

    /**
     * モデルの取得
     */
    abstract protected function getModel();

    /**
     * モデル名の取得
     */
    public function getModelName(): string
    {
        $model_name = '';
        // ネームスペース付のモデル名を「\」で分割してモデル名のみ取得。さらにモデル名を１文字ずつに分割して配列に取得
        $model_name_split = mb_str_split(array_slice(explode('\\', get_class($this->model)), -1)[0]);

        // モデル名を１文字ずつ処理して大文字を小文字に変換。さらに小文字変換前に１文字目以外の大文字には「_」を追加
        foreach ($model_name_split as $key => $value) {
            if (ctype_upper($value)) {
                if ($key > 0) {
                    $model_name .= '_';
                }
                $model_name .= mb_strtolower($value);
            } else {
                $model_name .= $value;
            }
        }

        return $model_name;
    }

    /**
     * テーブル名の取得
     */
    public function getTableName(): string
    {
        return $this->model->getTable();
    }

    /**
     * 一覧の取得
     */
    abstract public function get($input = []): mixed;

    /**
     * モデルの取得
     */
    public function find($id): mixed
    {
        Log::debug('BaseRepository::find()');

        return $this->model->find($id);
    }

    /**
     * モデルの保存
     */
    public function save($input, $id = 0): mixed
    {
        Log::debug('BaseRepository::save()');

        if ($id == 0) {
            $base = $this->model;
        } else {
            $base = $this->model->find($id);
        }
        $base->fill($input)->save();

        return $base;
    }
}

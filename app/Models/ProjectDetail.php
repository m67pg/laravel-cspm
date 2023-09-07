<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * プロジェクト詳細モデル
 */
class ProjectDetail extends Model
{
    use HasFactory;

    /**
     * 複数代入可能な属性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'project_id',
        'message',
        'upload_file',
        'sort_order',
        'display',
    ];
}

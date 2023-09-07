<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * プロジェクトモデル
 */
class Project extends Model
{
    use HasFactory;

    /**
     * 複数代入可能な属性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'crowd_sourcing_id',
        'orderer_id',
        'publication_on',
        'application_deadline_on',
        'contract_amount_excluding_tax',
        'display',
    ];
}

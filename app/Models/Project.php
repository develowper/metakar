<?php

namespace App\Models;

use App\Http\Helpers\Variable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'id',
        'title',
        'info',
//        'items',
        'owner_id',
        'operators', // [id,role,status,commission,]
        'status',
        'price',
        'data',
//        'data_id',
//        'data_type',
        'payed_at',
        'created_at',
        'updated_at',
    ];

    public static function operatorFinish(mixed $projectItem)
    {
        $project = null;
        if ($projectItem)
            $project = Project::find($projectItem->project_id);
        if (!$projectItem || !$project)
            return back()->with(['flash_status' => 'danger', 'flash_message' => __('project_not_found')]);
        $operator = User::find($projectItem->operator_id);
        if (!$operator)
            return back()->with(['flash_status' => 'danger', 'flash_message' => __('operator_not_found')]);
        if (in_array($projectItem->status, ['cancel', 'done']) || in_array($project->status, ['cancel', 'done']))
            return back()->with(['flash_status' => 'danger', 'flash_message' => __('project_done_or_cancel')]);
        $projectItem->status = 'pay';
        if ($projectItem->save())
            return back()->with(['flash_status' => 'success', 'flash_message' => __('updated_successfully'), 'extra' => ['project_status' => 'pay']]);

    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function items()
    {
        return $this->hasMany(ProjectItem::class, 'project_id');
    }

    public function operators()
    {
        return $this->items ? array_column(is_string($this->items) ? json_decode($this->items) : $this->items, 'op') : [];
    }
}

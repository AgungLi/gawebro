<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tool extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'icon'
    ];

    public function project(){
        return $this->belongsToMany(Project::class, 'project_tools', 'tool_id', 'project_id')
        ->wherePivotNotNull('deleted_at')
        ->withPivot('id');
    }
}

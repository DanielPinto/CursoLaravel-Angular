<?php

namespace codeproject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectNote extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'proj_id',
        'title',
        'note',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }



}

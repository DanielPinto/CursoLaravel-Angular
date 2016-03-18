<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 13/03/2016
 * Time: 20:38
 */

namespace codeproject\Transformers;

use codeproject\Entities\ProjectNote;
use codeproject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{


    public function transform(ProjectTask $task)
    {
        return [

            'id'=>$task->id,
            'project_id'=>$task->project_id,
            'name'=>$task->name,
            'start_date'=>$task->start_date,
            'due_date'=>$task->due_date,
            'status'=>$task->status,
        ];
    }


}
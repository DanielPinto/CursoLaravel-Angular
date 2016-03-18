<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 13/03/2016
 * Time: 20:38
 */

namespace codeproject\Transformers;

use codeproject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{

   protected $defaultIncludes=['members'];


    public function transform(Project $project)
    {
        return [

            'project_id'=>$project->id,
            'user_id'=>$project->user_id,
            'client_id'=>$project->client_id,
            'name'=>$project->name,
            'description'=>$project->description,
            'progress'=>$project->progress,
            'status'=>$project->status,
            'due_date'=>$project->due_date,

        ];
    }




    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

}
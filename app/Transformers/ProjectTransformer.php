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

    protected $defaultIncludes = ['members','notes','tasks','files','clients'];


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
            'is_member'=>$project->user_id != \Authorizer::getResourceOwnerId(),
            'tasks_count' => $project->tasks->count(),
            'tasks_opened' => $this->countTasksOpened($project)

        ];
    }




    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new MemberTransformer());
    }



    public function includeNotes(Project $project)
    {
       return $this->collection($project->note, new ProjectNoteTransformer());
     }


   public function includeTasks(Project $project)
   {
       return $this->collection($project->tasks, new ProjectTaskTransformer());
   }


   public function includeFiles(Project $project)
   {
       return $this->collection($project->files, new ProjectFilesTransformer());
   }


    public function includeClients(Project $project)
    {
            if($project->client) {
                return $this->item($project->client, new ClientTransformer());
            }
            return null;
    }


    public function countTasksOpened(Project $project){
       $count = 0;
       foreach($project->tasks as $o){
           if($o->status == 1){
               $count++;
           }
       }
       return $count;
   }

}

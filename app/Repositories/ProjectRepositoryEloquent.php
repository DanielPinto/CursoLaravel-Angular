<?php

namespace codeproject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use codeproject\Repositories\ProjectRepository;
use codeproject\Entities\Project;
use codeproject\Presenters\ProjectPresenter;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace codeproject\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }





    public function isOwner($projectId , $userId){

    	if(count($this->skipPresenter()->findWhere(['id'=>$projectId , 'user_id'=>$userId]))){

    		return true;

    	}

    	return false;

    }


    public function findOwner($userId , $limit = null , $columns = array() ){

        return $this->scopeQuery(function ($query) use ($userId){

               return $query->select('projects.*')->where('user_id','=',$userId);

           })->paginate($limit,$columns);


    }


/*

   public function findProjectWithOwnerAndMember($userId){

       return $this->scopeQuery(function ($query) use ($userId){

               return $query->select('projects.*')
                   ->leftJoin('project_members','project_members.project_id','=','project_id')
                   ->where('project_members.member_id','=',$userId)
                   ->union($this->model->query()->getQuery()->where('user_id','=',$userId));
           })->all();
   }

   */


    public function hasMember($projectId , $memberId){

    	$project = $this->skipPresenter()->find($projectId);

    	foreach($project->members as $member)
    	{
    		if($member->id == $memberId)
    		{
    			return true;
    		}
    	}

    	return false;
    }


 /*

    public function presenter()
    {
        return ProjectPresenter::class;
    }
*/
}

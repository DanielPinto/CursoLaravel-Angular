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
    
    	if(count($this->findWhere(['id'=>$projectId , 'user_id'=>$userId]))){
    
    		return true;
    
    	}
    
    	return false;
    
    }
    
    
    public function hasMember($projectId , $memberId){
    
    	$project = $this->find($projectId);
    
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

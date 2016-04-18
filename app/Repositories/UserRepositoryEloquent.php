<?php

namespace codeproject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use codeproject\Presenters\ProjectMemberPresenter;
use codeproject\Entities\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace codeproject\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

   /*
    public function presenter()
    {
        return ProjectMemberPresenter::class;
    }
   */
}

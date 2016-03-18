<?php

namespace codeproject\Repositories;

use codeproject\Presenters\ProjectFilesPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use codeproject\Repositories\ProjectFileRepository;
use codeproject\Entities\ProjectFile;

/**
 * Class ProjectFileRepositoryEloquent
 * @package namespace codeproject\Repositories;
 */
class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectFile::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ProjectFilesPresenter::class;
    }
}

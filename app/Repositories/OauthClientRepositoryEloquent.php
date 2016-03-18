<?php

namespace codeproject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use codeproject\Repositories\OauthClientRepository;
use codeproject\Entities\OauthClient;

/**
 * Class OauthClientRepositoryEloquent
 * @package namespace codeproject\Repositories;
 */
class OauthClientRepositoryEloquent extends BaseRepository implements OauthClientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OauthClient::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

<?php

namespace codeproject\Repositories;

use codeproject\Entities\Client;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ClientRepositoryEloquent
 * @package namespace codeproject\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

    protected $fieldSearchable = [
        'nome',
        'email'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
    }

    /**
     * Boot up the repository, pushing criteria

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

     */


   public function boot(){

       $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

   }

    /*
     public function presenter()
     {
         return ClientPresenter::class;
     }
  */
}

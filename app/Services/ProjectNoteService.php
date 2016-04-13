<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 11/04/2016
 * Time: 12:43
 */

namespace codeproject\Services;


use codeproject\Repositories\ProjectNoteRepository;

class ProjectNoteService
{


    /**
     * @var ProjectNoteRepository
     */
    private $repository;

    public function __construct(ProjectNoteRepository $repository)
    {

        $this->repository = $repository;
    }


    public function create($data){


        try{

           return $this->repository->create($data);

        }catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

}
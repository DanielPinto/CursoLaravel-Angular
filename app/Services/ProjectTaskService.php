<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:47
 */

namespace codeproject\Services;
use codeproject\Repositories\ProjectRepository;
use codeproject\Repositories\ProjectTaskRepository;
use codeproject\Validators\ProjectTaskValidator;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService
{


    /**
     * @var ProjectTaskValidator
     */
    private $validator;
    /**
     * @var ProjectTaskRepository
     */
    private $repository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * ProjectTaskService constructor.
     * @param ProjectTaskValidator $validator
     * @param ProjectRepository $projectRepository
     * @param ProjectTaskRepository $repository
     */
    public function __construct(ProjectTaskValidator $validator , ProjectRepository $projectRepository, ProjectTaskRepository $repository)
    {


        $this->validator = $validator;
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
    }


    /**
     * @param array $data
     * @return array|mixed
     */
    public function create(array $data){

        try{

            $this->validator->with($data)->passesOrFail();
            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);

            $projectTask = $project->tasks()->create($data);

            return $projectTask;

        }catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];

        }




    }



    public function update(array $data , $id){

        try{

            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data,$id);

        }catch (ValidatorException $e){

            return [
                'error'=>true,
                'message'=>$e->getMessageBag()
            ];

        }


    }

    

    public function destroy($id){


        try {


            $projectTask = $this->repository->skipPresenter()->find($id);

            $projectTask->delete($id);

            return [
                'success'=>true,
                'message' => 'task deletada com sucesso!'
            ];


        } catch (ModelNotFoundException $e) {

            return [
                'error' => true,
                'message' => 'task nao encontrado!'
            ];

        } catch (QueryException $e) {

            return [
                'error' => true,
                'message' => 'Erro'
            ];

        } catch (Exception $e) {

            return [
                'error' => true,
                'message' => 'Ocorreu algum erro ao deletar este task'
            ];

        }

       }




}
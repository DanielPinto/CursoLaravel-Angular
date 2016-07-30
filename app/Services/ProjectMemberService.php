<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:47
 */

namespace codeproject\Services;
use codeproject\Repositories\ProjectMemberRepository;
use codeproject\Validators\ProjectMemberValidator;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService
{


    /**
     * @var ProjectMemberValidator
     */
    private $validator;
    /**
     * @var ProjectMemberRepository
     */
    private $repository;

    public function __construct(ProjectMemberValidator $validator , ProjectMemberRepository $repository)
    {


        $this->validator = $validator;
        $this->repository = $repository;
    }







    public function create(array $data){

        try{

            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);

        }catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];

        }




    }






    public function destroy($id){

        try {

            $projectMember = $this->repository->skipPresenter()->find($id);
            $projectMember->delete();


            return [
                'success'=>true,
                'message'=>'membro deletado com sucesso!'

            ];



        } catch (ModelNotFoundException $e) {

            return [
                'error'=>true,
                'message'=>'membro nao Existe!.'
            ];


        }catch (QueryException $e) {

            return [
                'error'=>true,
                'message'=>'membro nao pode ser apagado pois existe um ou mais clientes vinculados a ele.'
            ];

        }catch (Exception $e) {

            return [
                'error'=>true,
                'message'=>'Ocorreu algum erro ao excluir o membro.'
            ];

        }
    }



}
<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:47
 */

namespace codeproject\Services;
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

    public function __construct(ProjectTaskValidator $validator , ProjectTaskRepository $repository)
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




    public function show($id)
    {

        try{

            $data =  $this->repository->with(['client' , 'user'])->find($id);

            if(count($data)>0){
                return $data;
            }
            else{
                return [
                    'error'=>true,
                    'message'=>'Este Projeto não Existe'
                ];
            }

        }catch (ModelNotFoundException $e) {

            return [
                'error'=>true,
                'message'=>'Projeto nao encontrado!'
            ];

        }catch (QueryException $e){

            return[
                'error'=>true,
                'message'=>'Erro'
            ];

        }catch (Exception $e){

            return[
                'error'=>true,
                'message'=>'Ocorreu algum erro ao buscar este projeto'
            ];

        }



    }



    public function index(){


        try{

            $data =  $this->repository->with(['client' , 'user'])->all();

            if(count($data)>0){
                return $data;
            }
            else{
                return [
                    'error'=>true,
                    'message'=>'Nao existem projetos cadastrados'
                ];
            }
        }catch (ModelNotFoundException $e) {

            return [
                'error'=>true,
                'message'=>'nenhum Projeto nao encontrado!'
            ];

        }catch (QueryException $e){

            return[
                'error'=>true,
                'message'=>'Erro'
            ];

        }catch (Exception $e){

            return[
                'error'=>true,
                'message'=>'Ocorreu algum erro ao buscar os projetos'
            ];

        }

    }



    public function destroy($id){

        try {


             $this->repository->delete($id);


            return [
                'success'=>true,
                'message'=>'Projeto deletado com sucesso!'

            ];



        } catch (ModelNotFoundException $e) {

            return [
                'error'=>true,
                'message'=>'Projeto nao Existe!.'
            ];


        }catch (QueryException $e) {

            return [
                'error'=>true,
                'message'=>'Projeto nao pode ser apagado pois existe um ou mais clientes vinculados a ele.'
            ];

        }catch (Exception $e) {

            return [
                'error'=>true,
                'message'=>'Ocorreu algum erro ao excluir o projeto.'
            ];

        }
    }



}
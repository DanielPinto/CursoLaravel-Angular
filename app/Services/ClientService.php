<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:47
 */

namespace codeproject\Services;
use codeproject\Repositories\ClientRepository;
use codeproject\Validators\ClientValidator;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{

    /**
     * @var ClientValidator
     */
    private $validator;
    /**
     * @var ClientRepository
     */
    private $repository;


    public function __construct(ClientValidator $validator , ClientRepository $repository)
    {

        $this->validator = $validator;
        $this->repository = $repository;
    }






    public function create(array $data){

        try{

            $this->validator->with($data)->passesOrFail();
            return $this->repository->skipPresenter()->create($data);

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
            return $this->repository->skipPresenter()->update($data,$id);

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

            $data =  $this->repository->find($id);

            if(count($data)>0){
                return $data;
            }
            else{
                return [
                    'error'=>true,
                    'message'=>'Este Cliente não Existe'
                ];
            }

        }catch (ModelNotFoundException $e) {

            return [
                'error'=>true,
                'message'=>'Cliente nao encontrado!'
            ];

        }catch (QueryException $e){

            return[
                'error'=>true,
                'message'=>'Erro'
            ];

        }catch (Exception $e){

            return[
                'error'=>true,
                'message'=>'Ocorreu algum erro ao buscar este Cliente'
            ];

        }



    }



    public function index(){


        try{

            $data =  $this->repository->all();

            if(count($data)>0){
                return $data;
            }
            else{
                return [
                    'error'=>true,
                    'message'=>'Nao existem clientes cadastrados'
                ];
            }
        }catch (ModelNotFoundException $e) {

            return [
                'error'=>true,
                'message'=>'nenhum cliente encontrado!'
            ];

        }catch (QueryException $e){

            return[
                'error'=>true,
                'message'=>'Erro'
            ];

        }catch (Exception $e){

            return[
                'error'=>true,
                'message'=>'Ocorreu algum erro ao buscar os clientes'
            ];

        }

    }



    public function destroy($id){

        try {


            $this->repository->delete($id);


            return [
                'success'=>true,
                'message'=>'cliente deletado com sucesso!'

            ];



        } catch (ModelNotFoundException $e) {

            return [
                'error'=>true,
                'message'=>'cliente não Existe!.'
            ];


        }catch (QueryException $e) {

            return [
                'error'=>true,
                'message'=>'cliente nao pode ser apagado!'
            ];

        }catch (Exception $e) {

            return [
                'error'=>true,
                'message'=>'Ocorreu algum erro ao excluir o cliente.'
            ];

        }
    }






}
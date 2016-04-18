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



    public function show($noteId)
    {

        try{


           return  $this->repository->find($noteId);


        }catch (ModelNotFoundException $e) {

            return [
                'error'=>true,
                'message'=>'nota nao encontrado!'
            ];

        }catch (QueryException $e){

            return[
                'error'=>true,
                'message'=>'Erro'
            ];

        }catch (Exception $e){

            return[
                'error'=>true,
                'message'=>'Ocorreu algum erro ao buscar este nota'
            ];

        }



    }




    public function update(array $data, $idNote)
    {


        try{

            return $this->repository->update($data,$idNote);

        }catch (ValidatorException $e){

            return [
                'error'=>true,
                'message'=>$e->getMessageBag()
            ];

        }

    }





    public function delete($noteId)
    {

        try {


            $this->repository->delete($noteId);

             return [
                'success'=>true,
                'message' => 'nota deletada com sucesso!'
            ];


        } catch (ModelNotFoundException $e) {

            return [
                'error' => true,
                'message' => 'nota nao encontrado!'
            ];

        } catch (QueryException $e) {

            return [
                'error' => true,
                'message' => 'Erro'
            ];

        } catch (Exception $e) {

            return [
                'error' => true,
                'message' => 'Ocorreu algum erro ao deletar este nota'
            ];

        }
    }

    }
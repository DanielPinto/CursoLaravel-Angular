<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:47
 */

namespace codeproject\Services;

use codeproject\Repositories\ProjectMemberRepository;
use codeproject\Repositories\ProjectRepository;
use codeproject\Validators\ProjectMemberValidator;
use codeproject\Validators\ProjectValidator;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;


class ProjectService
{


    /**
     * @var ProjectValidator
     */
    private $validator;
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectMemberRepository
     */
    private $repositoryMember;
    /**
     * @var ProjectMemberValidator
     */
    private $validatorMember;


  

    public function __construct(ProjectValidator $validator,
                                ProjectRepository $repository,
                                ProjectMemberRepository $repositoryMember,
                                ProjectMemberValidator $validatorMember
                                )
    {

        $this->validator = $validator;
        $this->repository = $repository;
        $this->repositoryMember = $repositoryMember;
        $this->validatorMember = $validatorMember;
    
    }


    public function create(array $data)
    {

        try {

            $this->validator->with($data)->passesOrFail();
            $this->repository->create($data);

            return [
                'success' => true,
                'message' => 'Projeto criado com sucesso!',

            ];

        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag(),
            ];
        } catch (QueryException $e) {

            return [
                'error' => true,
                'message' => 'Erro ao Inserir os dados na Base!',
            ];

        } catch (\Exception $e) {

            return [
                'error' => true,
                'message' => 'Ocorreu algum Erro',
            ];
        }


    }


    public function update(array $data, $id)
    {

        try {

            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);

        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];

        }


    }


    public function show($id)
    {

        try {

            //$data =
                return $this->repository->with(['client', 'user'])->find($id);

            if (count($data) > 0) {
                return $data;
            } else {
                return [
                    'error' => true,
                    'message' => 'Este Projeto n�o Existe'
                ];
            }

        } catch (ModelNotFoundException $e) {

            return [
                'error' => true,
                'message' => 'Projeto nao encontrado!'
            ];

        } catch (QueryException $e) {

            return [
                'error' => true,
                'message' => 'Erro'
            ];

        } catch (Exception $e) {

            return [
                'error' => true,
                'message' => 'Ocorreu algum erro ao buscar este projeto'
            ];

        }


    }


    public function index()
    {


        try {

            $data = $this->repository->with(['client', 'user'])->all();

            if (count($data) > 0) {
                return $data;
            } else {
                return [
                    'error' => true,
                    'message' => 'Nao existem projetos cadastrados'
                ];
            }
        } catch (ModelNotFoundException $e) {

            return [
                'error' => true,
                'message' => 'nenhum Projeto nao encontrado!'
            ];

        } catch (QueryException $e) {

            return [
                'error' => true,
                'message' => 'Erro'
            ];

        } catch (Exception $e) {

            return [
                'error' => true,
                'message' => 'Ocorreu algum erro ao buscar os projetos'
            ];

        }

    }


    public function destroy($id)
    {

        try {


            $this->repository->delete($id);


            return [
                'success' => true,
                'message' => 'Projeto deletado com sucesso!'

            ];


        } catch (ModelNotFoundException $e) {

            return [
                'error' => true,
                'message' => 'Projeto nao Existe!.'
            ];


        } catch (QueryException $e) {

            return [
                'error' => true,
                'message' => 'Projeto nao pode ser apagado pois existe um ou mais clientes vinculados a ele.'
            ];

        } catch (Exception $e) {

            return [
                'error' => true,
                'message' => 'Ocorreu algum erro ao excluir o projeto.'
            ];

        }
    }


//=========================== Fun��es relacionadas aos membros dos Projetos =========================


    public function indexMembers($id)
    {
        $members = $this->repositoryMember->findWhere(['project_id' => $id]);

        if (count($members) > 0) {

            return $members;

        } else {

            return [
                'error' => true,
                'message' => 'nao existe membros para este projeto!'
            ];

        }

    }


    public function showMembers($id, $memberId)
    {


        $members = $this->repositoryMember->findWhere(['project_id' => $id, 'member_id' => $memberId]);

        if (count($members) > 0) {

            return $members;

        } else {

            return [
                'error' => true,
                'message' => 'este membro nao faz parte deste projeto!'
            ];

        }
    }


    public function addMember($data)
    {

        try {

            $this->validatorMember->with($data)->passesOrFail();
            $this->repositoryMember->create($data);

            return [
                'success' => true,
                'message' => 'Membro inserido com sucesso!',

            ];

        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag(),
            ];
        } catch (QueryException $e) {

            return [
                'error' => true,
                'message' => 'Erro ao Inserir os dados na Base!',
            ];

        } catch (\Exception $e) {

            return [
                'error' => true,
                'message' => 'Ocorreu algum Erro',
            ];
        }


    }


    /**
     * @param $id
     * @return array
     */
    public function removeMember($id)
    {


        try {


            $this->repositoryMember->delete($id);


            return [
                'success' => true,
                'message' => 'Projeto deletado com sucesso!'
            ];


        } catch (ModelNotFoundException $e) {

            return [
                'error' => true,
                'message' => 'Projeto nao Existe!.'
            ];


        } catch (QueryException $e) {

            return [
                'error' => true,
                'message' => 'Projeto nao pode ser apagado pois existe um ou mais clientes vinculados a ele.'
            ];

        } catch (Exception $e) {

            return [
                'error' => true,
                'message' => 'Ocorreu algum erro ao excluir o projeto.'
            ];

        }

    }


    /**
     * @param $id
     * @param $memberId
     * @return array
     */
    public function isMember($id, $memberId)
    {

        $p = $this->repository->with(['members'])->find($id);


        $members = $p->members;


        foreach ($members as $m) {
            if ($m->id == $memberId)
                return true;
        }


        return false;


    }





//==================== Permições ==============================



    public function checkProjectOwner($projectFileId){

        $userId = \Authorizer::getResourceOwnerId();

        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

        return $this->repository->isOwner($projectId,$userId);
    }



    public function checkProjectMember($projectFileId){

        $userId = \Authorizer::getResourceOwnerId();

        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

        return $this->repository->hasMember($projectId,$userId);
    }


    public function checkProjectPermission($projectFileId){

        if ($this->checkProjectOwner($projectFileId)or $this->checkProjectMember($projectFileId)) {
            return true;
        }

        return false;
    }






}
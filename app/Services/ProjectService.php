<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:47
 */

namespace codeproject\Services;

use codeproject\Repositories\ProjectFileRepository;
use codeproject\Repositories\ProjectMemberRepository;
use codeproject\Repositories\ProjectRepository;
use codeproject\Validators\ProjectFileValidator;
use codeproject\Validators\ProjectMemberValidator;
use codeproject\Validators\ProjectValidator;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


use Illuminate\Filesystem\Filesystem;

use Illuminate\Contracts\Filesystem\Factory as Storage;

use Prettus\Validator\Exceptions\ValidatorException;


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
    /**
     * @var Storage
     */
    private $storage;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var ProjectFileRepository
     */
    private $repositoryFile;
    /**
     * @var ProjectFileValidator
     */
    private $fileValidator;

    public function __construct(ProjectValidator $validator,
                                ProjectRepository $repository,
                                ProjectMemberRepository $repositoryMember,
                                ProjectFileRepository $repositoryFile,
                                ProjectMemberValidator $validatorMember,
                                Storage $storage,
                                Filesystem $filesystem,
                                ProjectFileValidator $fileValidator)
    {

        $this->validator = $validator;
        $this->repository = $repository;
        $this->repositoryMember = $repositoryMember;
        $this->validatorMember = $validatorMember;
        $this->storage = $storage;
        $this->filesystem = $filesystem;
        $this->repositoryFile = $repositoryFile;
        $this->fileValidator = $fileValidator;
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

            $data = $this->repository->with(['client', 'user'])->find($id);

            if (count($data) > 0) {
                return $data;
            } else {
                return [
                    'error' => true,
                    'message' => 'Este Projeto não Existe'
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


//=========================== Funções relacionadas aos membros dos Projetos =========================


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






    // ++++++++++++++++++++++++ Funções relacionadas aos Files +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


    public function createFile(array $data)
    {

        try {

            $this->fileValidator->with($data)->passesOrFail();

            $project = $this->repository->skipPresenter()->find($data['project_id']);

            $projectFile = $project->files()->create($data);

            $this->storage->put($projectFile->id . "." . $data['extension'], $this->filesystem->get($data['file']));

            return [
                'success' => true,
                'message' => 'Arquivo criado com sucesso!',

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


    public function destroyFile($id, $idfile)
    {

        try {


            $file = $this->repositoryFile->find($idfile);

            $arq = $file->id . "." . $file->extension;

            $this->storage->delete($arq);

            $this->repositoryFile->delete($idfile);

            return [
                'success' => true,
                'message' => 'Arquivo deletado com sucesso!'

            ];

        } catch (ModelNotFoundException $e) {

            return [
                'error' => true,
                'message' => 'Arquivo nao Existe!.'
            ];


        } catch (QueryException $e) {

            return [
                'error' => true,
                'message' => 'Erro ao deletar do banco.'
            ];

        } catch (Exception $e) {

            return [
                'error' => true,
                'message' => 'Ocorreu algum erro ao excluir o Arquivo.'
            ];

        }


    }


}
<?php



namespace codeproject\Services;



use codeproject\Repositories\ProjectFileRepository;
use codeproject\Repositories\ProjectRepository;
use codeproject\Validators\ProjectFileValidator;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectFileService
{



	private $repository;
	
	private  $projectRepository;

	private $fileValidator;
	
	private $filesystem;
	
	Private $storage;

	public function __construct( 
			ProjectFileRepository $repository , 
			ProjectRepository $projectRepository,
			ProjectFileValidator $fileValidator,
			Filesystem $filesystem, Storage $storage)
	{

		$this->repository = $repository;

		$this->projectRepository = $projectRepository;
		
		$this->fileValidator = $fileValidator;
		
		$this->filesystem = $filesystem;
		
		$this->storage = $storage;
		
		
	}

	
	
	
	
	//=========================================================================================
	
	

	public function create(array $data)
	{


		try {
		
			$this->fileValidator->with($data)->passesOrFail();
		
			$project = $this->projectRepository->skipPresenter()->find($data['project_id']);
		
			$projectFile = $project->files()->create($data);
		
			$this->storage->put($projectFile->id . "." . $data['extension'], $this->filesystem->get($data['file']));
		
			return [
					'success' => true,
					'message' => 'Arquivo criado com sucesso!',
		
			];
		
		} catch (ValidatorException $e) {
		
			return [
					'error' => true,
					'message' => $e,
			];
		} catch (QueryException $e) {
		
			return [
					'error' => true,
					'message' => 'Erro ao Inserir os dados na Base!',
			];
		
		} catch (\Exception $e) {
		
			return [
					'error' => true,
					'message' => $e,
			];
		}
		
		 

	}

	
	
	//=========================================================================================

	public function update(array $data, $id)
	{

		try{
		
		$this->fileValidator->with($data)->passesOrFail();
		
		return $this->repository->update($data, $id);
		
		}catch (ValidatorException $e) {
		
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

	
	//============================================================================================
	
	public function getFilePath($id){
		
		$projectFile = $this->repository->skipPresenter()->find($id);
		return $this->getBaseURL($projectFile);
		
	}
	
	public function getBaseURL($projectFile){

		switch ($this->storage->getDefaultDrive){
			
			case 'local':
					return $this->storage->getDrive()->getAdapter()->getPathPrefix().'/'.$projectFile->id.'.'.$projectFile->extension;
		}
	}
	
	public function checkProjectOwner($projectFileId){
		
		$userId = \Authorizer::getResourceOwnerId();
		
		$projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

		return $this->projectRepository->isOwner($projectId,$userId);
	}

	
	
	public function checkProjectMember($projectFileId){
	
		$userId = \Authorizer::getResourceOwnerId();
	
		$projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;
	
		return $this->projectRepository->hasMember($projectId,$userId);
	}
	
	
	public function checkProjectPermission($projectFileId){
	
		if ($this->checkProjectOwner($projectFileId)or $this->checkProjectMember($projectFileId)) {
			return true;
		}
		
		return false;
	}
	
	
	
	
	
	
	//=========================================================================================

	public function show($id)
	{



	}


	
	

	//=========================================================================================
	public function index()
	{


		 

	}


	
	

	//=========================================================================================
	public function delete($id)
	{

		

		try {
		
		
			$file = $this->repository->skipPresenter()->find($id);
		
			$arq = $file->id . "." . $file->extension;
		
			if($this->storage->exists($arq)){
			
				$this->storage->delete($arq);
				
			}
		
			$this->repository->delete($id);
		
		

			//caso apresente erro na frontEnd não retorne os dados;
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
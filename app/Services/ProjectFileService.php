<?php



namespace codeproject\Services;



use codeproject\Entities\ProjectFile;
use codeproject\Repositories\ProjectFileRepository;
use codeproject\Repositories\ProjectRepository;
use codeproject\Validators\ProjectFileValidator;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Prettus\Validator\Contracts\ValidatorInterface;

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
		
			$this->fileValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
		
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
		
		$this->fileValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
		
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


	public function getFileName($id){

		$projectFile = $this->repository->skipPresenter()->find($id);

		$fileName = $projectFile['id'].'.'.$projectFile['extension'];

		return $fileName;
	}


	public function getFilePath($id){
		
		$fileName = $this->getFileName($id);

		return $this->getBaseURL($fileName);
		
	}
	
	public function getBaseURL( $fileName){


		return  $this->storage->disk()->getAdapter()->getPathPrefix().$fileName;


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
		
		

			//caso apresente erro na frontEnd n�o retorne os dados;
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
<?php

namespace codeproject\Http\Controllers;

use codeproject\Repositories\ProjectFileRepository;
use codeproject\Services\ProjectService;
use Faker\Provider\File;
use Illuminate\Http\Request;

use codeproject\Http\Requests;
use codeproject\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use codeproject\Repositories\ProjectRepository;
use codeproject\Services\ProjectFileService;
use SuperClosure\Analyzer\Visitor\ThisDetectorVisitor;

class ProjectFileController extends Controller
{


    /**
     * @var ProjectService
     */
    private $service;
    /**
     * @var ProjectFileRepository
     */
    private $repository;
    
    private $projectRepository;

    public function __construct(ProjectFileService $service , ProjectFileRepository $repository, ProjectRepository $projectRepository)
    {

        $this->service = $service;
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return  $this->repository->findWhere(['project_id'=>$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id )
    {
    
        $file=$request->file('file');
        $extension=$file->getClientOriginalExtension();
        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        return $this->service->create($data);

    }

    
    public function showFile($id , $idFile){

    	//if($this->service-checkProjectPermission($id)==false){
    	
    	  //  return ['error'=>'Access Forbiden'];
    	
    	//}

        $filePath = $this->service->getFilePath($idFile);

        $fileContent = file_get_contents($filePath);

        $file64 = base64_encode($fileContent);



        return [
            'file'=>$file64,
            'size'=>filesize($filePath),
            'name'=>$this->service->getFileName($idFile),
            'url'=>$filePath
        ];
    	
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id , $idFile)
    {

    	//if($this->service-checkProjectPermission($id)==false){
    		
    	//	return ['error'=>'Access Forbiden'];
    		
    	//}
    	
         return $this->repository->find($idFile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id , $idFile)
    {
    	//if($this->service-checkProjectOwner($id)==false){
    	
    	//	return ['error'=>'Access Forbiden'];
    	
    	//}
    	
    	
        return $this->service->update($request->all(),$idFile);
    }

    
    
    
    
    public function destroy($id, $idFile)
    {
    	
    	if($this->service->checkProjectOwner($idFile)==false){
    	
    		return ['error'=>'Access Forbiden'];
    	
    	}
    	
    	//caso apresente erro na frontEnd n�o retorne os dados;
        return $this->service->delete($idFile);
    }
}

<?php

namespace codeproject\Http\Controllers;

use codeproject\Repositories\ProjectFileRepository;
use codeproject\Services\ProjectService;
use Faker\Provider\File;
use Illuminate\Http\Request;

use codeproject\Http\Requests;
use codeproject\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

    public function __construct(ProjectService $service , ProjectFileRepository $repository)
    {

        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id'=>$id]);
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
    public function store(Request $request)
    {

        $file=$request->file('file');
        $extension=$file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        return $this->service->createFile($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id , $fileId)
    {

        return $this->repository->findWhere(['project_id'=>$id , 'id'=>$fileId]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$idfile)
    {
        return $this->service->destroyFile($id,$idfile);
    }
}

<?php
//trocado no index
namespace codeproject\Http\Controllers;

use codeproject\Repositories\ProjectNoteRepository;
use codeproject\Services\ProjectNoteService;
use Illuminate\Http\Request;

use codeproject\Http\Requests;
use codeproject\Http\Controllers\Controller;

class ProjectNoteController extends Controller
{


    /**
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service ){

        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     * @param id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id'=>$id]); // TROCADO
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
    public function store(Request $request , $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;

        return $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$noteId)
    {

        return $this->service->show($noteId);
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
    public function update(Request $request, $id, $idNote)
    {
        $data = $request->all();
        $data['project_id'] = $id;

        return $this->service->update($data,$idNote);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$noteId)
    {
        return $this->service->delete($noteId);
    }
}

<?php

namespace codeproject\Http\Controllers;

use codeproject\Repositories\ProjectRepository;
use codeproject\Services\ProjectService;
use Illuminate\Http\Request;
use codeproject\Http\Requests;

class ProjectController extends Controller
{


    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectService $service , ProjectRepository $repository )
    {

        $this->repository = $repository;
        $this->service = $service;
        $this->middleware('check.project.owner',['except'=>['store','show','index']]);
        $this->middleware('check.project.permission',['except'=>['show','index','store','update','destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $this->repository->findProjectWithOwnerAndMember(\Authorizer::getResourceOwnerId());
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
    public function store(Request $request )
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->service->show($id);
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
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }




    // =========== Metodos Relacionados aos Membros dos Projetos ==============================



    public function indexMember($id)
    {



        return $this->repository->findWhere(['project_id'=>$id]);

    }




    public function addMember(Request $request)
    {

        return $this->service->addMember($request->all());
    }


    public  function removeMember($id)
    {
        return $this->service->removeMember($id);
    }



    public function isMember($id , $memberId)
    {
        return $this->service->isMember($id , $memberId);
    }
}

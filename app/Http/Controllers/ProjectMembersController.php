<?php

namespace codeproject\Http\Controllers;

use codeproject\Repositories\ProjectMemberRepository;
use codeproject\Services\ProjectMemberService;
use Illuminate\Http\Request;

use codeproject\Http\Requests;

class ProjectMembersController extends Controller
{

    /**
     * @var ProjectMemberRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;



    /**
     * @param ProjectMemberRepository $repository
     * @param ProjectMemberService $service
     * @param PojectService $projectService
     */
    public function __construct(ProjectMemberRepository $repository , ProjectMemberService $service)
    {


        $this->repository = $repository;
        $this->service = $service;


        $this->middleware('check.project.owner',['except'=>['index','show']]);
        $this->middleware('check.project.permission',['except'=>['store','destroy']]);

    }


    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {


        return $this->repository->with('member')->findWhere(['project_id'=>$id]);
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
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id)
    {

        $data = $request->all();
        $data['project_id']= $id;

        return $this->service->create($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param $idProjectMember
     * @return \Illuminate\Http\Response
     */
    public function show($id , $idProjectMember)
    {
        return $this->repository->with('member')->find($idProjectMember);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , $idProjectMember)
    {

       return  $this->service->destroy($idProjectMember);

    }
}

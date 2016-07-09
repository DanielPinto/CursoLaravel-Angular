<?php

namespace codeproject\Http\Controllers;

use codeproject\Repositories\ProjectMemberRepository;
use codeproject\Services\ProjectMemberService;
use codeproject\Services\ProjectService;
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
     * @param ProjectService $service
     */
    public function __construct(ProjectMemberRepository $repository , ProjectService $service)
    {

        $this->repository = $repository;
        $this->service = $service;
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        return $this->service->indexMembers($id);
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

        return $this->service->addMember($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id , $memberId)
    {
        return $this->service->showMembers($id , $memberId);
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
    public function destroy($id , $memberId)
    {

       return  $this->service->removeMember($memberId);

    }
}

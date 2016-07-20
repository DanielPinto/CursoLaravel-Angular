<?php

namespace codeproject\Http\Middleware;

use Closure;
use codeproject\Services\ProjectService;

class CheckProjectPermission
{

    private $service;

    /**
     * CheckProjectPermission constructor.
     * @param $service
     */
    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $projectId = $request->route('id') ? $request->route('id') : $request->route('project');

        if($this->service->checkProjectPermission($projectId)==false){

            return ['error'=>'You haven\'t permission to access project'];
        }

        return $next($request);
    }
}

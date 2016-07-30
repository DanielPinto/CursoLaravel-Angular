<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 13/03/2016
 * Time: 20:38
 */

namespace codeproject\Transformers;


use codeproject\Entities\ProjectMember;
use codeproject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [

        'user'
    ];

    public function transform(ProjectMemberTransformer $member)
    {
        return [

            'id'=>$member->project_id,
            'member_id'=>$member->id,

        ];
    }


    public function includeUser(ProjectMember $member)
    {
        return $this->item($member->members, new MemberTransformer());
    }



}
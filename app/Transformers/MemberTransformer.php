<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 29/07/16
 * Time: 19:48
 */

namespace codeproject\Transformers;


use codeproject\Entities\User;

class MemberTransformer
{

    public function transform(User $member){

        return [

            'member_id'=>$member->id,
            'name'=>$member->name,
        ];
    }

}
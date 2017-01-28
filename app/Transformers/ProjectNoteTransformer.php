<?php
//trocado
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 13/03/2016
 * Time: 20:38
 */

namespace codeproject\Transformers;

use codeproject\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{


    public function transform(ProjectNote $note)
    {
        return [

            'id'=>$note->id,
            'project_id'=>$note->project_id,
            'title'=>$note->title,
            'note'=>$note->note,

        ];
    }


}

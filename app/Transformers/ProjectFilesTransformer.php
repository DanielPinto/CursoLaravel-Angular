<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 13/03/2016
 * Time: 20:38
 */

namespace codeproject\Transformers;


use codeproject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFilesTransformer extends TransformerAbstract
{

    public function transform(ProjectFile $file)
    {
        return [

            'id'=>$file->id,
            'project_id'=>$file->project_id,
            'name'=>$file->name,
            'description'=>$file->description,
            'extension'=>$file->extension,

        ];
    }


}
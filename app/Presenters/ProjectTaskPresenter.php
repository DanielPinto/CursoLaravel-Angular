<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 13/03/2016
 * Time: 20:52
 */

namespace codeproject\Presenters;

use codeproject\Transformers\ProjectTaskTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectTaskPresenter extends FractalPresenter
{


    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectTaskTransformer();
    }
}
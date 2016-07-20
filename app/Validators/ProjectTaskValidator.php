<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:40
 */

namespace codeproject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{

    Protected $rules=[
		'name'=>'required',
		'start_date'=> 'required',
		'due_date'=> 'required',
		'status'=> 'required',
];


}
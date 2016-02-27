<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:40
 */

namespace codeproject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{

    Protected $rules=[
		'user_id'=> 'required',
		'client_id'=>'required',
		'name'=>'required',
		'description' => 'required',
		'progress'=> 'required',
		'status'=> 'required',
		'due_date'=> 'required',
];


}
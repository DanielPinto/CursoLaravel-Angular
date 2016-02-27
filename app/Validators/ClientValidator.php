<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:40
 */

namespace codeproject\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{

    Protected $rules=[
	'nome' => 'required |max:255',
	'responsible'=>'required|max:255',
	'email'=>'required|email',
	'phone' =>'required',
	'address'=> 'required'
];


}
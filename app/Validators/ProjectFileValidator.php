<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 24/02/2016
 * Time: 23:40
 */

namespace codeproject\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{

    Protected $rules=[


		ValidatorInterface::RULE_CREATE =>[
		'project_id'=> 'required',
		'name' => 'required',
		'description'=> 'required',
		'extension'=> 'required',
		],

		ValidatorInterface::RULE_UPDATE =>[
			'project_id'=> 'required',
			'name' => 'required',
			'description'=> 'required',
		]
];


}
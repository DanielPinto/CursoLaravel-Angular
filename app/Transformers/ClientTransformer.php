<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 13/03/2016
 * Time: 20:38
 */

namespace codeproject\Transformers;

use codeproject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{



    public function transform(Client $client)
    {
        return [

            'id'=>$client->id,
            'nema'=>$client->nome,
            'responsible'=>$client->responsible,
            'email'=>$client->email,
            'phone'=>$client->phone,
            'address'=>$client->address,
            'obs'=>$client->obs,

        ];
    }





}
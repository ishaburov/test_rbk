<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getJson($data = [], $error = NULL){
        $object = [
            'status'=> $error===NULL,
            'data'  => $data
        ];

        if ( $error != null ) {
            $object['errors'] = $error;
        }
        return $object;
    }
}

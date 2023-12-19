<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ApiModel;

class StatusController extends BaseController
{
    protected $model_api;

    public function __construct()
    {
        $this->model_api = new ApiModel;
    }
    public function status()
    {  $validation_init = $this->validationInit();

        if($validation_init !== 200){
            return $this->response->setJSON($validation_init)->setStatusCode($validation_init['code']);
        }

        return $this->response->setJSON($validation_init);
    }
}

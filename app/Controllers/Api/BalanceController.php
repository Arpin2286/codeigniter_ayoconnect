<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ApiModel;

class BalanceController extends BaseController
{
    protected $model_api;

    public function __construct()
    {
        $this->model_api = new ApiModel;
    }
    public function balance()
    {
        $validation_init = $this->validationInit();

        if($validation_init !== 200){
            return $this->response->setJSON($validation_init)->setStatusCode($validation_init['code']);
        }

        return $this->response->setJSON($validation_init);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ApiModel;

class PaymentController extends BaseController
{
    protected $model_api;

    public function __construct()
    {
        $this->model_api = new ApiModel;
    }
    public function payment()
    {
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'message' => 'Payment OK'
        ]);
    }
}

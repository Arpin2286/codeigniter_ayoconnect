<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\ApiModel;

class Login extends BaseController
{
    protected $model_api;
    public function __construct()
    {
        $this->model_api = new ApiModel;
    }
    public function index()
    {
        $client_id = $this->request->getVar('client_id');
        $grant_type = $this->request->getVar('grant_type');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
    }
}

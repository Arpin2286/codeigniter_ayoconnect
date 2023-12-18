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
    { //Request
        $client_id = $this->request->getVar('client_id');
        $grant_type = $this->request->getVar('grant_type');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $access_token = $this->request->getVar('access_token');

        // Example
        // $client_id = '66be7e2d-f4c9-4305-8f53-a20f2eec812d';
        // $grant_type = 'client_credentials';
        // $username = 'b80b4fc7-3238-45be-87a1-12080fd25864';
        // $password = '7b9b8790-dd61-4608-bbef-8175ca021f88';
        // $access_token = 'U5u0f8T4Pyzzz9EPloRh1Aqfhon6bfx8GwYPBZOx';

        $validate_user = $this->model_api->validateUser($client_id, $grant_type, $username, $password);
        if($validate_user['code'] !== 200){
            return $this->response->setStatusCode($validate_user['code'])->setJSON(['status' => 'error', 'message' => 'Authorization Failed']);
        }

        $validate_access = $this->model_api->validationAccess($access_token);
        if($validate_access['code'] !== 200 ){
            return $this->response->setStatusCode($validate_access['code'])->setJSON(['status' => 'error', 'message' => 'Token Access Not Found']);
        }
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'message' => 'Status OK'
        ]);
    }
}

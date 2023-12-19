<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Helpers\GenerateJWT;
use App\Models\ApiModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    use ResponseTrait;
    protected $model_api;
    public function __construct()
    {
        $this->model_api = new ApiModel;
    }
    public function login()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'client_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'grant_type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }

        try {
            $client_id = $this->request->getVar('client_id');
            $grant_type = $this->request->getVar('grant_type');
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $process = $this->model_api->validateUser($client_id, $grant_type, $username, $password);

            if ($process['code'] == 200) {
                $token = GenerateJWT::generateToken($username);
                return $this->response->setJSON(['status' => 'success', 'token' => $token])->setStatusCode(ResponseInterface::HTTP_OK);
            } else {
                return $this->response->setJSON(['status' => $process['status'], 'message' => 'Wrong Username or Password'])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            }
        } catch (\Throwable $th) {
            return $this->response->setJSON(['status' => 'error', 'message' => $th->getMessage()])->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

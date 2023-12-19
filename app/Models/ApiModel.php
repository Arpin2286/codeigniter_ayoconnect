<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiModel extends Model
{
    public function getheader()
    {
        $header = [
            'token' => getenv('token'),
            'key' => getenv('key'),
        ];

        return $header;
    }

    public function validateUser($client_id,  $grant_type, $username, $password)
    {
        $user = $this->db->table('m_apiservice_client_user')
        ->where('client_id', $client_id)
        ->where('grant_type', $grant_type)
        ->where('username', $username)
        ->where('password', $password)
        ->where('password', $password)
        ->get()->getRow();

        return $user
            ? $response = ['code' => 200, 'status' => 'success']
            : $response = ['code' => 400, 'status' => 'error'];
    }

    public function validationAccess($access_token)
    {
        $access = $this->db->table('m_apiservice_access_token')
        ->where('access_token', $access_token)
        ->get()->getRow();

        return $access
            ? $response = ['code' => 200, 'status' => 'success']
            : $response = ['code' => 400, 'status' => 'error'];
    }
}

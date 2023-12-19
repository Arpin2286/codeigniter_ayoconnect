<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class JWTModel extends Model
{
    public function getJWT($headerToken)
    {
        if (empty($headerToken)) {
            throw new Exception("Authorization Token Not Found");
        }

        return explode(" ", $headerToken)[1];
    }

    public function validationToken($encodeToken)
    {
        $key = getenv('JWT_SECRET_KEY');
        $decodeToken = JWT::decode($encodeToken, $key, ['HS256']);

        $this->getUsername($decodeToken->username);
    }

    public function getUsername($username)
    {
        $user = $this->db->table('m_apiservice_client_user')
            ->getWhere(['username' => $username])
            ->getRow();

        if (empty($user)) {
            throw new Exception("Username Not Found");
        }

        return $user;
    }
}

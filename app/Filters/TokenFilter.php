<?php

namespace App\Filters;

use App\Models\JWTModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface; 
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Exception;

class TokenFilter implements FilterInterface
{
    use ResponseTrait;
    public function before(RequestInterface $request, $arguments = null)
    {
        $header =  $request->getServer('HTTP_AUTHORIZATION');
        try {
            $JwtModel = new JWTModel;
            $encodeToken =  $JwtModel->getJWT($header);
            $JwtModel->validationToken($encodeToken);
            return $request;
        } catch (Exception $e) {
            return Services::response()->setJSON(['error' => $e->getMessage()])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
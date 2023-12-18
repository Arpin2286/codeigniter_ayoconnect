<?php

namespace App\Controllers;

use App\Models\ApiModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    public function validationInit()
    {
        // Init Model
        $model_api = new ApiModel;
        //Request
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

        $validate_user = $model_api->validateUser($client_id, $grant_type, $username, $password);
        if($validate_user['code'] !== 200){
            return $response = ['code' => 400, 'message' => 'Authorization Failed'];
        }

        $validate_access = $model_api->validationAccess($access_token);
        if($validate_access['code'] !== 200 ){
            return $response = ['code' => 400, 'message' => 'Token Access Not Found'];
        }

        return $response = ['code'=> 200];
    }
}

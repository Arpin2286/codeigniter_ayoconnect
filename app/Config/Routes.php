<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Auth\Login::login');
$routes->group('api', function ($routes)
{
    $routes->post('inquiry', 'Api\InquiryController::inquiry');
    $routes->post('payment', 'Api\PaymentController::payment');
    $routes->post('balance', 'Api\BalanceController::balance');
    $routes->post('product_list', 'Api\ProductController::product');
    $routes->post('status', 'Api\StatusController::status');
});
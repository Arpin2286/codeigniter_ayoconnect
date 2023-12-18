<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->group('api', function ($routes)
{
    $routes->post('inquiry', 'InquiryController::inquiry');
    $routes->post('payment', 'PaymentController::payment');
    $routes->post('balance', 'BalanceController::balance');
    $routes->post('product_list', 'ProductController::product');
    $routes->post('status', 'StatusController::status');
});
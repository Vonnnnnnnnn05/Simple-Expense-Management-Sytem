<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::loginView');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/expenses', 'ExpenseController::index');
$routes->get('/expenses/add', 'ExpenseController::add');
$routes->post('/expenses/store', 'ExpenseController::store');
$routes->get('/expenses/edit/(:num)', 'ExpenseController::edit/$1');
$routes->post('/expenses/update/(:num)', 'ExpenseController::update/$1');
$routes->get('/expenses/delete/(:num)', 'ExpenseController::delete/$1');
$routes->get('/analytics', 'ExpenseController::analytics');
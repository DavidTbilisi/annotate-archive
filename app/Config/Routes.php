<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');



// Users
$routes->get('logout', 'UsersController::logout');
$routes->group('users', function($routes) {
    $routes->get('/', 'UsersController::index');
    
    $routes->get('login', 'UsersController::loginView', ['filter' => 'AuthFilter']);
    $routes->post('login', 'UsersController::login', ['filter' => 'AuthFilter']);
    
    $routes->get('register', 'UsersController::registerView', ['filter' => 'AuthFilter']);
    $routes->post('register', 'UsersController::register', ['filter' => 'AuthFilter']);
    
    $routes->post('reset', 'UsersController::reset', ['filter' => 'AuthFilter']);
    $routes->get('reset', 'UsersController::reset', ['filter' => 'AuthFilter']);
    
    $routes->get('profile/(:num)', 'UsersController::profile/$1');
    $routes->get('account/(:num)', 'UsersController::accountView/$1', ['filter' => 'NoAuthFilter']);
    $routes->put('account/(:num)', 'UsersController::account/$1', ['filter' => 'NoAuthFilter']);
    
    $routes->get('logout', 'UsersController::logout');

    $routes->get('activation', 'UsersController::activation', ['filter' => 'AuthFilter']);

    
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
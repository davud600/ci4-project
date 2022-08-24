<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
  require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Files download
$routes->get('/download-file', 'MessageController::downloadFile');

// Customer
$routes->get('/customer-project', 'CustomerController::project', ['filter' => ['User']]);

// Request
$routes->get('/request/(:any)', 'RequestController::request/$1', ['filter' => ['User', 'CreatorOfRequest']]);
$routes->match(['get', 'post'], '/submit-request', 'RequestController::create', ['filter' => ['User', 'ProjectCustomer']]);
$routes->match(['post'], '/approve-request/(:any)', 'RequestController::approve/$1', ['filter' => ['User', 'ProjectEmployee:hasRequestId']]);
$routes->match(['post'], '/cancel-request/(:any)', 'RequestController::cancel/$1', ['filter' => ['User', 'ProjectEmployee:hasRequestId']]);

// Message
$routes->match(['post'], '/create-message/(:any)', 'MessageController::create/$1', ['filter' => ['User']]);

// Employee
$routes->get('/employee-project/(:any)', 'EmployeeController::project/$1', ['filter' => ['User', 'Employee', 'ProjectEmployee']]);
$routes->get('/employee-projects', 'EmployeeController::projects', ['filter' => ['User', 'Employee']]);
$routes->match(['post'], '/change-estimated-time/(:any)', 'EmployeeController::changeEstimatedTime/$1', ['filter' => ['User', 'Employee', 'ProjectEmployee']]);

// User
$routes->get('/dashboard', 'UserController::dashboard', ['filter' => ['User', 'Admin']]);
$routes->get('/profile', 'UserController::profile', ['filter' => ['User']]);
$routes->match(['get', 'post'], '/login', 'UserController::login');
$routes->match(['get', 'post'], '/signup', 'UserController::signup');

// Project
$routes->get('/project/(:any)', 'ProjectController::project/$1', ['filter' => ['User', 'Admin']]);
$routes->get('/projects', 'ProjectController::projects', ['filter' => ['User', 'Admin']]);
$routes->match(['get', 'post'], '/create-project', 'ProjectController::create', ['filter' => ['User', 'Admin']]);
$routes->match(['get', 'post'], '/edit-project/(:any)', 'ProjectController::edit/$1', ['filter' => ['User', 'Admin']]);
$routes->match(['get', 'delete'], '/delete-project/(:any)', 'ProjectController::delete/$1', ['filter' => ['User', 'Admin']]);
$routes->get('/archived-projects', 'ProjectController::archivedProjects', ['filter' => ['User', 'Admin']]);
$routes->get('/archive-project/(:any)', 'ProjectController::archive/$1', ['filter' => ['User', 'Admin']]);
$routes->get('/unarchive-project/(:any)', 'ProjectController::unArchive/$1', ['filter' => ['User', 'Admin']]);

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

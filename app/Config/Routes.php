<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('about', 'Home::about');

$routes->get('/suratin/(:segment)', 'Surat_In::index/$1');
$routes->get('/suratin/detail/(:segment)', 'Surat_In::detail/$1');
$routes->get('/suratin/edit/(:segment)', 'Surat_In::edit/$1');
$routes->get('/suratin/hapus/(:segment)', 'Surat_In::hapus/$1');
$routes->get('/suratin/disposisi/(:segment)/(:segment)', 'Surat_In::dispo/$1/$2');
$routes->get('/suratin/lihatgbr/(:segment)', 'Surat_In::lihatgbr/$1');

$routes->get('/suratout/(:segment)', 'Surat_Out::index/$1');
$routes->get('/suratout/detail/(:segment)', 'Surat_Out::detail/$1');
$routes->get('/suratout/edit/(:segment)', 'Surat_Out::edit/$1');
$routes->get('/suratout/hapus/(:segment)', 'Surat_Out::hapus/$1');
$routes->get('/suratout/disposisi/(:segment)/(:segment)', 'Surat_Out::dispo/$1/$2');
$routes->get('/suratout/lihatgbr/(:segment)', 'Surat_Out::lihatgbr/$1');
$routes->get('/suratout/out/(:segment)', 'Surat_Out::out/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

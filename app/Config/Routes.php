<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);


$routes->get('/', 'Pages::index');
$routes->get('/pages', 'Pages::index');
$routes->get('/pages/about', 'Pages::about');
$routes->get('/pages/contact', 'Pages::contact');
$routes->get('/komik', 'Komik::index');

$routes->get('/komik/create', 'Komik::create');
$routes->get('/komik/(:segment)', 'Komik::detail_komik/$1');

// $routes->get('/coba/index', 'Coba::index');
// $routes->get('/coba/about', 'Coba::about');
// $routes->get('/coba/(:any)/(:num)', 'Coba::about/$1/$2');


// $routes->get('/users', 'Admin\Users::index');
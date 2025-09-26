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
$routes->get('/komik/edit/(:any)', 'Komik::edit/$1');

$routes->delete('/komik/delete/(:num)', 'Komik::delete/$1');
$routes->post('/komik/save', 'Komik::save');
$routes->get('/komik/(:any)', 'Komik::detail_komik/$1');

// $routes->get('/coba/index', 'Coba::index');
// $routes->get('/coba/about', 'Coba::about');
// $routes->get('/coba/(:any)/(:num)', 'Coba::about/$1/$2');


// $routes->get('/users', 'Admin\Users::index');
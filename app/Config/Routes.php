<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/homepage', 'Home::homepage');
$routes->get('/homepage/(:any)', 'Home::hp/$1');
$routes->get('/insert', 'Home::showInsertForm'); // Display the insert form
$routes->post('/insert', 'Home::insert'); // Handle product insertion
$routes->get('/table_products', 'Home::table_products');
$routes->get('/edit/(:any)', 'Home::edit/$1');
$routes->post('/update', 'Home::update');
$routes->get('delete/(:any)', 'Home::delete/$1');

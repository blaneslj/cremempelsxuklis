<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('samarretes', 'Samarretes::index');
$routes->post('samarretes', 'Samarretes::desa');

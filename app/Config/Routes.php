<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('afanoc', 'Home::afanoc');
$routes->get('samarretes', 'Samarretes::index');
$routes->post('samarretes', 'Samarretes::desa');

// Zona d'administració
$routes->get('admin', static fn () => redirect()->to(site_url('admin/comandes')));
$routes->get('admin/login', 'Admin\Login::index');
$routes->post('admin/login', 'Admin\Login::entra');
$routes->post('admin/surt', 'Admin\Login::surt');
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('comandes', 'Admin\Comandes::index');
    $routes->get('comandes.csv', 'Admin\Comandes::csv');
});

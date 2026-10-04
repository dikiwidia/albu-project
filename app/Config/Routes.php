<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Halaman untuk tamu (belum login)
$routes->group('', ['filter' => 'guest'], static function ($routes) {
    $routes->get('login', 'AuthController::login'); // halaman
    $routes->post('login', 'AuthController::attemptLogin'); // proses
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::attemptRegister');
});

// Halaman yang membutuhkan login
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'HomeController::index');
    $routes->post('logout', 'AuthController::logout');
});

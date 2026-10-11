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

    // CRUD Users
    $routes->get('users', 'UserController::index'); // daftar user
    $routes->get('users/new', 'UserController::create'); // form tambah
    $routes->post('users', 'UserController::store'); // proses tambah
    $routes->get('users/(:num)/edit', 'UserController::edit/$1'); // form edit
    $routes->put('users/(:num)', 'UserController::update/$1'); // proses edit
    $routes->delete('users/(:num)', 'UserController::delete/$1'); // proses hapus
});

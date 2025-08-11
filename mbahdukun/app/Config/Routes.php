<?php

namespace Config;

use CodeIgniter\Routing\RouterCollection;
use Config\Services;

$routes = Services::routes();

$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Public pages
$routes->get('/', 'Home::index');
$routes->get('/faq', 'Home::faq');
$routes->get('/tentang-kami', 'Home::about');
$routes->get('/privacy-policy', 'Home::privacy');
$routes->get('/blog', 'Blog::index');
$routes->get('/blog/(:segment)', 'Blog::show/$1');

// Orders
$routes->post('/order/jodoh', 'OrderController::orderJodoh');
$routes->post('/order/tarot', 'OrderController::orderTarot');
$routes->post('/order/konsultasi', 'OrderController::orderKonsultasi');
$routes->get('/order/pay/(:segment)', 'OrderController::pay/$1');
$routes->get('/order/waiting/(:segment)', 'OrderController::waiting/$1');
$routes->get('/order/waiting', 'Home::index');
$routes->get('/order/status/(:segment)', 'OrderController::status/$1');
$routes->match(['get','post'], '/order/result/(:segment)', 'ResultController::show/$1');
$routes->get('/order/result/(:segment)/pdf', 'ResultController::downloadPdf/$1');

// Payment callback
$routes->post('/payment/callback', 'PaymentController::callback');

// Sitemap
$routes->get('/sitemap.xml', 'SitemapController::index');

// Admin
$routes->get('/admin/login', 'Admin\\AuthController::login');
$routes->post('/admin/login', 'Admin\\AuthController::doLogin');
$routes->get('/admin/logout', 'Admin\\AuthController::logout');
$routes->get('/admin', 'Admin\\DashboardController::index');
$routes->match(['get','post'], '/admin/settings', 'Admin\\SettingsController::index');
$routes->match(['get','post'], '/admin/prices', 'Admin\\PricesController::index');
$routes->get('/admin/articles', 'Admin\\ArticlesController::index');
$routes->match(['get','post'], '/admin/articles/create', 'Admin\\ArticlesController::create');
$routes->match(['get','post'], '/admin/articles/edit/(:num)', 'Admin\\ArticlesController::edit/$1');
$routes->get('/admin/articles/delete/(:num)', 'Admin\\ArticlesController::delete/$1');
$routes->get('/admin/testimonials', 'Admin\\TestimonialController::index');
$routes->match(['get','post'], '/admin/testimonials/create', 'Admin\\TestimonialController::create');
$routes->get('/admin/testimonials/delete/(:num)', 'Admin\\TestimonialController::delete/$1');
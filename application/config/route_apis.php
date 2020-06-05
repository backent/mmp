<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| api ROUTES
| -------------------------------------------------------------------------
*/
$route['api/login'] = "api/auth/login";
$route['api/logout'] = "api/auth/logout";
$route['api/register'] = "api/auth/register";
$route['api/profile'] = "api/profile/my";
$route['api/profile/(:any)'] = "api/profile/profile/$1";
$route['api/product'] = "api/product/products";
$route['api/product'] = "api/product/product";




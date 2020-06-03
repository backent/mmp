<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| api ROUTES
| -------------------------------------------------------------------------
*/
$route['api/login'] = "api/auth/login";
$route['api/logout'] = "api/auth/logout";
$route['api/my'] = "api/auth/my";


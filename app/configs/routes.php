<?php
$router = new \Phalcon\Mvc\Router();

$router->setDefaultModule("frontend");
$router->setDefaultNamespace("App\Frontend\Controllers");

/**
 * Custom Frontend routes
 */
/*
$router->add('/search(/?)', array(
	'module' => 'frontend',
	'namespace' => 'App\Frontend\Controllers\\',
	'controller' => 'search',
	'action' => 'index'
));
*/
/**
 * Api routes
 */
$router->add('#^/api/?$#', array(
	'module' => 'frontend',
	'namespace' => 'App\Frontend\Api\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));

$router->add('#^/api/(\w+)/?$#', array(
	'module' => 'frontend',
	'namespace' => 'App\Frontend\Api\Controllers\\',
	'controller' => 1,
));

$router->add('#^/api/(\w+)/(\w+)(/.*)?$#', array(
	'module' => 'frontend',
	'namespace' => 'App\Frontend\Api\Controllers\\',
	'controller' => 1,
	'action' => 2,
	'params' => 3,
));

/**
 * Admin routes
 */
$router->add('#^/admin/?$#', array(
	'module' => 'backend',
	'namespace' => 'App\Admin\Controllers\\',
	'controller' => 'index',
	'action' => 'index'
));

$router->add('#^/admin/(\w+)/?$#', array(
	'module' => 'backend',
	'namespace' => 'App\Admin\Controllers\\',
	'controller' => 1,
));

$router->add('#^/admin/(\w+)/(\w+)(/.*)?$#', array(
	'module' => 'backend',
	'namespace' => 'App\Admin\Controllers\\',
	'controller' => 1,
	'action' => 2,
	'params' => 3,
));

return $router;

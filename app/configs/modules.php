<?php

/**
 * Register application modules
 */
$application->registerModules(array(
	'frontend' => array(
		'className' => 'App\Frontend\Module',
		'path' => ROOT_PATH . '/app/modules/frontend/Module.php'
	),
	'backend' => array(
		'className' => 'App\Admin\Module',
		'path' => ROOT_PATH . '/app/modules/admin/Module.php'
	)
));
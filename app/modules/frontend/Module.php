<?php

namespace App\Frontend;

use Phalcon\Loader,
    Phalcon\Mvc\View,
    Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter,
    Phalcon\Session\Adapter\Files as SessionAdapter,
    Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders()
    {
        $loader = new Loader();

        $loader->registerNamespaces(array(
            'App\Common\Base' => APP_PATH . '/common/base/',
            'App\Common\Utils' => APP_PATH . '/common/utils/',
            'App\Frontend\Controllers' => __DIR__ . '/controllers/',
            'App\Frontend\Api\Controllers' => __DIR__ . '/api/controllers/',
            'App\Frontend\Models\M' => __DIR__ . '/models/m/',
            'App\Frontend\Models\T' => __DIR__ . '/models/t/',
        ));

        $loader->register();
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices($di)
    {
        $config = $di->get('config');

        /**
         * Read configuration
         */
        $di->set('config', function() use ($config) {
            $config->merge(include __DIR__ . '/config/config.php');
            return $config;
        });

        /**
         * Isolating the session data
         */
        $di->set('session', function(){

            $session = new SessionAdapter(
                array(
                    'uniqueId' => 'frontend'
                )
            );

            $session->start();
            return $session;
        });

        $di->set('view', function () use ($config) {
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir(__DIR__ . '/views/');
            $view->registerEngines(array(
                '.volt' => 'Phalcon\Mvc\View\Engine\Volt'
            ));
            return $view;
        }, true);
    }

}
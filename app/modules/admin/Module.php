<?php

namespace App\Admin;

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
            'App\Admin\Controllers' => __DIR__ . '/controllers/',
            'App\Admin\Models' => __DIR__ . '/models/',
            'App\Common\Models' => APP_PATH . '/common/models/',
            'App\Common\Utils' => APP_PATH . '/common/utils/',
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
                    'uniqueId' => 'admin'
                )
            );

            $session->start();
            return $session;
        });

        /**
         * Setting up the view component
         */
        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');
            $view->registerEngines(array(
                '.volt' => 'Phalcon\Mvc\View\Engine\Volt'
            ));
            return $view;
        });
    }

}
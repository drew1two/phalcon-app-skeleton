<?php

use Phalcon\Mvc\Application,
    Phalcon\Mvc\Url as UrlResolver,
    Phalcon\DI\FactoryDefault;

// Global Const
define('ROOT_PATH', realpath(__DIR__ . '/..'));
define('APP_ENV', (getenv('APP_ENV') ? getenv('APP_ENV') : 'prod'));
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', APP_PATH . '/configs');
define('UPLOAD_PATH', ROOT_PATH . '/public/uploads');

if(APP_ENV == 'dev') {
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set("display_errors", 1);
} else {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    ini_set("display_errors", 0);
    ini_set("log_errors", 1);
}

try {

    /**
     * load composer library
     */
    require ROOT_PATH . '/vendor/autoload.php';

    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new FactoryDefault();

    /**
     * Global config
     */
    $config = include CONFIG_PATH . '/'. APP_ENV . '/config.php';
    $di->set('config', $config);

    /**
     * Main logger
     */
    $di->set('logger', function() {
        return new \Phalcon\Logger\Adapter\File(ROOT_PATH . '/var/logs/' . date('Y-m-d') . '.log');
    });

    /**
     * The URL component is used to generate all kind of urls in the application
     */
    $di->set('url', function() {
        $url = new UrlResolver();
        $url->setBaseUri('/phalcon-app/');
        return $url;
    });

    /**
     * Database connection is created based in the parameters defined in the configuration file
     */
    $di->set('db', function() use ($config) {
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->name,
            "options" => array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        ));
    });

    /**
     * If the configuration specify the use of metadata adapter use it or use memory otherwise
     */
    $di->set('modelsMetadata', function() use ($config) {
        return new \Phalcon\Mvc\Model\Metadata\Files(array(
            'metaDataDir' => ROOT_PATH . '/var/cache/metaData/'
        ));
    }, true);

    /**
     * Set up mailer
     */
    $di->set('mailer', function() {
        return new \Zend\Mail\Transport\Sendmail();
    }, true);

    /**
     * Set up the flash service
     */
    $di->set('flash', function() {
        return new \Phalcon\Flash\Direct();
    });

    /**
     * Cache with memcache
     */
    $di->set('cache', function() {
         $frontCache = new \Phalcon\Cache\Frontend\Data(array(
            "lifetime" => 3600
         ));

         //Create the Cache setting memcached connection options
         $cache = new \Phalcon\Cache\Backend\Memcache($frontCache, array(
            'host' => 'localhost',
            'port' => 11211,
            'persistent' => false
         ));

        return $cache;
    });

    /**
     * Cache with redis
     */
    /*
    $di->set('cache', function() {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);

        $frontend = new \Phalcon\Cache\Frontend\Igbinary(array(
            'lifetime' => 3600
        ));

        $cache = new \Phalcon\Cache\Backend\Redis($frontend, array(
            'redis' => $redis
        ));

        return $cache;
    });
    */

    /**
     * Handle the request
     */
    $application = new Application();

    /**
     * Assign the DI
     */
    $application->setDI($di);

    /**
     * Include modules
     */
    require CONFIG_PATH . '/modules.php';

    /**
     * Registering a router
     */
    $routes = include CONFIG_PATH . '/routes.php';
    $di->set('router', $routes);

    echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
    echo $e->getMessage();
} catch (PDOException $e){
    echo $e->getMessage();
}
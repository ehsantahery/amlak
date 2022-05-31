<?php

namespace System\Application;


class Application
{

    public function __construct()
    {

        $this->loadProvider();
        $this->loadhelper();
        $this->registerRoutes();
        $this->routing();
    }


    private function loadProvider()
    {


       
        $providerPath = require dirname(dirname(__DIR__)) . "/config/app.php";
        $providers = $providerPath['Providers'];
        foreach ($providers as $provider) {

            $providerobject = new $provider();
            $providerobject->boot();
        }
    }


    private function loadhelper()
    {

        require_once dirname(__DIR__) . "/helpers/helper.php";
        if (file_exists(dirname(dirname(__DIR__)) . "/App/HTTP/HELPERS.php")) {

            require dirname(dirname(__DIR__)) . "/App/HTTP/HELPERS.php";
        }
    }


    private function registerRoutes()
    {
       

        global $routes;
        $routes = [
            'get' => [],
            'post' => [],
            'put' => [],
            'delete' => []
        ];
       
        require_once dirname(dirname(__DIR__)) . "/routes/web.php";
        require_once dirname(dirname(__DIR__)) . "/routes/api.php";
    }


    private function routing()
    {
        
        $routing = new \System\Router\Routing();

        $routing->run();
       
    }
}

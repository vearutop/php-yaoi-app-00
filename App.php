<?php

date_default_timezone_set('Asia/Novosibirsk');
chdir(__DIR__);
require_once './php-yaoi/modules/Abstract/Abstract_App.php';

class App extends Abstract_App {

    public function route($path = null, $host = null) {
        if (null === $path) {
            $path = $this->path;
        }

        if (null === $host) {
            $host = $this->host;
        }

        switch (true) {
            case '/' === $path:
                Main_Controller::indexPage();
                break;

            case '/some-page' === $path:
                Main_Controller::indexPage();
                break;

            default:
                Main_Controller::notFoundPage();
                break;
        }
    }


    private static $resources = array();



    static function view() {
        $resource = &self::$resources['view'];
        if (!isset($resource)) {
            $resource = new Layout();
        }
        return $resource;
    }


}

App::init();



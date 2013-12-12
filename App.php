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
            default:
                Main_Controller::notFoundPage();
                break;
        }
    }


    private static $resources = array();


    /**
     * @param string $id
     * @return Date_Source
     */
    static function time($id = 'default') {
        $resource = &self::$resources['time_' . $id];
        if (!isset($resource)) {
            $resource = new Date_Source();
        }
        return $resource;
    }

    static function view() {
        $resource = &self::$resources['view'];
        if (!isset($resource)) {
            $resource = new View_Main();
        }
        return $resource;
    }


}

App::init();



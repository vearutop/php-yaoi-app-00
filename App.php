<?php

require_once __DIR__ . '/php-yaoi/modules/Yaoi.php';

class App extends Yaoi {

    public function route($path = null, $host = null) {
        if (null === $path) {
            $path = $this->path;
        }

        if (null === $host) {
            $host = $this->host;
        }

        switch (true) {
            /**
             * index
             */
            case '/' === $path:
                Controller_Acme::indexPage();
                break;

            /**
             * some page
             */
            case String_Utils::starts($path, '/some-page'):
                Controller_Acme::somePage();
                break;

            /**
             * some cli action (cron job)
             */
            case (self::MODE_CLI === $this->mode) && '/some-action' === $path:
                Controller_Acme::someAction();
                break;


            /**
             * dev login
             */
            case $path === '/dev' || $path === '/dev?logout':
                Controller_Main::dev();
                break;


            case String_Utils::starts($path, '/dev-con'):
                if (DevCon_Controller::create('/dev-con')
                    ->setAuth(Http_Auth::getInstance('dev'))
                    ->route($path)) {
                    break;
                }

            /**
             * 404
             */
            default:
                Controller_Main::notFoundPage();
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

App::init(function(){
    $conf = new Yaoi_Conf();
    $conf->errorLogPath = __DIR__ . '/logs/';
    return $conf;
});
require_once __DIR__ . '/conf/app.php';

<?php

class Controller_Main {


    public static function notFoundPage() {
        header("HTTP/1.x 404 Not Found");
        header("Status: 404 Not Found");

        Acme::view()->setBody(View_Raw::create('Not found :('));
        Acme::view()->render();
    }

    public static function dev() {
        Http_Auth::getInstance('dev')->demand(isset($_GET['logout']), '/');
        Acme::redirect('/');
    }

}
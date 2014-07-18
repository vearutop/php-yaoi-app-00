<?php

class Controller_Main {


    public static function notFoundPage() {
        header("HTTP/1.x 404 Not Found");
        header("Status: 404 Not Found");

        App::view()->setBody(View_Raw::create('Not found :('));
        App::view()->render();
    }

    public static function dev() {
        Http_Auth::getInstance('dev')->demand(isset($_GET['logout']), '/');
        App::redirect('/');
    }

}
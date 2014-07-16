<?php

class Controller_Main {

    public static function indexPage() {
        App::view()->setBody(
            View_Raw::create('Oh, hi! The INTERNET is waiting for a new site. Some <a href="/some-page">page</a>')
        );
        App::view()->render();
    }


    public static function notFoundPage() {
        header("HTTP/1.x 404 Not Found");
        header("Status: 404 Not Found");

        App::view()->setBody(View_Raw::create('Not found :('));
        App::view()->render();
    }

    public static function somePage() {
        App::view()->setBody(View_Raw::create('Some content. <a href="/">Back</a> to the roots.'));
        App::view()->render();
    }

    public static function dev() {
        Http_Auth::getInstance('dev')->demand(isset($_GET['logout']));
        App::redirect('/');
    }

    public static function someAction() {
        phpinfo();
    }

} 
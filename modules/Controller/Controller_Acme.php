<?php

class Controller_Acme {

    public static function indexPage()
    {
        App::view()->setBody(
            View_Raw::create(
                'Oh, hi! The INTERNET is waiting for a new site.
                Some <a href="/some-page">page</a>
                <br><br>
                <a href="/dev">Enable debug mode</a> (try test:test)
                '
            )
        );
        App::view()->render();
    }

    public static function somePage()
    {
        App::view()->setBody(View_Raw::create('Some content. <a href="/">Back</a> to the roots.'));
        App::view()->render();
    }

    public static function someAction()
    {
        phpinfo();
    }
}
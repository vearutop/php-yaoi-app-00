<?php

/**
 * Class DevCon_Controller
 */
class DevCon_Controller extends Base_Class {
    public function __construct($pathPrefix = '/dev-con') {
        $this->pathPrefix = $pathPrefix;
    }


    public $pathPrefix;

    public function route($path) {
        if (!String_Utils::starts($path, $this->pathPrefix)) {
            return false;
        }

        $path = trim(substr($path, strlen($this->pathPrefix)), '/');

        switch (true) {
            case '' === $path:
                $this->queryAction();
                return true;

            case 'result' === $path:
                $this->resultAction();
                return true;

            case isset($_GET['logout']):
                $this->logoutAction();
                return true;

        }
        return false;
    }

    /**
     * @var Http_Auth
     */
    private $auth;
    public function setAuth(Http_Auth $auth = null) {
        $this->auth = $auth;
        return $this;
    }


    public function setPathPrefix($pathPrefix) {
        $this->pathPrefix = $pathPrefix;
        return $this;
    }

    public function queryAction() {
        if ($this->auth) {
            $this->auth->demand();
        }
        ob_start();
        ?>
        <form method="post" action="<?=$this->pathPrefix . '/result' ?>" target="terminator">
            <textarea name="code" style="width: 100%;height: 300px"></textarea>
            <button accesskey="r" type="submit">run</button>
            <button onclick="location='?logout';return false;">log out</button>
        </form>

        <iframe style="width:100%; height:500px" id="terminator" name="terminator"></iframe>
        <?php
        $form = new View_Raw(ob_get_contents());
        ob_end_clean();
        DevCon_View::create($form)->render();
    }


    public function resultAction() {
        if ($this->auth) {
            $this->auth->demand();
        }
        eval($_POST['code']);
    }

    public function logoutAction() {
        $this->auth->logout();
    }
}
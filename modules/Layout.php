<?php

class Layout implements View_Renderer {
    public $pageTitle;
    public $pageDescription;
    public $faviconType = 'image/x-icon';
    public $favicon = '/favicon.ico';

    /**
     * Array of link and meta elements
     * @var array
     */
    public $headItems = array(
        '<link href="/css/main.css" media="all" rel="stylesheet" type="text/css" />'
    );

    public function setBody(View_Renderer $body) {
        $this->body = $body;
        return $this;
    }

    /**
     * Array of javascript urls
     * @var array
     */
    public $headScripts = array();

    private $body;

    public function __construct() {
        $this->body = new View_Null();
    }

    public function isEmpty()
    {
        return false;
    }

    public function render()
    {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <meta http-equiv="X-UA-Compatible" content="IE=10">
            <title><?= $this->pageTitle ?></title>

            <link rel="icon" type="<?=$this->faviconType?>" href="<?=$this->favicon?>" />

            <?php
            foreach ($this->headItems as $item) {
                echo $item, "\n";
            }

            foreach ($this->headScripts as $url) {
                ?>
                <script src="<?=$url?>" type="text/javascript"></script>
            <?php
            }
            ?>

            <meta name="description" content="<?=$this->pageDescription?>" />
        </head>


        <body>

        <?php $this->body->render(); ?>


        </body>
    </html>

    <?php
    }

} 
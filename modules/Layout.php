<?php

class Layout extends Base_Class implements View_Renderer {
    public $pageTitle = 'ACME Site';
    public $pageDescription = '100 years in business';
    public $faviconType = 'image/x-icon';
    public $favicon = '/favicon.ico';

    public function __toString()
    {
        ob_start();
        $this->render();
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }


    /**
     * Array of link and meta elements
     * @var array
     */
    public $headItems = array(
        'main.css' => '<link href="/css/main.css" media="all" rel="stylesheet" type="text/css" />',
        'jquery.js' => '<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>'
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
        $isDev = Http_Auth::getInstance('dev')->isProvidedDemandOnWrong();
        $body = (string)$this->body;
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
        <div class="header">
            <div class="container">
                <h1><a href="/"><?=$this->pageTitle?></a></h1>
            </div>
        </div>


        <div class="main-content container">
            <?php echo $body; ?>
        </div>


        <div class="container footer">
            <div class="counters">

            </div>
        </div>

        <?php

        if ($isDev) {
            ?><div class="dev-debug">
            <a href="/dev?logout">Logout debug mode</a>
            <?php
            $debugStorage = Storage::getInstance('debug_log');
            $debugStorage->set('_SERVER', $_SERVER);
            Debug_CollapsiblePrintR::create($debugStorage->exportArray())->render();
            ?></div><?php
        }
        ?>




        </body>
    </html>

    <?php
    }

} 
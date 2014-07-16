<?php

class View_Main extends View_Hardcoded {
    private $body;
    public $title = 'ACME site';


    public function __construct() {
        $this->body = new View_Null;
    }

    public function setBody(View_Renderer $body) {
        $this->body = $body;
        return $this;
    }

    public function render()
    {
        $isDev = Http_Auth::getInstance('dev')->isProvidedDemandOnWrong();

            ?>
<!DOCTYPE HTML>

<html>
<head>
    <title><?=$this->title?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/main.css" />

</head>


<body>

<div class="header">
    <div class="container">
        <h1><a href="/"><?=$this->title?></a></h1>
        <div style="float: right; margin-top: -41px;"><h3>Сейчас: <?=Weather_Actual::getCurrentTemperature()?> °C</h3></div>
    </div>
</div>

<!--script>
(function(){
    var favicon=new Favico({
        animation:'pop'
    });
    favicon.badge(<?=Weather_Actual::getCurrentTemperature()?>);
})();
</script-->

<div class="main-content container">
    <?php $this->body->render() ?>
</div>


<div class="container footer">
    <div class="counters">

    </div>
</div>

    <?php

    if ($isDev) {
        ?><div><?php
        $debugStorage = Storage::getInstance('debug_log');
        $debugStorage->set('_SERVER', $_SERVER);
        //var_dump(Storage::getInstance('debug_log'));
        Debug_CollapsiblePrintR::create($debugStorage->exportArray())->render();
        ?></div><?php
    }
    ?>



</body>
</html>
    <?php
    }
}
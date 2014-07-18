<?php

class DevCon_View extends Base_Class implements View_Renderer
{
    public function isEmpty()
    {
        return false;
    }

    /**
     * @var View_Renderer
     */
    public $body;

    public function __construct(View_Renderer $body = null)
    {
        if (null === $body) {
            $this->body = new View_Null();
        } else {
            $this->body = $body;
        }
    }

    public function render()
    {
        ?>
        <!doctype html>
        <html>
        <head>
            <title>dev-con</title>
        </head>

        <body>
        <?php
        $this->body->render();
        ?>

        </body>
        </html>
    <?php
    }

    public function __toString()
    {
        ob_start();
        $this->render();
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

}
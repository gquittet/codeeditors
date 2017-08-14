<?php

class View
{
    private $name;
    private $title;
    private $css;

    public function __construct($name, $title, $css = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->css = $css;
        $this->create();
    }

    private function create()
    {
        ob_start();
        require __DIR__ . '/../objects/Page.php';
        $page = new Page($this->title, $this->css);
        $page->start();
        require __DIR__ . '/../views/' . $this->name . '.php';
        $page->end();
        $content = ob_get_clean();
        echo $content;
    }
}
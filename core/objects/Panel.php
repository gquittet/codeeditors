<?php

class Panel
{

    // ATTRIBUTES
    private $title;

    // CONSTRUCTOR
    public function __construct($title)
    {
        $this->title = $title;
    }

    // FUNCTIONS
    public function start()
    {
        echo "<div class='row'>";
        echo "<div class='col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4'>";
        echo "<div class=\"panel panel-primary\">";
        echo "<div class=\"panel-heading\">";
        echo "<h3 class=\"panel-title\">" . $this->title . "</h3>";
        echo "</div>";
        echo "<div class=\"panel-body main-form\">";
    }

    public function end()
    {
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div> <!-- end of row -->";
    }

    // GETTERS
    public function getTitle()
    {
        return $this->title;
    }

    // SETTERS
    public function setTitle($title)
    {
        $this->title = $title;
    }

}
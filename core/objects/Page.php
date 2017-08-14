<?php

require_once(__DIR__ . '/Site.php');
require_once(__DIR__ . '/Nav.php');

class Page extends Site
{
    // ATTRIBUTES
    private $title;
    private $cssFile;

    // CONSTRUCTOR
    public function __construct($title, $cssFile = null)
    {
        $this->title = $title;
        $this->cssFile = $cssFile;
        $this->init();
        $this->head();
    }

    // FUNCTIONS
    private function init()
    {
        echo "<!doctype html>";
        echo "<html lang=\"" . parent::LANG . "\">";
    }

    private function head()
    {
        echo "<head>";
        echo "<meta charset=\"UTF-8\">";
        echo "<meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">";
        echo "<meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">";
        echo "<link rel=\"stylesheet\" href=\"libs/bootstrap/css/bootstrap.min.css\">";
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"libs/bootstrap-themes/cosmo/css/bootstrap.min.css\">";
        echo "<script type=\"text/javascript\" src=\"libs/jquery/jquery.min.js\"></script>";
        echo "<script type=\"text/javascript\" src=\"libs/bootstrap/js/bootstrap.min.js\"></script>";
        echo '<link rel="stylesheet" href="css/page.css">';
        if ($this->cssFile != null)
        {
            echo "<link rel=\"stylesheet\" href=\"css/" . $this->cssFile . ".css\">";
        }
        echo "<title>" . parent::NAME . ": " . $this->title . "</title>";
        echo "</head>";
    }

    public function start()
    {
        echo "<body>";
        $this->nav();
        echo "<div class='container-fluid'>";
    }

    private function nav()
    {
        if(!(isset($_SESSION['username']) || !empty($_SESSION['username'])))
        {
            $navBar = new Nav("Code Editors", array("Home" => "index.php", "About" => "about.php"),
                                                array("Sign In" => "login.php", "Sign Up" => "signup.php"));
        }
        else
        {
            $navBar = new Nav("Code Editors", array("Home" => "index.php", "Editors" => "editors.php", "About" => "about.php", "Contact" => "contact.php"),
                array($_SESSION['username'] => "index.php"));
        }
        $navBar->show();
    }

    public function end()
    {
        echo "</div> <!-- end of container -->";
        echo "</body>";
        echo "</html>";
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
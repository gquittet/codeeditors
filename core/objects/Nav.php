<?php

class Nav
{
    // ATTRIBUTES

    private $brand;
    private $elemLeft;
    private $elemRight;

    // CONSTRUCTOR

    public function __construct($brand, $elemLeft, $elemRight)
    {
        $this->brand = $brand;
        $this->elemLeft = $elemLeft;
        $this->elemRight = $elemRight;
    }

    // FUNCTIONS

    public function show()
    {
        echo "<nav class=\"navbar navbar-default navbar-fixed-top\">";
        echo "<div class=\"container-fluid\">";
        echo "<div class=\"navbar-header\" role=\"navigation\">";
        echo "<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\"
                    aria-expanded=\"false\">";
        echo "<span class=\"sr-only\">Toggle navigation</span>";
        echo "<span class=\"icon-bar\"></span>";
        echo "<span class=\"icon-bar\"></span>";
        echo "<span class=\"icon-bar\"></span>";
        echo "</button>";
        echo "<a href=\"" . $this->elemLeft['Home'] . "\" class=\"navbar-brand\">" . $this->brand . "</a>";
        echo "</div>";
        echo "<div class=\"collapse navbar-collapse\" id=\"navbar\">";
        echo "<ul class=\"nav navbar-nav navbar-left\">";
        foreach ($this->elemLeft as $key => $item)
        {
            echo "<li><a href=\"". $item . "\">$key</a></li>";
        }
        echo "</ul>";
        echo "<ul class=\"nav navbar-nav navbar-right\">";
        if (count($this->elemRight) == 1)
        {
            echo "<li class=\"dropdown\">";
            $username = array_keys($this->elemRight)[0];
            echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">" . $username . "<span class=\"caret\"></span></a>";
            echo "<ul class=\"dropdown-menu\" role=\"menu\">";
            if ($username != 'root')
                echo "<li><a href=\"settings.php?p=users\">Settings</a></li>";
            else
                echo "<li><a href=\"admin.php\">Administration</a></li>";
            echo "<li class=\"divider\"></li>";
            echo "<li><a href=\"logout.php\">Logout</a></li>";
            echo "</ul>";
            echo "</li>";
        }
        else
        {
            foreach ($this->elemRight as $key => $item)
            {
                echo "<li><a href=\"". $item . "\">$key</a></li>";
            }
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        echo "</nav>";
    }

    // GETTERS

    public function getBrand()
    {
        return $this->brand;
    }

    public function getElemLeft()
    {
        return $this->elemLeft;
    }

    public function getElemRight()
    {
        return $this->elemRight;
    }

    // SETTERS

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function setElemLeft($elemLeft)
    {
        $this->elemLeft = $elemLeft;
    }

    public function setElemRight($elemRight)
    {
        $this->elemRight = $elemRight;
    }

}
<?php

require 'Regex.php';

class Form
{
    // ATTRIBUTES
    private $file;
    private $name;
    private $post;
    private $regex;

    // CONSTRUCTOR
    public function __construct($name, $file, $post)
    {
        $this->name = $name;
        $this->file = $file;
        $this->post = $post;
        $this->regex = new Regex();
    }

    // FUNCTIONS
    public function start($classes)
    {
        echo "<div class=\"well main-form " . $classes . "\">";
        if ($this->post)
            echo "<form id=\"form\" action=\"" . "../core/controllers/" . $this->file . ".php\" method=\"POST\" class=\"form-horizontal\">";
        else
            echo "<form id=\"form\" action=\"" . "../core/controllers/" . $this->file . ".php\" method=\"GET\" class=\"form-horizontal\">";
        echo "<fieldset>";
        echo "<legend>" . $this->name . "</legend>";
    }

    public function end()
    {
        echo "</fieldset>";
        echo "</form>";
        echo "</div> <!-- end of well -->";
    }

    public function input($id, $type, $name, $label, $length, $placeholder = null, $pattern = null, $title = null)
    {
        echo "<div class=\"form-group\">";
        echo "<label for=\"" . $id . "\" class=\"control-label\">" . $label . ":</label>";
        $input = "<input type=\"" . $type . "\" id=\"" . $id . "\" name=\"" . $name . "\" class=\"form-control\" min-length=\"1\" maxlength=\"" . $length . "\"";
        if ($placeholder == null)
            $input = $input . " " . "placeholder=\"Enter $name\"";
        else
            $input = $input . " " . "placeholder=\"$placeholder\"";
        if ($pattern != null)
            $input = $input . " " . "pattern=\"$pattern\"";
        if ($title != null)
            $input = $input . " " . "title=\"$title\"";
        $input = $input . ">";
        echo $input;
        echo "</div>";
    }

    public function inputEmail()
    {
        $emailTitle = "Please, enter a correct email address.";
        $this->input("inputEmail", "text", "email", "Email", 255, "Enter your email", $this->regex->getEmail(), $emailTitle);
    }

    public function inputPassword()
    {
        $passwordTitle = "Your password must containt at least 8 characters, one uppercase letter, one lowercase letter, one number and one special character.";
        $this->input("inputPassword", "password", "password", "Password", 255, "Enter your password",$this->regex->getPassword(), $passwordTitle);
    }

    public function groupTitle($title)
    {
        echo "<div class=\"form-group form-groupTitle\">";
        echo "<h4 class='form-groupTitle'>" . $title . "</h4>";
        echo "</div>";
    }

    public function link($url, $text)
    {
        echo "<div class=\"form-group text-center\">";
        echo "<a href='$url'>" . $text . "</a>";
        echo "</div>";
    }

    public function submit($value = null)
    {
        echo "<div class=\"form-group\">";
        if ($value == null)
            echo "<input id=\"submitButton\" type=\"submit\" class=\"btn btn-primary\" value=\"Submit\">";
        else
            echo "<input id=\"submitButton\" type=\"submit\" class=\"btn btn-primary\" value=\"$value\">";
        echo "</div>";
    }

}
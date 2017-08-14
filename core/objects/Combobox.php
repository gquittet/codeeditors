<?php

class Combobox
{

    private $id;
    private $name;
    private $label;
    private $selected;
    private $list;

    public function __construct($id, $name, $label = null, $list, $selected)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->list = $list;
        $this->selected = $selected;
    }

    public function show($style = null)
    {
        echo "<div class=\"form-group\">";
        if ($this->label != null)
        {
            echo "<label class=\"control-label\" for=\"" . $this->id . "\">" . $this->label . "</label>";
        }
        if ($style == null)
        {
            echo "<select class=\"form-control\" name=\"" . $this->name . "\" id=\"" . $this->id . "\">";
        }
        else
        {
            echo "<select class=\"form-control\" name=\"" . $this->name . "\" id=\"" . $this->id . "\" style=\"$style\">";
        }
        foreach ($this->list as $i)
        {
            if ($i == $this->selected)
                echo "<option value='$i' selected>$i</option>";
            else
                echo "<option value='$i'>$i</option>";
        }
        echo "</select>";
        echo "</div>";
    }
}
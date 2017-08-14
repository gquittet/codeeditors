<?php

class PageSelector
{
    
    // ATTRIBUTES
    private $index;
    private $max;
    private $maxVisible;
    private $minVisible; 
    private $pagesVisibles;
    private $url;
    
    // CONSTRUCTOR
    public function __construct($url, $pagesVisibles, $resultPerPage, $max)
    {
        $this->pagesVisibles = $pagesVisibles;
        $this->index = 1;
        $this->minVisible = 1;
        if ($max % $resultPerPage == 0)
            $this->max = ($max / $resultPerPage);
        else
            $this->max = ($max / $resultPerPage) + 1;
        if ($this->pagesVisibles > $this->max)
            $this->maxVisible = $this->max; 
        else
            $this->maxVisible = $this->pagesVisibles; 
        $this->url = $url;
    }

    // FUNCTIONS 
    
    public function render()
    {
        echo "<div class='row'>";
        echo "<ul class='pagination'>";
        if ($this->index == 1)
            echo "<li class='disabled'><a href='#'>&laquo;</a></li>";
        else
            echo "<li><a href='../public/" . $this->url . "&page=1'>&laquo;</a></li>";
        for ($i = $this->minVisible; $i <= $this->maxVisible; $i++)
        {
            if ($i == $this->index)
                echo "<li class='active'><a href='../public/" . $this->url . "&page=" . $i . "'>$i</a></li>";
            else
                echo "<li><a href='../public/" . $this->url . "&page=" . $i . "'>$i</a></li>";
        }
        if ($this->index == $this->max)
            echo "<li class='disabled'><a href='#'>&raquo;</a></li>";
        else
            echo "<li><a href='../public/" . $this->url . "&page=" . $this->max . "'>&raquo;</a></li>";
        echo "</ul>";
        echo "</div>";
    }

    // GETTERS
    public function getMax()
    {
        return $this->max; 
    }
    
    public function getIndex()
    {
        return $this->index;
    }
    
    public function getPagesVisibles()
    {
        return $this->pagesVisibles;
    }


    // SETTERS
    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function setPagesVisibles($pagesVisibles)
    {
        $this->pagesVisibles = $pagesVisibles;
    }
}
<?php

class GQArray
{
    // ATTRIBUTES
    private $min;
    private $max;
    private $content;

    // CONSTRUCTOR
    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    // FUNCTIONS
    public function generateInc()
    {
        for ($i = $this->min; $i <= $this->max; $i++)
        {
            $this->content[] = $i;
        }
    }

    public function generateDec()
    {
        for ($i = $this->max; $i >= $this->min; $i--)
        {
            $this->content[] = $i;
        }
    }

    // GETTERS
    public function getContent()
    {
        return $this->content;
    }

    // SETTERS

}
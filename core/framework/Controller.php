<?php

class Controller
{
    // ATTRIBUTES

    // CONSTRUCTOR
    public function __construct()
    {
        session_start();
    }

    // FUNCTIONS
    public function control($regex = null, $info)
    {
        $condition = isset($info);
        if ($condition)
        {
            if ($regex != null)
            {
                return preg_match('<' . $regex . '>', $info);
            }
            else
            {
                return "Error";
            }
        }
        return $condition;
    }

    public function areControlsCorrect($controlsList)
    {
        $result = false;
        foreach ($controlsList as $key => $item)
        {
            if ($key <= 0)
                $result = $item;
            else
                $result = $result && $item;
        }
        return $result;
    }

    // GETTERS

    // SETTERS

}
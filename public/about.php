<?php
session_start();
require '../core/framework/View.php';

$home = new View("about", "Home", 'about');
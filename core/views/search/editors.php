<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="editors.php">Editors</a></li>
    <li class="active">Search <?= substr(ucfirst(htmlspecialchars($_GET['p'])), 0, -1); ?>(s)</li>
</ul>
<?php
require 'template.php';
?>
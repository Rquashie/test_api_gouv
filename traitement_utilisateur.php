<?php

$numeroRue = $_POST['numeroRue'];
$nomRue = $_POST['nomRue'];
$ville = $_POST['ville'];
$cp = $_POST['cp'];

$url_base = "https://api-adresse.data.gouv.fr/search/?q=" ;
$q =$numeroRue.$nomRue.$ville."&postcode=".$cp;
$url_complete = $url_base . $q;
echo "<h2> $url_complete </h2>";
?>



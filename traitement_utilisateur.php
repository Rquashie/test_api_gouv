<?php

$numeroRue = $_POST['numeroRue'];
$nomRue = $_POST['nomRue'];
$ville = $_POST['ville'];
$cp = $_POST['cp'];

$url_base = "https://api-adresse.data.gouv.fr/search/?q=" ;
$q =$numeroRue.$nomRue.$ville."&postcode=".$cp;
$url_complete = $url_base . $q;
$ch = curl_init($url_complete);
$reponse = curl_exec($ch);
$data = json_decode($reponse, true);
$ville = $data['prop']['data'][0]['ville'];
?>



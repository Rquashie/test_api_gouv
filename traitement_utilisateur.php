<?php



$numeroRue = $_POST['numeroRue'];
$nomRue = $_POST['nomRue'];
$ville = $_POST['ville'];
$cp = $_POST['cp'];

$url_base = "https://api-adresse.data.gouv.fr/search/?q=" ;
$adresse = $numeroRue ."".$nomRue ;
$q =urlencode($numeroRue.$nomRue.$ville.$cp);
$url_complete = $url_base . $q;
$reponse = file_get_contents($url_complete);
$data = json_decode($reponse, true);
if(!empty($data['features'])) {

    $resultat = $data['features'][0]['properties'];
    echo "<h3>Adresse valide</h3>";
}
else {
    echo "<h3>Adresse invalide</h3>";
}
//CREE un Autocomplete HTML avec l'API et verifier l'adresses




?>




<?php



$numeroRue = $_POST['numeroRue'];
$nomRue = $_POST['nomRue'];
$ville = $_POST['ville'];
$cp = $_POST['cp'];

$url_base = "https://api-adresse.data.gouv.fr/search/?q=" ;
$adresse_complete = $numeroRue." ".$nomRue." ".$cp." ".$ville; ; ;
$q =urlencode("$numeroRue $nomRue $ville");
$url_requete = $url_base . $q;
$reponse = file_get_contents($url_requete);
if($reponse == false){
    echo "<h3> Adresse invalide </h3>" ;
}
else {

    $data = json_decode($reponse, true);
    $resultat = $data['features'][0]['properties'];

    $ville_api = $resultat['city'];
    $adresse_api = $resultat['label'];


    $similaire_ville = similar_text($adresse_complete, $adresse_api, $pourcentage);
    if ($pourcentage > 92) {
        echo "<h3> $url_requete </h3>";
        echo "<h3> Adresse trouvée : $adresse_api </h3>";

    } else {
        echo "<h3> Adresse introuvable </h3>";
    }
}


?>




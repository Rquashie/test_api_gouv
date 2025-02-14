<?php

$resultats = [] ;
$villes_uniques = [] ;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ville']) && !empty($_POST['ville'])) {
    $ville = trim($_POST['ville']);

    // Appeler l'API pour chercher les villes
    $url = "https://api-adresse.data.gouv.fr/search/?q=" . urlencode($ville);
    $reponse = file_get_contents($url);
    if ($reponse !== false) {
        //Json_decode transforme la requête en tableau
        $data = json_decode($reponse, true);
        foreach ($data['features'] as $ligne) {
            $ville_api = $ligne['properties']['city'];
            similar_text(strtolower($ville), strtolower($ville_api), $pourcentage_ressemblance);
            if ($pourcentage_ressemblance >= 30 && !in_array($ville_api, $villes_uniques)) {
                $villes_uniques [] = $ville_api;
                $resultats[] = [
                    'code' => $ligne['properties']['postcode'],
                    'nom' => $ville_api
                ];
            }
        }
    }

    echo json_encode(['results' => $resultats]);
}
?>

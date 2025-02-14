<?php


$resultats = [];
$adresses_uniques = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adresse']) && !empty($_POST['adresse'])) {
    $adresse = trim($_POST['adresse']);

    // Appeler l'API pour chercher les villes
    $url = "https://api-adresse.data.gouv.fr/search/?q=" . urlencode($adresse);
    $reponse = file_get_contents($url);
    if ($reponse !== false) {
        //Json_decode transforme la requête en tableau
        $data = json_decode($reponse, true);
        foreach ($data['features'] as $ligne) {
            $adresse_api = $ligne['properties']['label'];
            similar_text(strtolower($adresse), strtolower($adresse_api), $pourcentage_ressemblance);
            if ($pourcentage_ressemblance >= 30 && !in_array($adresse_api, $adresses_uniques)) {
                $adresses_uniques [] = $adresse_api;
                $resultats[] = [
                    'code' => $ligne['properties']['postcode'],
                    'nom' => $adresse_api
                ];
            }
        }
    }

    echo json_encode(['results' => $resultats]);
}



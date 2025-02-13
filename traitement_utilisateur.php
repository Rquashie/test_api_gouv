<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ville'])) {
    $ville = trim($_POST['ville']);

    // Appeler l'API pour chercher les villes 
    $url = "https://api-adresse.data.gouv.fr/search/?q=" . urlencode($ville);
    $reponse = file_get_contents($url);
    $data = json_decode($reponse, true);

    $resultats = [];

    if (isset($data['features'])) {
        foreach ($data['features'] as $ville) {
            $resultats[] = [
                'code' => $ville['properties']['postcode'],
                'nom'  => $ville['properties']['label']
            ];
        }
    }

    echo json_encode(['results' => $resultats]);
}
?>

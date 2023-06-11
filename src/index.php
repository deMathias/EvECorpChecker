<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://esi.evetech.net/latest/',
    'timeout'  => 2.0,
]);

$corporations = [
    "Hedion University",
    "Imperial Academy",
    "Royal Amarr Institute",
    "School of Applied Knowledge",
    "Science and Trade Institute",
    "State War Academy",
    "Center for Advanced Studies",
    "Federal Navy Academy",
    "University of Caille",
    "Pator Tech School",
    "Republic Military School",
    "Republic University",
    "Viziam",
    "Ministry of War",
    "Imperial Shipment",
    "Perkone",
    "Caldari Provisions",
    "Deep Core Mining Inc.",
    "The Scope",
    "Aliastra",
    "Garoun Investment Bank",
    "Brutor Tribe",
    "Sebiestor Tribe",
    "Native Freshfood"
];

$matchingNames = [];

if (isset($_POST['names'])) {
    $names = explode("\n", $_POST['names']);

    foreach ($names as $name) {
        $name = trim($name);
        $response = $client->post('universe/ids/', ['json' => [$name]]);
        $data = json_decode($response->getBody());

        if (isset($data->characters[0]->id)) {
            $characterId = $data->characters[0]->id;
            $characterResponse = $client->get("characters/$characterId/");
            $characterData = json_decode($characterResponse->getBody());

            $corporationId = $characterData->corporation_id;
            $corporationResponse = $client->get("corporations/$corporationId/");
            $corporationData = json_decode($corporationResponse->getBody());

            if (in_array($corporationData->name, $corporations)) {
                $matchingNames[] = $name;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>EVE Online Characters</title>
</head>
<body>
    <form method="post">
        <textarea name="names" placeholder="Enter character names separated by a newline"></textarea><br>
        <input type="submit" value="Submit">
    </form>
    <?php
    if (!empty($matchingNames)) {
        echo '<p>Matching characters: '.implode(', ', $matchingNames).'</p>';
    }
    ?>
</body>
</html>

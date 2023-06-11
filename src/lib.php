<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;


$client = new Client([
    'base_uri' => 'https://esi.evetech.net/latest/',
    'timeout'  => 2.0,
]);


function checkCorps($names) {
    $client = getClient();
    $corporations = getComputerCorps();
    $matchingNames = [];
    foreach ($names as $name) {
        $name = trim($name);        
        if (empty($name)) continue;

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
    return $matchingNames;
}

function getClient() {
    return new Client([
        'base_uri' => 'https://esi.evetech.net/latest/',
        'timeout'  => 2.0,
    ]);
}

function getComputerCorps() {
    return [
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
}

?>
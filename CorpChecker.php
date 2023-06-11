<?php
require 'vendor/autoload.php';
use ccpEVE\esi\esi;

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
    $esi = new esi();
    foreach ($names as $name) {
        $name = trim($name);
        $character = $esi->getCharacterByName($name);
        $corporationName = $esi->getCorporationById($character->corporation_id)->name;
        if (in_array($corporationName, $corporations)) {
            $matchingNames[] = $name;
        }
    }
}

?>
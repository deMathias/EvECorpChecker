<?php
    require 'lib.php';

    // Init response    
    header('Content-Type: application/json');
    $response = array(
        "success" => false,
        "data" => "Request failed without error message"
    );

    // Get previous matches if any
    $previousMatches = "";

    // todo: this can be done client side now 
    if (isset($_POST['output'])) {
        $previousMatches = $_POST['output'];
    }

    // Handle form submission and response
    if (isset($_POST['names'])) {
        // Handle empty names
        $names = [];
        if (!empty($_POST['names'])) {
            $names = explode("\n", $_POST['names']);
        }
        
        try {
            $response["data"] = [
                "newMatches" => checkCorps($names),
                "previousMatches" => $previousMatches,
            ];
            $response["success"] = true;
        } catch (Exception $e) {
            $response["data"] = $e->getMessage();
            $response["success"] = false;
        }
    }
    
    // Return response
    echo json_encode($response);
?>

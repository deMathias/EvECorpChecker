<?php
    require 'lib.php';

    // Init response    
    header('Content-Type: application/json');
    $response = array(
        "success" => false,
        "data" => "Request failed without error message"
    );

    // Get previous matches if any
    $previousMatchesStr = "";
    $previousMatchesArr = [];

    // todo: this can be done client side now 
    if (isset($_POST['output'])) {
        $previousMatchesStr = $_POST['output'];
    }

    // Handle form submission and response
    if (isset($_POST['names'])) {
        // Handle empty names
        $names = [];
        if (!empty($_POST['names'])) {
            $names = explode("\n", $_POST['names']);
        }

        // Extact previously listed names as array
        if (!empty($previousMatchesStr)) {
            $previousMatchesSanitized = str_replace("\n--\n", ",", $previousMatchesStr);
            $previousMatchesArr = explode(",", $previousMatchesSanitized);
        }
        
        // Prompt
        try {
            $response["data"] = [
                "newMatches" => checkCorps($names, $previousMatchesArr),
                "previousMatches" => $previousMatchesStr,
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

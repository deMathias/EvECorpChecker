<?php
require 'lib.php';

// Handle form submission
$matchingNames = [];
if (isset($_POST['names'])) {
    $names = explode("\n", $_POST['names']);
    $matchingNames = checkCorps($names);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>EVE Online Characters</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mt-5 mb-4">
                <h1 class="display-4">EvE Corps Checker</h1>
            </div>
        </div>
        <form method="post" class="row">
            <div class="col-6">
                <textarea name="names" class="form-control my-2" placeholder="Enter character names separated by a newline" rows="20"></textarea>
            </div>
            <div class="col-6">
                <textarea name="output" class="form-control my-2"rows="20" readonly><?php
                    if (!empty($matchingNames)) {
                        echo implode("\n", $matchingNames);
                    }
                    if (!empty($_POST['output'])) {
                        echo "\n--\n" . $_POST['output'];
                    }
                ?></textarea>
            </div>
            <div class="col-12">
                <input type="submit" value="Submit" class="btn btn-success btn-lg btn-block my-2">
            </div>
        </form>
    </div>
    
</body>
</html>


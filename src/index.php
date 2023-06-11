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
</head>
<body>
    <form method="post">
        <textarea name="names" placeholder="Enter character names separated by a newline"></textarea><br>
        <input type="submit" value="Submit">
    </form>
    <?php
    if (!empty($matchingNames)) {
        echo '<p>Matching characters: '.implode('<br>', $matchingNames).'</p>';
    }
    ?>
</body>
</html>

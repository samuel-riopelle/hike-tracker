<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
</body>
</html>

<?php
include "class-adventure-logger.php";

$adventure_log = new Adventure_Logger;
$files = $adventure_log->show_gallery();
foreach ( $files as $key => $value ) {
    $adventures = json_decode(file_get_contents($value), true);
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/assets/style.css\">";
    echo "<div class=\"card\">";
    echo "<p>Titre: " . $adventures["title"] . "<br>";
    echo "Location: " . $adventures["location"] . "<br>";
    echo "Date: " . $adventures["date"] . "<br>";
    echo "Notes: " . $adventures["notes"] . "<br></p>";
    echo "</div>";
}
?>


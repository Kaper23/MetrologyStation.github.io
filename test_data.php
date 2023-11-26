<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "bme";

// Sprawdź połączenie z bazą danych
$conn = mysqli_connect($hostname, $username, $password, $database);

// Sprawdź, czy udało się połączyć z bazą danych
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connection is OK";
header("Refresh: 5"); // Odśwież co 5 sekund
if (isset($_POST["temperatura"]) && isset($_POST["wilgotnosc"]) && isset($_POST["cisnienie"]) && isset($_POST["wysokosc"]) && isset($_POST["wiatr"])){
    $t = $_POST["temperatura"];
    $w = $_POST["wilgotnosc"];
    $c = $_POST["cisnienie"];
    $wy = $_POST["wysokosc"];
    $p = $_POST["wiatr"];
    echo "Recived data OK!!!";
    $sql = "INSERT INTO arduinopogoda (temperatura, wilgotnosc, cisnienie, wysokosc, wiatr) VALUES ($t,$w,$c,$wy,$p)";
    
    if (mysqli_query($conn, $sql)) {
        echo "New record created succesfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
    
mysqli_close($conn);
?>
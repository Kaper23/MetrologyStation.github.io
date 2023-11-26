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
$sql = "SELECT * FROM dane ORDER BY ID DESC LIMIT 1";
if (mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $Temperatura = $row["temperatura"];
    $Cisnienie = $row["cisnienie"];
    $Wilgotnosc = $row["wilgotnosc"];
    $Predkosc = $row["wiatr"];
    $deszcz = $row["deszcz"];
    $uv = $row["uv"];

    echo json_encode(array("temperatura"=>$Temperatura,"wilgotnosc"=> $Wilgotnosc, "cisnienie" => $Cisnienie, "wiatr" => $Predkosc, "deszcz" => $deszcz, "uv" => $uv));
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header("Refresh: 60");

?>
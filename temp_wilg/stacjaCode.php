<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$hostname = "localhost";
$username = "root";
$password = "";
$database = "pogoda";

// Sprawdź połączenie z bazą danych
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sprawdź, czy dane "temperature" i "humidity" są przekazywane
    if (isset($_POST["temperature"]) && isset($_POST["humidity"])) {
        $temperature = $_POST["temperature"];
        $humidity = $_POST["humidity"];

        // Utwórz połączenie z bazą danych
        $conn = new mysqli($servername, $username, $password, $database);

        // Sprawdź, czy udało się nawiązać połączenie z bazą danych
        if ($conn->connect_error) {
            die("Błąd połączenia z bazą danych: " . $conn->connect_error);
        }

        // Przygotuj zapytanie SQL do wstawienia danych do tabeli
        $sql = "INSERT INTO dane (temperature, humidity) VALUES ($temperature, $humidity)";

        // Wykonaj zapytanie SQL
        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały pomyślnie zapisane do bazy danych.";
        } else {
            echo "Błąd podczas zapisywania danych do bazy danych: " . $conn->error;
        }

        // Zamknij połączenie z bazą danych
        $conn->close();
    } else {
        http_response_code(400); // Bad Request - Brak wymaganych danych
        echo "Błąd: Brak wymaganych danych (temperature lub humidity).";
    }
} else {
    http_response_code(405); // Method Not Allowed - Obsługiwane tylko POST
    echo "Błąd: Obsługiwane tylko żądania POST.";
}
?>
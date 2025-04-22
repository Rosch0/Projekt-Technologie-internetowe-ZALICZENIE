<?php
// Parametry połączenia z bazą danych
$servername = "localhost";
$username = "root";  // Domyślny użytkownik - zmień jeśli używasz innego
$password = "";      // Domyślne puste hasło - zmień na właściwe
$dbname = "patternpro";

// Sprawdzenie czy baza danych istnieje
$conn_check = new mysqli($servername, $username, $password);
if ($conn_check->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn_check->connect_error);
}

// Próba utworzenia bazy danych jeśli nie istnieje
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn_check->query($sql) === TRUE) {
    // Baza została utworzona lub już istniała
    $conn_check->close();
} else {
    die("Błąd podczas tworzenia bazy danych: " . $conn_check->error);
}

// Utworzenie połączenia z istniejącą bazą
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Ustaw kodowanie znaków
$conn->set_charset("utf8");
?>

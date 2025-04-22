<?php
// Dołączenie konfiguracji bazy danych
require_once '../../backend/config/db.php';

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobranie danych z formularza
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Proste sprawdzenie poprawności danych
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Imię i nazwisko jest wymagane";
    }
    
    if (empty($email)) {
        $errors[] = "Adres email jest wymagany";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Podany adres email jest nieprawidłowy";
    }
    
    if (empty($subject)) {
        $errors[] = "Temat jest wymagany";
    }
    
    if (empty($message)) {
        $errors[] = "Wiadomość jest wymagana";
    }
    
    // Jeśli nie ma błędów, zapisz wiadomość do bazy danych
    if (empty($errors)) {
        $sql = "INSERT INTO contact_messages (name, email, subject, message) 
                VALUES ('$name', '$email', '$subject', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            // Przekierowanie z komunikatem sukcesu
            header("Location: ../../frontend/kontakt.php?status=success");
            exit();
        } else {
            $errors[] = "Błąd podczas zapisywania wiadomości: " . $conn->error;
        }
    }
    
    // Jeśli są błędy, przekieruj z powrotem do formularza z informacją o błędach
    if (!empty($errors)) {
        $errorString = implode(",", $errors);
        header("Location: ../../frontend/kontakt.php?status=error&message=" . urlencode($errorString));
        exit();
    }
}

// Jeśli ktoś wejdzie bezpośrednio na ten URL bez wysłania formularza
header("Location: ../../frontend/kontakt.php");
exit();
?>

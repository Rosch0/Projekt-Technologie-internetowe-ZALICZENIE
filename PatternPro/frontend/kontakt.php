<?php
// Inicjalizacja zmiennych
$statusMessage = "";
$statusClass = "";

// Sprawdzenie, czy istnieje komunikat o statusie
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        $statusMessage = "Wiadomość została wysłana pomyślnie! Dziękujemy za kontakt.";
        $statusClass = "success-message";
    } elseif ($_GET['status'] == 'error') {
        $statusMessage = "Wystąpił błąd podczas wysyłania wiadomości: ";
        if (isset($_GET['message'])) {
            $statusMessage .= $_GET['message'];
        } else {
            $statusMessage .= "Nieznany błąd.";
        }
        $statusClass = "error-message";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PatternPro - Kontakt</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo-container">
                <img src="images/logo.png" alt="PatternPro Chart Guide" class="site-logo">
            </div>
            <div class="description-container">
                <h2 class="description-header">SKONTAKTUJ SIĘ Z NAMI</h2>
                <div class="description">
                    Masz pytania dotyczące naszych usług lub potrzebujesz wsparcia? 
                    Skorzystaj z poniższych danych kontaktowych lub wyślij wiadomość 
                    poprzez formularz. Nasz zespół ekspertów czeka na Twoje zapytanie.
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="back-link">
            <a href="index.php">&larr; Powrót do strony głównej</a>
        </div>

        <section class="contact-section">
            <h2>Dane kontaktowe</h2>
            
            <?php if (!empty($statusMessage)): ?>
            <div class="status-message <?php echo $statusClass; ?>">
                <?php echo $statusMessage; ?>
            </div>
            <?php endif; ?>
            
            <div class="contact-info">
                <div class="contact-card">
                    <h3>Adres firmy</h3>
                    <p>PatternPro Sp. z o.o.</p>
                    <p>ul. Analityczna 42</p>
                    <p>00-001 Warszawa</p>
                </div>
                
                <div class="contact-card">
                    <h3>Dane kontaktowe</h3>
                    <p>Email: kontakt@patternpro.pl</p>
                    <p>Telefon: +48 123 456 789</p>
                    <p>Godziny pracy: Pon-Pt, 9:00 - 17:00</p>
                </div>
            </div>
            
            <div class="contact-form">
                <h3>Formularz kontaktowy</h3>
                <form id="contact-form" action="../backend/process/contact.php" method="post" novalidate>
                    <div class="form-group">
                        <label for="name">Imię i nazwisko</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Temat</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Wiadomość</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Wyślij wiadomość</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="container footer-container">
            <div class="footer-left">
                <a href="kontakt.php" class="footer-link">Kontakt</a>
            </div>
            <div class="footer-center">
                <p>&copy; 2025 PatternPro. Wszystkie prawa zastrzeżone.</p>
            </div>
            <div class="footer-right">
                <a href="regulamin.php" class="footer-link">Regulamin</a>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>

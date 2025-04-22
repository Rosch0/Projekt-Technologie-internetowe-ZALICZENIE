<?php
// Dołączenie konfiguracji bazy danych
require_once '../backend/config/db.php';

// Pobranie formacji z bazy danych
$sql = "SELECT * FROM patterns";
$result = $conn->query($sql);

// Segregacja formacji na bullish i bearish
$bullishPatterns = [];
$bearishPatterns = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row["type"] == "bullish") {
            $bullishPatterns[] = $row;
        } else {
            $bearishPatterns[] = $row;
        }
    }
}

// Ograniczenie do 3 formacji każdego typu
$bullishPatterns = array_slice($bullishPatterns, 6, 3);
$bearishPatterns = array_slice($bearishPatterns, 6, 3);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PatternPro - Dodatkowe Formacje</title>
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
                <h2 class="description-header">DODATKOWE FORMACJE CENOWE</h2>
                <div class="description">
                    Poznaj zaawansowane formacje świecowe i wzorce cenowe, które uzupełniają 
                    podstawową bibliotekę PatternPro. Te rzadsze formacje mogą dawać 
                    silniejsze sygnały dla doświadczonych traderów.
                </div>
                <div class="description-features">
                    <div class="feature-item">
                        <i class="fas fa-star feature-icon"></i>
                        <span>Rzadsze wzorce cenowe</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-pie feature-icon"></i>
                        <span>Zaawansowana analiza</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-trophy feature-icon"></i>
                        <span>Wyższa skuteczność prognostyczna</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="back-link">
            <a href="index.php">&larr; Powrót do strony głównej</a>
        </div>

        <section class="controls">
            <div class="search-section">
                <input type="text" id="pattern-search" placeholder="Wyszukaj formację po nazwie">
                <div id="search-error" class="error-message"></div>
            </div>
            <div class="filter-section">
                <button id="bullish-btn" class="filter-btn">Bullish</button>
                <button id="bearish-btn" class="filter-btn">Bearish</button>
                <button id="all-btn" class="filter-btn active">Wszystkie</button>
            </div>
        </section>

        <section class="patterns-grid" id="patterns-container">
            <!-- Bullish Patterns -->
            <?php foreach ($bullishPatterns as $pattern): ?>
            <div class="pattern-card bullish">
                <div class="pattern-img">
                    <?php
                    // Zapewniamy, że używamy rozszerzenia .png
                    $image_path = str_replace(['.jpg', '.jpeg'], '.png', $pattern['image_path']);
                    ?>
                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($pattern['name']); ?>">
                </div>
                <h3 class="pattern-name"><?php echo htmlspecialchars($pattern['name']); ?></h3>
                <div class="pattern-description-preview">Kliknij, aby zobaczyć pełny opis formacji...</div>
                <div class="pattern-description-full">
                    <p><?php echo htmlspecialchars($pattern['description']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Bearish Patterns -->
            <?php foreach ($bearishPatterns as $pattern): ?>
            <div class="pattern-card bearish">
                <div class="pattern-img">
                    <?php
                    // Zapewniamy, że używamy rozszerzenia .png
                    $image_path = str_replace(['.jpg', '.jpeg'], '.png', $pattern['image_path']);
                    ?>
                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($pattern['name']); ?>">
                </div>
                <h3 class="pattern-name"><?php echo htmlspecialchars($pattern['name']); ?></h3>
                <div class="pattern-description-preview">Kliknij, aby zobaczyć pełny opis formacji...</div>
                <div class="pattern-description-full">
                    <p><?php echo htmlspecialchars($pattern['description']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
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

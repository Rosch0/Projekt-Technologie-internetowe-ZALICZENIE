<?php
// Parametry połączenia z bazą danych
$servername = "localhost";
$username = "root";  // Domyślny użytkownik - zmień jeśli używasz innego
$password = "";      // Domyślne puste hasło - zmień na właściwe

// Utworzenie połączenia
$conn = new mysqli($servername, $username, $password);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Utworzenie bazy danych
$sql = "CREATE DATABASE IF NOT EXISTS patternpro";
if ($conn->query($sql) === TRUE) {
    echo "Baza danych utworzona pomyślnie lub już istnieje.<br>";
} else {
    echo "Błąd podczas tworzenia bazy danych: " . $conn->error . "<br>";
}

// Wybierz bazę danych
$conn->select_db("patternpro");

// Utworzenie tabeli dla formacji
$sql = "CREATE TABLE IF NOT EXISTS patterns (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type ENUM('bullish', 'bearish') NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'patterns' utworzona pomyślnie lub już istnieje.<br>";
} else {
    echo "Błąd podczas tworzenia tabeli 'patterns': " . $conn->error . "<br>";
}

// Utworzenie tabeli dla formularzy kontaktowych
$sql = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'contact_messages' utworzona pomyślnie lub już istnieje.<br>";
} else {
    echo "Błąd podczas tworzenia tabeli 'contact_messages': " . $conn->error . "<br>";
}

// Wypełnienie tabeli przykładowymi danymi (formacje bullish)
$bullishPatterns = [
    [
        'name' => 'Bullish Engulfing',
        'type' => 'bullish',
        'description' => 'Bullish Engulfing to silna formacja odwrócenia trendu spadkowego, składająca się z dwóch świec. Pierwsza świeca jest spadkowa, a druga – wzrostowa – całkowicie ją obejmuje. Sygnał ten wskazuje na przejęcie kontroli przez kupujących i często zapowiada początek nowego trendu wzrostowego.',
        'image_path' => 'images/bullish-engulfing.png'
    ],
    [
        'name' => 'Hammer',
        'type' => 'bullish',
        'description' => 'Hammer to pojedyncza świeca o małym korpusie i długim dolnym cieniu, pojawiająca się po spadkach. Oznacza odrzucenie niższych poziomów cenowych przez kupujących i często zwiastuje odwrócenie trendu na wzrostowy.',
        'image_path' => 'images/hammer.png'
    ],
    [
        'name' => 'Inverted Hammer',
        'type' => 'bullish',
        'description' => 'Inverted Hammer to świeca z małym korpusem i długim górnym cieniem, pojawiająca się po trendzie spadkowym. Sugeruje, że kupujący zaczynają przejmować kontrolę, a potencjalne odwrócenie trendu jest możliwe.',
        'image_path' => 'images/inverted-hammer.png'
    ],
    [
        'name' => 'Morning Doji Star',
        'type' => 'bullish',
        'description' => 'Morning Doji Star to trzyświecowa formacja odwrócenia trendu spadkowego. Składa się ze świecy spadkowej, doji oraz świecy wzrostowej. Obecność doji sygnalizuje niezdecydowanie rynku, a kolejna świeca wzrostowa potwierdza zmianę sentymentu na byczy.',
        'image_path' => 'images/morning-doji-star.png'
    ],
    [
        'name' => 'Morning Star',
        'type' => 'bullish',
        'description' => 'Morning Star to klasyczna formacja odwrócenia trendu spadkowego, złożona z trzech świec: spadkowej, niewielkiej świecy (doji lub młotka) oraz silnej świecy wzrostowej. Sygnał ten wskazuje na zmianę przewagi z niedźwiedzi na byki.',
        'image_path' => 'images/morning-star.png'
    ],
    [
        'name' => 'Piercing Line',
        'type' => 'bullish',
        'description' => 'Piercing Line to formacja świecowa składająca się z dwóch świec: pierwsza jest spadkowa, a druga wzrostowa otwiera się poniżej zamknięcia poprzedniej, lecz zamyka się powyżej połowy jej korpusu. Jest to sygnał potencjalnego odwrócenia trendu na wzrostowy.',
        'image_path' => 'images/piercing-line.png'
    ],
    [
        'name' => 'Bullish Harami',
        'type' => 'bullish',
        'description' => 'Bullish Harami to dwuświecowa formacja odwrócenia trendu spadkowego. Składa się z dużej świecy spadkowej, po której następuje mniejsza świeca wzrostowa, całkowicie zawierająca się w korpusie poprzedniej świecy. Nazwa "harami" pochodzi z japońskiego i oznacza "w ciąży", co wizualnie przypomina tę formację. Sygnalizuje osłabienie presji sprzedających i potencjalne odwrócenie trendu spadkowego.',
        'image_path' => 'images/bullish-harami.png'
    ],
    [
        'name' => 'Bullish Engulfing Cross',
        'type' => 'bullish',
        'description' => 'Bullish Engulfing Cross to silna odmiana klasycznej formacji Bullish Engulfing. Występuje, gdy druga świeca wzrostowa nie tylko obejmuje korpus poprzedniej świecy spadkowej, ale również zamyka się znacznie powyżej otwarcia poprzedniej świecy, tworząc wyraźny krzyż. Ta formacja wskazuje na silniejsze odwrócenie trendu niż standardowy Bullish Engulfing i często prowadzi do dynamicznego ruchu wzrostowego.',
        'image_path' => 'images/bullish-engulfing-cross.png'
    ],
    [
        'name' => 'Bullish Belt Hold',
        'type' => 'bullish',
        'description' => 'Bullish Belt Hold to pojedyncza świeca, która pojawia się po serii świec spadkowych. Charakteryzuje się długim białym (lub zielonym) korpusem, otwarciem na lub blisko najniższego poziomu świecy oraz brakiem lub bardzo krótkim dolnym cieniem. Formacja ta wskazuje, że kupujący przejęli kontrolę od samego początku sesji i utrzymali ją do końca, co może sygnalizować zmianę trendu ze spadkowego na wzrostowy.',
        'image_path' => 'images/bullish-belt-hold.png'
    ]
];

// Wypełnienie tabeli przykładowymi danymi (formacje bearish)
$bearishPatterns = [
    [
        'name' => 'Shooting Star',
        'type' => 'bearish',
        'description' => 'Shooting Star to jednoświecowa formacja odwrócenia trendu wzrostowego, która wygląda jak odwrócony młotek. Charakteryzuje się małym korpusem przy dolnej części świecy i długim górnym cieniem, co najmniej dwukrotnie dłuższym od korpusu. Pojawia się po trendzie wzrostowym i sygnalizuje, że pomimo osiągnięcia znacznie wyższych poziomów podczas sesji, sprzedający zdołali odepchnąć cenę w dół, wskazując na potencjalne odwrócenie trendu.',
        'image_path' => 'images/shooting-star.png'
    ],
    [
        'name' => 'Evening Star',
        'type' => 'bearish',
        'description' => 'Evening Star to trzyświecowa formacja odwrócenia trendu wzrostowego. Składa się z długiej świecy wzrostowej, małej świecy (często z małym korpusem) oraz długiej świecy spadkowej. Formacja ta sygnalizuje zmianę sentymentu z byczego na niedźwiedzi i często prowadzi do znaczącego ruchu spadkowego. Im większy kontrast między pierwszą wzrostową a trzecią spadkową świecą, tym silniejszy sygnał odwrócenia trendu.',
        'image_path' => 'images/evening-star.png'
    ],
    [
        'name' => 'Evening Doji Star',
        'type' => 'bearish',
        'description' => 'Evening Doji Star to odmiana formacji Evening Star, gdzie środkowa świeca jest dokładnie doji (otwarcie równe zamknięciu). Ta formacja jest uważana za silniejszy sygnał odwrócenia trendu niż standardowa Evening Star, ponieważ doji wyraźniej sygnalizuje niezdecydowanie rynku przed ostatecznym ruchem spadkowym. Po doji następuje silna świeca spadkowa, która potwierdza zmianę trendu ze wzrostowego na spadkowy.',
        'image_path' => 'images/evening-doji-star.png'
    ],
    [
        'name' => 'Bearish Harami',
        'type' => 'bearish',
        'description' => 'Bearish Harami to dwuświecowa formacja odwrócenia trendu wzrostowego. Składa się z dużej świecy wzrostowej, po której następuje mniejsza świeca spadkowa, całkowicie zawierająca się w korpusie poprzedniej świecy. Nazwa "harami" pochodzi z japońskiego i oznacza "w ciąży", co wizualnie przypomina tę formację. Sygnalizuje osłabienie presji kupujących i potencjalne odwrócenie trendu wzrostowego. Im mniejszy korpus drugiej świecy, tym silniejsze wskazanie niezdecydowania na rynku.',
        'image_path' => 'images/bearish-harami.png'
    ],
    [
        'name' => 'Bearish Harami Cross',
        'type' => 'bearish',
        'description' => 'Bearish Harami Cross to odmiana formacji Bearish Harami, gdzie druga świeca jest dokładnie doji (ma bardzo mały lub nieistniejący korpus). Jest to silniejszy sygnał odwrócenia trendu niż standardowy Bearish Harami, ponieważ doji wyraźniej wskazuje na niezdecydowanie i potencjalną zmianę kierunku. Po długim okresie wzrostów, pojawienie się doji zawierającego się w korpusie poprzedniej świecy sygnalizuje wyczerpanie się trendu wzrostowego i możliwe odwrócenie.',
        'image_path' => 'images/bearish-harami-cross.png'
    ],
    [
        'name' => 'Bearish Belt Hold',
        'type' => 'bearish',
        'description' => 'Bearish Belt Hold to jednoświecowa formacja, która pojawia się po trendzie wzrostowym. Charakteryzuje się długim czarnym (lub czerwonym) korpusem, otwarciem na lub blisko najwyższego poziomu świecy oraz brakiem lub bardzo krótkim górnym cieniem. Formacja ta wskazuje, że sprzedający przejęli kontrolę od samego początku sesji i utrzymali ją do końca, co może sygnalizować zmianę trendu ze wzrostowego na spadkowy. Im dłuższy korpus świecy, tym silniejsza presja sprzedających.',
        'image_path' => 'images/bearish-belt-hold.png'
    ],
    [
        'name' => 'Hanging Man',
        'type' => 'bearish',
        'description' => 'Hanging Man to formacja jednoświecowa, która pojawia się po trendzie wzrostowym. Charakteryzuje się małym korpusem w górnej części świecy i długim dolnym cieniem, przynajmniej dwukrotnie dłuższym od korpusu. Wygląda jak odwrócony młotek i sygnalizuje potencjalne wyczerpanie trendu wzrostowego. Świadczy o tym, że w trakcie sesji cena znacząco spadła, choć zdołała się częściowo odbić - jest to sygnał ostrzegawczy dla posiadaczy długich pozycji.',
        'image_path' => 'images/hanging-man.png'
    ],
    [
        'name' => 'Dark Cloud Cover',
        'type' => 'bearish',
        'description' => 'Dark Cloud Cover to formacja odwrócenia trendu składająca się z dwóch świec. Pojawia się po trendzie wzrostowym i składa się z długiej świecy wzrostowej, po której następuje świeca spadkowa otwierająca się powyżej zamknięcia poprzedniej świecy, ale zamykająca się poniżej połowy jej korpusu. Formacja ta sygnalizuje osłabienie presji kupujących i przejęcie kontroli przez sprzedających. Im głębsze wejście w korpus pierwszej świecy, tym silniejszy sygnał spadkowy. Pełne potwierdzenie formacji następuje, gdy kolejna świeca kontynuuje ruch spadkowy.',
        'image_path' => 'images/dark-cloud-cover.png'
    ],
    [
        'name' => 'Bearish Engulfing',
        'type' => 'bearish',
        'description' => 'Bearish Engulfing to dwuświecowa formacja odwrócenia trendu, która występuje po trendzie wzrostowym. Składa się z mniejszej świecy wzrostowej, po której następuje większa świeca spadkowa, której korpus całkowicie pochłania (engulfing) korpus poprzedniej świecy. Ta formacja wskazuje na przejęcie kontroli przez sprzedających i często prowadzi do znaczącego ruchu spadkowego. Siła sygnału jest większa, gdy druga świeca ma bardzo długi korpus lub gdy formacja pojawia się przy lokalnych szczytach.',
        'image_path' => 'images/bearish-engulfing.png'
    ]
];

// Wstawianie danych do tabeli patterns
$allPatterns = array_merge($bullishPatterns, $bearishPatterns);
$count = 0;

foreach ($allPatterns as $pattern) {
    // Sprawdź, czy formacja już istnieje
    $checkSql = "SELECT id FROM patterns WHERE name = '" . $conn->real_escape_string($pattern['name']) . "'";
    $result = $conn->query($checkSql);
    
    if ($result->num_rows == 0) {
        $sql = "INSERT INTO patterns (name, type, description, image_path) VALUES (
            '" . $conn->real_escape_string($pattern['name']) . "',
            '" . $conn->real_escape_string($pattern['type']) . "',
            '" . $conn->real_escape_string($pattern['description']) . "',
            '" . $conn->real_escape_string($pattern['image_path']) . "'
        )";
        
        if ($conn->query($sql) === TRUE) {
            $count++;
        } else {
            echo "Błąd podczas wstawiania formacji '" . $pattern['name'] . "': " . $conn->error . "<br>";
        }
    }
}

echo "Dodano $count nowych formacji do bazy danych.<br>";
echo "Konfiguracja bazy danych zakończona pomyślnie!";

$conn->close();
?>

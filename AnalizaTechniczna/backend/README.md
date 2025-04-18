# PatternPro Backend

## Opis
Aplikacja backendowa dla PatternPro, serwująca dane o formacjach cenowych oraz przyjmująca wiadomości kontaktowe.

## Technology stack
- Node.js + Express
- MongoDB + Mongoose

## Instalacja
1. Sklonuj repozytorium
2. `npm install`
3. Skonfiguruj plik `.env` na podstawie `.env.example`
4. Uruchom: `npm start`

## Endpointy
- **GET** `/api/patterns?type=&search=` — lista formacji
- **GET** `/api/patterns/:id` — szczegóły formacji
- **POST** `/api/contact` — wysłanie wiadomości kontaktowej

## Testy
`npm test`

## Zmienne środowiskowe
- `MONGODB_URI` — URI do bazy MongoDB
- `PORT` — port serwera (domyślnie 5000)
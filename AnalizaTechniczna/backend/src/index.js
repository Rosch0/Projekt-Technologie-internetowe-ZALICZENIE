// src/index.js
require('dotenv').config();
const express = require('express');
const path = require('path');
const connectDB = require('./config/db');
const patternsRoute = require('./routes/patterns');
const contactRoute  = require('./routes/contact');

const app = express();
app.use(express.json());

// 1) API
app.use('/api/patterns', patternsRoute);
app.use('/api/contact',  contactRoute);

// 2) Statyczny frontend
//    __dirname to backend/src, więc idziemy dwa poziomy w górę do root,
//    potem do folderu frontend.
const frontendDir = path.join(__dirname, '..', '..', 'frontend');
app.use(express.static(frontendDir));

app.get(/.*/, (req, res) => {
    res.sendFile(path.join(frontendDir, 'index.html'));
  });

connectDB()
  .then(() => console.log('Połączono z MongoDB'))
  .catch(err => { console.error(err); process.exit(1); });

const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Serwer na porcie ${PORT}`));

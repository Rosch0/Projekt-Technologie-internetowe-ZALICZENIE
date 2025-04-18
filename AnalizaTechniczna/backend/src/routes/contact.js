// src/routes/contact.js
const express = require('express');
const router = express.Router();
const Contact = require('../models/Contact');

router.post('/', async (req, res) => {
  const { name, email, subject, message } = req.body;
  if (!name || !email || !subject || !message) {
    return res.status(400).json({ error: 'Brak wymaganych pól' });
  }
  try {
    const entry = await Contact.create({ name, email, subject, message });
    res.status(201).json({ id: entry._id });
  } catch (err) {
    res.status(500).json({ error: 'Błąd serwera' });
  }
});

module.exports = router;

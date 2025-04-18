// src/routes/patterns.js
const express = require('express');
const router = express.Router();
const Pattern = require('../models/Pattern');

// GET /api/patterns?type=&search=
router.get('/', async (req, res) => {
  const { type, search } = req.query;
  const filter = {};
  if (type && ['bullish','bearish'].includes(type)) filter.type = type;
  if (search) filter.name = { $regex: search, $options: 'i' };
  try {
    const patterns = await Pattern.find(filter);
    res.status(200).json(patterns);
  } catch (err) {
    res.status(500).json({ error: 'Błąd serwera' });
  }
});

// GET /api/patterns/:id
router.get('/:id', async (req, res) => {
  try {
    const pattern = await Pattern.findById(req.params.id);
    if (!pattern) return res.status(404).json({ error: 'Nie znaleziono formacji' });
    res.status(200).json(pattern);
  } catch (err) {
    res.status(400).json({ error: 'Nieprawidłowe ID' });
  }
});

module.exports = router;

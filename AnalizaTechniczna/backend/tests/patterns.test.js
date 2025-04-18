const request = require('supertest');
const app = require('../src/index'); // lub export express app
const mongoose = require('mongoose');

describe('GET /api/patterns', () => {
  beforeAll(async () => {
    // połączenie do testowej DB
  });
  afterAll(async () => await mongoose.disconnect());

  test('zwraca status 200 i tablicę', async () => {
    const res = await request(app).get('/api/patterns');
    expect(res.statusCode).toBe(200);
    expect(Array.isArray(res.body)).toBe(true);
  });

  test('filtruje po typie', async () => {
    const res = await request(app).get('/api/patterns?type=bearish');
    expect(res.statusCode).toBe(200);
    res.body.forEach(p => expect(p.type).toBe('bearish'));
  });
});
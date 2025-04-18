const request = require('supertest');
const app = require('../src/index');

describe('POST /api/contact', () => {
  test('zwrot 201 przy poprawnych danych', async () => {
    const res = await request(app)
      .post('/api/contact')
      .send({ name: 'Test', email: 't@t.pl', subject: 'S', message: 'M' });
    expect(res.statusCode).toBe(201);
    expect(res.body).toHaveProperty('id');
  });

  test('zwrot 400 gdy brakuje pól', async () => {
    const res = await request(app)
      .post('/api/contact')
      .send({ name: 'T' });
    expect(res.statusCode).toBe(400);
  });
});
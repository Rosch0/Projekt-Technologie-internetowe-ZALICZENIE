const mongoose = require('mongoose');

module.exports = async function connectDB() {
  const uri = process.env.MONGODB_URI;
  if (!uri) throw new Error('Brak URI do bazy danych w MONGODB_URI');
  await mongoose.connect(uri);
  console.log('Połączono z MongoDB');
};

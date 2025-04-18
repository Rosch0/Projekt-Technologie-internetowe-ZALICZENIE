const mongoose = require('mongoose');
const PatternSchema = new mongoose.Schema({
  name: { type: String, required: true, unique: true },
  type: { type: String, enum: ['bullish','bearish'], required: true },
  imageUrl: String,
  descriptionPreview: String,
  descriptionFull: String,
}, { timestamps: true });
module.exports = mongoose.model('Pattern', PatternSchema);

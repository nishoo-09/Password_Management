var mongoose = require('mongoose');
try{
	mongoose.connect('mongodb://localhost:27017/example', { useNewUrlParser: true }, { useUnifiedTopology: true } );
}
catch(err){
	throw err;
}
let schema = new mongoose.Schema({
	uname:{type:String, required:true,index:{unique:true}},
	email:{type:String, required:true,index:{unique:true}},
	password:{type:String, required:true},
});
const userModel = mongoose.model('user', schema);

module.exports = userModel;
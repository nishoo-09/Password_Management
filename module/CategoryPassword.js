var mongoose = require('mongoose');
var mongoosePaginate = require('mongoose-paginate');
try{
	mongoose.connect('mongodb://localhost:27017/example', { useNewUrlParser: true }, { useUnifiedTopology: true } );
}
catch(err){
	throw err;
}
let catSchema = new mongoose.Schema({
	password:{
		type:String, 
		required:true,
	},
});
catSchema.plugin(mongoosePaginate);
const passCateModel = mongoose.model('categoryPassword', catSchema);

module.exports = passCateModel;
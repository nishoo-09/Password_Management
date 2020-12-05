const express = require('express');
const app = express();
const router = express.Router();
const UserModel = require('../module/user');
const CategoryPassword = require('../module/CategoryPassword');
const bcryptjs = require('bcryptjs');
const jwt = require('jsonwebtoken');
const bodyParser = require('body-parser');
const {check, validationResult} = require('express-validator');
if (typeof localStorage === "undefined" || localStorage === null) {
  var LocalStorage = require('node-localstorage').LocalStorage;
  localStorage = new LocalStorage('./scratch');
}
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express Login' , msg:''});
});
router.post('/', function(req, res, next) {
  let uname = req.body.uname;
  let psw = req.body.psw;
  let user_name = UserModel.findOne({uname:uname});
  user_name.exec((err, data)=>{
    if(data){
      let existPass = data.password;
      let userId = data._id;
      let password = bcryptjs.compareSync(psw,existPass);
      if(password){
        const userToken = jwt.sign({'userId':userId}, 'loginToken');
        localStorage.setItem('userToken', userToken);
        localStorage.setItem('username', uname);
        res.redirect('/dashboard');
      }
      else {
        res.render('index', { title: 'Express Login', msg:'Invalid Username or Password'});
      }
    }
    else {
      res.render('index', { title: 'Express Login', msg:'Invalid Username or Password'});
    }
    if(err){
      res.render('index', { title: 'Express Login', msg:''});
    }
  });
});
router.get('/dashboard', checkLoginUser, function(req, res, next) {
  let uname = localStorage.getItem('username');
  res.render('dashboard', { title: 'Express Signup' ,msg: '', loginUser:uname});
});
router.get('/logout', function(req, res, next) {
  localStorage.removeItem('userToken');
  localStorage.removeItem('username');
  res.redirect('/');
});
router.get('/signup', function(req, res, next) {
  res.render('signup', { title: 'Express Signup' ,msg: ''});
});
router.post('/signup', checkUserName, checkEmail, function(req, res, next) {
    let uname = req.body.uname;
    let email = req.body.email;
    let psw = req.body.psw;
    let confirmpsw = req.body.confirmpsw;
    let message = '';
    if(psw != confirmpsw){
        res.render('signup', { title: 'Express Signup' , msg:"Password doesn't matched"});
    }
    else {
        psw = bcryptjs.hashSync(psw);
    }
    let userDetail = new UserModel({
        uname:uname, 
        email:email, 
        password:psw
    });
    userDetail.save((err, data)=>{
        if(err) {
            res.render('signup', { title: 'Express Signup' , msg:'Something went wrong'});
        }

        res.render('signup', { title: 'Express Signup' , msg:'User Registered Successfully'});
    });
});

  router.get('/password-category/:page?',checkLoginUser, function(req, res, next) {
    let uname = localStorage.getItem('username');
    let option =  { offset: parseInt(req.params.page) || 1, limit: 3 };
    CategoryPassword.paginate({}, option).then(function(result) {
      let pages = Math.ceil(result.total/result.limit);
      res.render('password-category', { 
        title: 'Password Category Name' ,
        loginUser:uname, 
        current:result.offset, 
        pages:Math.ceil(result.total/result.limit), 
        categoryData:result.docs,
        });
    });
  } 
 );
router.get('/add-new-category',checkLoginUser, function(req, res, next) {
  let uname = localStorage.getItem('username');
  res.render('add-new-category', { title: 'Add New Category Name', loginUser:uname,error:'',success:''});
});
router.get('/password-category/delete/:id',checkLoginUser, function(req, res, next) {
  let id = req.params.id;
  const removeDetail = CategoryPassword.findByIdAndRemove({_id:id});
  removeDetail.exec(function(err, data){
    res.redirect('/password-category');
  }); 
});
router.get('/password-category/edit/:id',checkLoginUser, function(req, res, next) {
  let uname = localStorage.getItem('username');
  let id = req.params.id;
  const data = CategoryPassword.findById(id, function(err, result){
    if(result)
      res.render('password-category-edit', { title: 'Update Category Name',loginUser:uname,cateName:result.password, error:'',success:'',id:id});
  });
});
router.post('/password-category/edit/:id',checkLoginUser, function(req, res, next) {
  let uname = localStorage.getItem('username');
  let editCategory = req.body.editPasswordCategory;
  let id = req.params.id;
  console.log(editCategory);
  const updateDetail = CategoryPassword.update({_id:id},{password:editCategory}, {upsert: true});
  updateDetail.exec(function(err, data){
    console.log(data);
    if(data){
      res.render('password-category-edit', { title: 'Update Category Name', loginUser:uname,cateName:'',error:'', success:'Password Successfully Updated', id:id});
    }
  });
  
});
router.post('/add-new-category',checkLoginUser, [ check('passwordCategory', 'Enter Password Category Name').isLength({'min':1}) ], function(req, res, next) {

  let uname = localStorage.getItem('username');
  let error = validationResult(req);
  if(!error.isEmpty()) {
    let passErr = error.mapped().passwordCategory.msg;
    res.render('add-new-category', { title: 'Add New Category Name' , error:passErr, success:'', loginUser:uname});
  }
  else {
    let pass = req.body.passwordCategory;
    let passDetail = new CategoryPassword({password:pass});
    passDetail.save(function(err, data){
      if(err)
        res.render('add-new-category', { title: 'Add New Category Name' , error:'Something went wrong', success:'', loginUser:uname});
      res.render('add-new-category', { title: 'Add New Category Name' , error:'', success:'Password Successfully Added', loginUser:uname});
    });
  }
});
router.get('/add-new-password',checkLoginUser, function(req, res, next) {
  let uname = localStorage.getItem('username');
  res.render('add-new-password', { title: 'Add New Category Name', loginUser:uname});
});
function checkUserName(req, res, next){
    let uname = req.body.uname;
    let isExist = UserModel.findOne({'uname':uname});
    isExist.exec((err, data)=>{
        if(err) {
            console.log(err);
            res.render('signup', { title: 'Express Signup' , msg: 'Something went wrong'});
        }
        if(data)
            res.render('signup', { title: 'Express Signup' , msg: 'User Name already exist'});
    });
    next();
}
function checkEmail(req, res, next){
    let email = req.body.email;
    let isExist = UserModel.findOne({'email':email});
    isExist.exec((err, data)=>{
        if(err) {
            console.log(err);
            res.render('signup', { title: 'Express Signup' , msg: 'Something went wrong'});
        }
        if(data)
            res.render('signup', { title: 'Express Signup' , msg: 'Email already exist'});
    });
    next(); 
}
function checkLoginUser(req, res, next) {
  let userToken = localStorage.getItem('userToken');
  try {
    jwt.verify(userToken, 'loginToken');
  }
  catch(err){
    res.redirect('/');
  }
  next();
}


module.exports = router;
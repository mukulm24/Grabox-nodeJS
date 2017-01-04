
var express = require('express');
var bodyParser = require('body-parser');

var app = express();
var path = require('path');
var fs = require("fs");

app.use(bodyParser.urlencoded({extended: false}));

var multer = require('multer');

var upload = multer({ dest: '/tmp' })




var mysql     =    require('mysql');

var pool      =    mysql.createPool({
    connectionLimit : 100, //important
    host     : 'localhost',
    user     : 'root',
    password : '',
    database : 'nodetest',
    debug    :  true
});


app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');
app.use(express.static(path.join(__dirname, 'public')));

app.get('/', function (req, res) {
    res.render("login/login", {});
});

app.get('/index', function (req, res) {
    res.render("item/add_item", {});
});









/* Following method created to check user authentication */
function authenticate(name, pass, fn) {

  //if (!module.parent) console.log('authenticating %s:%s', name, pass);

  

    pool.query('SELECT * FROM login',function(err,user){
      if (user) {

       // console.log(user);
      

        console.log(user[0].password);

        console.log("send ");
        console.log(pass);

        /* User entered password is encripted and it is checked with database password with database salt value. */

            if (user[0].password == pass) {
          console.log("Password OK");
          return fn(null, user);
        } else {
          console.log("Password NOT OK");
          return fn(new Error('Cannot find user'));
        }

      } else {
        return fn(new Error('Cannot find user'));
      }
    });

}

app.post("/login", function(req, res) {

//console.log("here");
//console.log(req.body.password);
 authenticate(req.body.username, req.body.password, function(err, user) {
   if (user) {

    console.log("successss");

    res.redirect("/product");
      // req.session.regenerate(function() {
      //   req.session.user = user;
      //   req.session.success = 'Authenticated as ' + user.username +
      //     ' click to <a href="/logout">logout</a>. ' +
      //     ' You may now access <a href="/restricted">/restricted</a>.';
      //  // res.redirect("/fito/userlogin/index");

      // });
   } else {

    console.log("error");
      // req.session.error = 'Invalid username or password.';
       //res.render('/login', { error: req.session.error });
       res.render('/');
      // res.redirect('/fito/login');
   }
 });
});



//Admin panel code

app.post('/registration',upload.single('profilePicture'),function (req,res){
  
    var post  = {
      'userName' : req.body.userName,
      'password' : req.body.password,
      'firstName' : req.body.firstName,
      'lastName'  : req.body.lastName,
      'userRole'  : req.body.userRole,
      'homeAddress'  : req.body.homeAddress,
      'shopAddress'  : req.body.shopAddress,
      'cityCode'  : req.body.cityCode,
      'stateCode'  : req.body.stateCode,
      'emailId'  : req.body.emailId,
      'phoneNumber'  : req.body.phoneNumber,
      'profilePicture'  : req.body.profilePicture,
      'isFirstLogin'  : req.body.isFirstLogin
    };

    pool.query('INSERT INTO user set ?', post, function (err, result) {
       if(err) throw err;

    console.log('Last insert ID:', res.insertId);

      console.log(result);

      res.redirect("/product");

  
  });
});


app.post('/product',upload.single('productImage'),function (req,res){
  //debugger;
  console.log("image data");


   var file = __dirname + '/public/product_images/' + req.file.filename;

  console.log(file);
  fs.rename(req.file.path, file, function(err) {
    if (err) {
      console.log(err);
      res.send(500);
    } else {
      
    
    var post  = {
      'productName' : req.body.productName,
      'productType'  : req.body.productType,
      'productImage'  : req.file.filename,
      'productPrice'  : req.body.productPrice,
      'description'  : req.body.description
    };

    pool.query('INSERT INTO product set ?', post, function (err, result) {
       if(err) throw err;

    console.log('Last insert ID:', res.insertId);

      console.log(result);

      res.redirect("/product");

      
    });

    }
  });
});

app.get('/product',function (req,res){

  console.log("get data");

  pool.query('SELECT * FROM product',function(err,products){
      if (products) {
        res.render("item/add_item", {
          products: products
        });
      }

  });

});

app.get("/restLogin", function(req, res) {
    console.log("aaaa");
});

app.post("/restLogin", function(req, res) {

console.log("restLogin");
//console.log(req.body.password);
    authenticate(req.body.username, req.body.password, function(err, user) {
        if (user) {

            console.log("successss");

            return user;
        } else {
            console.log("error");
            return "false";

            console.log("error");
            // req.session.error = 'Invalid username or password.';
            //res.render('/login', { error: req.session.error });
            res.render('/');
            // res.redirect('/fito/login');
        }
    });
});

var server = app.listen(8081, function () {
   var host = server.address().address
   var port = server.address().port

   console.log("Example app listening at http://%s:%s", host, port)
})

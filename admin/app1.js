
var express = require('express');
var bodyParser = require('body-parser');

var app = express();
var path = require('path');
var fs = require("fs");

app.use(bodyParser.urlencoded({extended: false}));


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

app.get('/login', function (req, res) {
    res.render("login/login", {});
});

app.post('/registration',function (req,res){
  debugger;
	console.log(req.body.firstName);



  var post  = {
    'firstName' : req.body.firstName,
    'lastName'  : req.body.lastName
  };

  pool.query('INSERT INTO users set ?', post, function (err, result) {
     if(err) throw err;

  console.log('Last insert ID:', res.insertId);

    console.log(result);

    
    // ...
  });
});





/* Following method created to check user authentication */
function authenticate(name, pass, fn) {

  //if (!module.parent) console.log('authenticating %s:%s', name, pass);

  

    pool.query('SELECT * FROM login',function(err,user){
      if (user) {

        console.log(user);
      

        console.log(user[0].password);

        /* User entered password is encripted and it is checked with database password with database salt value. */

       // if (user.password == (crypto.pbkdf2Sync(pass, user.salt, 10000, 64).toString(
            //'base64')))

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

console.log("here");
console.log(req.body.password);
 authenticate(req.body.username, req.body.password, function(err, user) {
   if (user) {

    console.log("successss");
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
      // res.render('/fito/login', { error: req.session.error });
      // res.redirect('/fito/login');
   }
 });
});





/*

pool.query('SELECT * FROM users',function(err,rows){
  if(err) throw err;




  for (var i = 0; i < rows.length; i++) {
    console.log(rows[i].firstName);
    console.log(rows[i].lastName);
  };
});

*/

var server = app.listen(8081, function () {
   var host = server.address().address
   var port = server.address().port

   console.log("Example app listening at http://%s:%s", host, port)
})


//db


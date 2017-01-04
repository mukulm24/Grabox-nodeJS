
var express = require('express');
var bodyParser = require('body-parser');

var app = express();
var path = require('path');
var fs = require("fs");
var crypto = require("crypto");
var moment = require("moment");

//app.use(bodyParser.urlencoded())


app.use(bodyParser.urlencoded({extended: true}));

app.use(bodyParser.json())


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

app.get('/registration', function (req, res) {
    //res.render("registration/registration", {});

     //pool.query('SELECT * FROM login',function(err,users){
       pool.query('SELECT * FROM login where userRole = ?', 2, function(err,users){
      if (users) {
        res.render("registration/registration", {
          users: users
        });
      }

  });
});

app.get('/pendingNotifications', function (req, res) {


  console.log("sdsdsd");
    //res.render("registration/registration", {});

     //pool.query('SELECT * FROM login',function(err,users){
       pool.query('SELECT * FROM login where status = ?', 0, function(err,users){
      if (users) {
        res.render("notifications/notifications", {
          users: users
        });
      }

  });
});

app.post("/login", function(req, res) {

console.log("here");
console.log(req.body.emailId);


      var emailId = req.body.emailId;
      var password = req.body.password;
 pool.query('SELECT * FROM login where emailId = ?', emailId, function(err,user){
      if (user) {
        console.log(user);

        if(user.length){
           if (user[0].password == password) {

               console.log("successss");

                res.redirect("/pendingNotifications");
              }else{
                console.log("password not matched");
                 res.redirect('/');
              }
         }else{
           console.log("User not found.");
            res.redirect('/');
         }

        }else{
         console.log("User not found.");
          res.redirect('/');
        }
      });
});



//Admin panel code

app.post('/registration',upload.single('profilePicture'),function (req,res){

  var file = __dirname + '/public/user_images/' + req.file.filename;

  console.log(file);
  fs.rename(req.file.path, file, function(err) {
    if (err) {
      console.log(err);
      res.send(500);
    } else {

      var post  = {
      'password' : 'password',
      'firstName' : req.body.firstName,
      'lastName'  : req.body.lastName,
      'userRole'  : 2,
      'homeAddress'  : req.body.homeAddress,
      'shopAddress'  : req.body.shopAddress,
      'cityCode'  : req.body.cityCode,
      'stateCode'  : req.body.stateCode,
      'emailId'  : req.body.emailId,
      'phoneNumber'  : req.body.phoneNumber,
      'profilePicture'  : req.file.filename,
      'isFirstLogin'  : 0,
      'status':0
    };


    console.log(post);

    pool.query('INSERT INTO login set ?', post, function (err, result) {
       if(err) throw err;

    console.log('Last insert ID:', res.insertId);

      console.log(result);

      res.redirect("/registration");

  
  });

    }
  })
  
    
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
      'qualityType'  : req.body.qualityType,
      'unit'  : req.body.unit,
    };

    pool.query('INSERT INTO product set ?', post, function (err, result) {
       if(err) throw err;

    console.log('Last insert ID:', res.insertId);

      console.log(result);

      res.redirect("/productAdmin");

      
    });

    }
  });
});

app.get('/productAdmin',function (req,res){

   pool.query('SELECT * FROM product',function(err,products){
                if (products) {

                   res.render("item/add_item", {
                       products: products
                    });
                }
              });

  });

app.get('/product',function (req,res){

  console.log("get data");

 

    var token = req.query.token;

     console.log(token);
    //var token = '257c1bf60046b2186e2e15d8ce21d5d4f53607fe772ebe39087a77cfb19bdf45e11859da0682f8923ea393e1abcb5a8b7426e3d1e25089c7c362ac5419ebe06d';

   pool.query('SELECT * FROM login where token = ?', token, function(err,user){
      if (user) {

        if (user.length) {

          var userId  = {userId:user[0].id};
           pool.query('SELECT * FROM add_cart WHERE ?', [userId],function(err,cards){

            pool.query('SELECT * FROM product',function(err,products){
                if (products) {

                  var productArr=[];

                  products.map(function(elm){

                    var productId = {itemId:elm.id};
                    var cardQuantity=0;
                    cards.map(function(card){

                      if(elm.id==card.itemId){
                        cardQuantity=card.quantity;
                      }

                    });
                      
                    productArr.push({'productId':elm.id,'productName':elm.productName,'productType':elm.productType,'productImage':elm.productImage,
                                        'productPrice':elm.productPrice,'unit':elm.unit,'qualityType':elm.qualityType,cardQuantity:cardQuantity});
                    });

                  res.send(JSON.stringify({ 'products': productArr }));
                
                }
            });

        });

      }else{
        res.send(JSON.stringify({ 'Error': 'Session expired.' }));
      }
    }else{
      res.send(JSON.stringify({ 'Error': 'Session expired.' }));
    }
  });
});

//Mobile api


app.post("/restLogin", function(req, res) {
      var emailId = req.body.emailId;
      var password = req.body.password;


      console.log("Login");
      console.log(emailId);
      console.log(password);
 pool.query('SELECT * FROM login where emailId = ?', emailId, function(err,user){
      if (user) {

        if(user.length){
           if (user[0].password == password) {

              var token = crypto.randomBytes(64).toString('hex');
               var post  = {token: token};
              var condition = {emailId:emailId};
              var query = pool.query('UPDATE login SET ? WHERE ?', [post, condition] , function(err, result) {

                   pool.query('SELECT * FROM login where emailId = ?', emailId, function(err,userDetails){
                    if (userDetails) {
                     res.send(JSON.stringify({ 'userDetails':userDetails }));
                   }
                 });
              });

              }else{
                res.send(JSON.stringify({ 'Error': 'Invalid Credentials.' }));
              }
         }else{
          res.send(JSON.stringify({ 'Error': 'User not found.' }));
         }

        }else{
          res.send(JSON.stringify({ 'Error': 'User not found.' }));
        }
      });
});

app.post('/restRegistration',function (req,res){
    var userRole =  req.body.userRole;
      var post  = {
      'password' : req.body.password,
      'firstName' : req.body.firstName,
      'lastName'  : req.body.lastName,
      'userRole'  : req.body.userRole,
      'homeAddress'  : 'Default',
      'shopAddress'  : req.body.shopAddress,
      'cityCode'  : 'Pune',
      'stateCode'  : 'MH',
      'emailId'  : req.body.emailId,
      'phoneNumber'  : req.body.phoneNumber,
      'profilePicture'  : 'aaa',
      'isFirstLogin'  : 0,
      'status':0
    };

    pool.query('INSERT INTO login set ?', post, function (err, result) {
      //if(err) throw err;
       if(err){
            res.send(JSON.stringify({ 'Error': 'Registration failed.' }));
       }

      if(userRole==3){
         res.send(JSON.stringify({ 'Success': 'Thank You for registering with Grabox. We will mail you after the authentication process is complete.'}));
      }else{
       res.send(JSON.stringify({'userDetails':post}));

      }
  });
  
    
});


app.get('/userRequestUpdate',function (req,res){

  var status=req.query.status;
  var id=req.query.id;

    var post  = {status: status};
    var condition = {id:id};
    var query = pool.query('UPDATE login SET ? WHERE ?', [post, condition] , function(err, result) {

       res.redirect("/pendingNotifications");
         //res.send(JSON.stringify({ 'Success': 'Login successfully.' }));

    });
});


//Add cart

app.post('/addCart',function (req,res){

    var token = req.body.token;

   pool.query('SELECT * FROM login where token = ?', token, function(err,user){
      if (user) {
        if (user.length) {

          var userId  = user[0].id;
          var itemId  = req.body.itemId;


            // pool.query('SELECT * FROM add_cart WHERE ?', [userId1,itemId],function(err,cardDetails){

               pool.query('SELECT * FROM add_cart WHERE userId="'+userId+'" and itemId="'+itemId+'"',function(err,cardDetails){
                 if (cardDetails) {
                    if (cardDetails.length) {
                       //var post  = {quantity: req.body.quantity};
                         var quantity =  req.body.quantity;
                         var total =  req.body.total;

                         var userId  = user[0].id;

                        // res.send(JSON.stringify({'Success':userId}));
                          var query = pool.query('UPDATE add_cart SET quantity ="'+quantity+'", total ="'+total+'" WHERE userId="'+userId+'" and itemId="'+itemId+'"' , function(err, result) {
                            if(err){
                              res.send(JSON.stringify({'Error':"Cart update failed."}));
                            }

                               res.send(JSON.stringify({'Success':"Cart updated successfully."}));

                          });
                    }else{
                      //insert
                       var userId  = user[0].id;

                      var post  = {
                         'userId' : userId,
                         'itemId' : req.body.itemId,
                         'quantity' : req.body.quantity,
                         'price' : req.body.price,
                         'total'  : req.body.total
                      };

                    pool.query('INSERT INTO add_cart set ?', post, function (err, result) {
                      if(err) throw err;

                      //console.log('Last insert ID:', res.insertId);

                       res.send(JSON.stringify({'Success':"Product addedd to cart successfully."}));

                       });
                    }
                  }else{

                     //insert
                      var userId  = user[0].id;
                      var post  = {
                         'userId' : userId,
                         'itemId' : req.body.itemId,
                         'quantity' : req.body.quantity,
                         'price' : req.body.price,
                         'total'  : req.body.total
                      };

                    pool.query('INSERT INTO add_cart set ?', post, function (err, result) {
                      if(err) throw err;

                      //console.log('Last insert ID:', res.insertId);

                       res.send(JSON.stringify({'Success':"Product addedd to cart successfully."}));

                       });

                  }
                });
        }
        else{
           res.send(JSON.stringify({ 'Error': 'Session expired.' }));
        }
      }
      else{
         res.send(JSON.stringify({ 'Error': 'Session expired.' }));
      }

    });
          
});

app.get('/cartList',function (req,res){

  var token = req.query.token;

   pool.query('SELECT * FROM login where token = ?', token, function(err,user){
      if (user) {

        if (user.length) {

          var userId  = user[0].id;

          //res.send(JSON.stringify({'products':userId}));
              

             pool.query('SELECT * FROM add_cart where userId = ?', userId,function(err,cardDetails){
              if (cardDetails) {

                var cardDetailsLength= cardDetails.length;

                var cardDetailsArr=[];

                // res.send(JSON.stringify({'products':cardDetails}));

                var i=1;

                cardDetails.map(function(elm){
                  var itemId = elm.itemId;

                   pool.query('SELECT * FROM product where id = ?',itemId,function(err,products){

                    if (products) {
                      cardDetailsArr.push({'cartId':elm.id,'productId':products[0].id,'productName':products[0].productName,'productType':products[0].productType,'productImage':products[0].productImage,
                                        'productPrice':products[0].productPrice,'unit':products[0].unit,'qualityType':products[0].qualityType,
                                        cardQuantity:elm.quantity});
                        }

                        if(cardDetailsLength==i){

                           res.send(JSON.stringify({'products':cardDetailsArr}));

                        }
                        i++;
                  });


                })
             }
             });
        }
        else{
          res.send(JSON.stringify({ 'Error': 'Session expired.' }));

        }
      }else{
        res.send(JSON.stringify({ 'Error': 'Session expired.' }));

      }
    });

   console.log("get data");

  
});



app.post('/cartItemDelete',function (req,res){

  var token = req.body.token;

   pool.query('SELECT * FROM login where token = ?', token, function(err,user){
      if (user) {
        if (user.length) {
          var userId  = user[0].id;
          var id=req.body.cartId;
            pool.query("DELETE FROM add_cart WHERE id = ? ", [id], function(err, results) {
                 res.send(JSON.stringify({'Success':"Product removed from cart."}));
            });
        }
        else{
           res.send(JSON.stringify({ 'Error': 'Session expired.' }));
        }
      }else{
         res.send(JSON.stringify({ 'Error': 'Session expired.' }));
      }
    });
 });




app.post('/order',function (req,res){

  var token = req.body.token;

   pool.query('SELECT * FROM login where token = ?', token, function(err,user){
      if (user) {
        if (user.length) {
          var userId  = user[0].id;

          var orderDate = moment();


          pool.query('SELECT * FROM add_cart where userId = ?', userId, function(err,cartDetails){

                      var cartDetailsLength=cartDetails.length;
                      var orderData  = {
                         'userId' : userId,
                         'orderDate' : orderDate,
                         'deliveryDate' : '',
                         'deliveryExecutive' : '',
                         'status'  : '1',
                         'deliveryAddress':req.body.deliveryAddress,
                         'deliveryPhoneNumber':req.body.deliveryPhoneNumber,
                         'total':req.body.total
                      };


                    pool.query('INSERT INTO orders set ?', orderData, function (err, result) {
                      if(err) throw err;

                      var orderId=result.insertId;

                      var i=1;
                      cartDetails.map(function(elm){

                        var orderDetailsData  = {
                            'orderId':orderId,
                            'userId' : userId,
                             'itemId' : elm.itemId,
                            'quantity' : elm.quantity,
                            'price' : elm.price,
                            'total'  : elm.total
                          };

                         pool.query('INSERT INTO orderDetails set ?', orderDetailsData, function (err, result) {
                          if(err) throw err;

                        });

                         i++;

                         if(cartDetailsLength==i){
                          res.send(JSON.stringify({'Success':"Order placed successfully."}));

                         }
                      })
                      //res.send(JSON.stringify({'Success':"Product addedd successfully."}));

                    });
                 });


          }
          else{
            res.send(JSON.stringify({ 'Error': 'Session expired.' }));

          }
        }else{
          res.send(JSON.stringify({ 'Error': 'Session expired.' }));

        }
      });
 });


app.get('/orderList',function (req,res){

  
        // var token ='46bb953e7013fb84505fd844eb02f8e28d2f320f35e5cfe0f264a9d1b733e0b909a733f5335e7521eaa068a9bc973c50c754b13ec0245531e1b842e3efe1ac2b';

        
          pool.query('SELECT * FROM orders order by id desc', function(err,orders){

            var ordersLength=orders.length;

            var i=1;

            var ordersArr=[];
            orders.map(function(elm){
              var userId=elm.userId;
              var deliveryExecutive =elm.deliveryExecutive;



              pool.query('SELECT * FROM login where id = ?', userId, function(err,user){


                pool.query('SELECT * FROM login where id = ?', deliveryExecutive, function(err,executiveDetails){

                //res.render("orders/orders", {orders:user[0]});


                //var orderDate = moment(new Date()).format("DD/MM/YYYY");

                //var orderDate = moment(elm.orderDate, "MM-DD-YYYY");
                var executiveName='';
                if(executiveDetails[0]){
                  executiveName= executiveDetails[0].firstName+' '+executiveDetails[0].lastName;
                }


              ordersArr.push({'orderId':elm.id,'firstName':user[0].firstName,'lastName':user[0].lastName,'orderDate':elm.orderDate,
                            'deliveryDate':elm.deliveryDate,'deliveryphoneNumber':elm.deliveryphoneNumber,'deliveryAddress':elm.deliveryAddress,
                            'deliveryExecutive':executiveName,'status':elm.status,'total':elm.total});

                     
                   if(ordersLength==i){

                console.log(ordersArr);
                       res.render("orders/orders", {orders:ordersArr});

                    }

                     i++;
                    
                });


                });
           
              });
          });

             
 });




app.get('/orderDetails',function (req,res){

  var orderId=req.query.orderId;

  pool.query('SELECT * FROM orderdetails where orderId = ?', orderId, function(err,orderDetails){

    //res.send(orderDetails);

       var ordersLength=orderDetails.length;


            var i=1;

            var ordersArr=[];
            orderDetails.map(function(elm){
              var itemId=elm.itemId;



              pool.query('SELECT * FROM product where id = ?', itemId, function(err,items){

                //res.render("orders/orders", {orders:user[0]});

              ordersArr.push({'orderDetailsId':elm.id,'itemName':items[0].productName,'quantity':elm.quantity,'price':elm.price,
                            'total':elm.total});

                     
                   if(ordersLength==i){

                    res.send(ordersArr);

                console.log(ordersArr);
                       //res.render("orders/orders", {orders:ordersArr});

                    }

                     i++;
                    
                });



           
              });


  });
});

app.get('/assignDeliverExecutives',function (req,res){

  var orderId=req.query.orderId;
   pool.query('SELECT * FROM login where userRole = ?', 2, function(err,executiveDetails){

  //pool.query('SELECT * FROM login where userRole = ?', 3, function(err,executiveDetails){

    //res.send(orderDetails);

       //var executiveLength=executiveDetails.length;


           res.send(executiveDetails);

  });
});

app.post("/trackOrder", function(req, res) {
      var token = req.body.token;

      var status = req.body.status;
      var orderId = req.body.orderId;

    pool.query('SELECT * FROM login where token = ?', token, function(err,user){
      if (user) {
        if (user.length) {

              var post  = {status: status};
              var condition = {orderId:orderId};
          var query = pool.query('UPDATE orders SET ? WHERE ?', [post, condition] , function(err, result) {

     
          pool.query('SELECT * FROM orders where orderId = ?', orderId, function(err,orderDetails){
              if (orderDetails) {
               res.send(JSON.stringify({ 'orderDetails':orderDetails }));
             }else{
              res.send(JSON.stringify({ 'Error': 'No data found.' }));
             }
           });
       });
    }
    else{
           res.send(JSON.stringify({ 'Error': 'Session expired.' }));
        }
      }else{
         res.send(JSON.stringify({ 'Error': 'Session expired.' }));
      }
    });
});





app.get('/saveDeliverExecutives',function (req,res){

  var executiveId=req.query.executiveId;
  var assingOrderID=req.query.assingOrderID;

  console.log(executiveId);


    var post  = {deliveryExecutive: executiveId};
    var condition = {id:assingOrderID};
    var query = pool.query('UPDATE orders SET ? WHERE ?', [post, condition] , function(err, result) {

       res.redirect('/orderList');
         //res.send(JSON.stringify({ 'Success': 'Login successfully.' }));

    });
});




//Stock add

app.get('/add_stock',function (req,res){
  pool.query('SELECT * FROM product',function(err,products){
    if (products) {

        pool.query('SELECT * FROM stockManagement',function(err,stocks){
        var stockArr=[];

        var stocksLength=stocks.length;

          var i=1;
         if(stocks.length){

            stocks.map(function(elm){

            var productId=elm.productId;

              pool.query('SELECT * FROM product where id = ?', productId, function(err,items){

                  stockArr.push({'productId':elm.id,'productName':items[0].productName,'quantity':elm.quantity});
                  if(stocksLength==i){

                    res.render("stock/add_stock", {
                       products: products,
                       stockArr:stockArr
                    });
                  }
                   i++;

              });


            });

         }else{

          res.render("stock/add_stock", {
                       products:products,
                       stockArr:[]
                    });

         }
      });

    }
  });

});



//Admin panel code

app.post('/add_stock',function (req,res){

  console.log("HERE");
  console.log(req.body.productName1);
  console.log(req.body.quantity);

      var post  = {

      'productId' : req.body.productName1,
      'quantity'  : req.body.quantity
    };

    pool.query('INSERT INTO stockManagement set ?', post, function (err, result) {
       if(err) throw err;

    var productId = req.body.productName1;

    pool.query('SELECT * FROM product where id = ?', productId, function(err,availableStock){
            var quantity = req.body.quantity;

            console.log(availableStock[0].stock);
            console.log(quantity);
            var totQty = parseFloat(availableStock[0].stock) + parseFloat(quantity);
               var post  = {stock: totQty};

               console.log("aaaaaaaaaa");
               console.log(post);
               console.log(productId);
              var condition = {id:productId};
              var query = pool.query('UPDATE product SET ? WHERE ?', [post, condition] , function(err, result1) {

      

      res.redirect("/add_stock");
    });

    });
  });
    
});


app.get('/adminOrderDetails',function (req,res){

        
          pool.query('SELECT * FROM orders order by id desc', function(err,orders){

            var ordersLength=orders.length;

            var i=1;

            var ordersArr=[];
            orders.map(function(elm){
              var userId=elm.userId;
              var deliveryExecutive =elm.deliveryExecutive;



              pool.query('SELECT * FROM login where id = ?', userId, function(err,user){


                pool.query('SELECT * FROM login where id = ?', deliveryExecutive, function(err,executiveDetails){

                //res.render("orders/orders", {orders:user[0]});


                //var orderDate = moment(new Date()).format("DD/MM/YYYY");

                //var orderDate = moment(elm.orderDate, "MM-DD-YYYY");
                var executiveName='';
                if(executiveDetails[0]){
                  executiveName= executiveDetails[0].firstName+' '+executiveDetails[0].lastName;
                }


              ordersArr.push({'orderId':elm.id,'firstName':user[0].firstName,'lastName':user[0].lastName,'orderDate':elm.orderDate,
                            'deliveryDate':elm.deliveryDate,'deliveryphoneNumber':elm.deliveryphoneNumber,'deliveryAddress':elm.deliveryAddress,
                            'deliveryExecutive':executiveName,'status':elm.status,'total':elm.total});

                     
                   if(ordersLength==i){

                console.log(ordersArr);
                       res.render("orders/orders", {orders:ordersArr});

                    }

                     i++;
                    
                });


                });
           
              });
          });

             
 });










// orders.map(function(elm){

//               var orderId=elm.id;

//                pool.query('SELECT * FROM orderdetails where orderId = ?', orderId, function(err,orderDetails){

//                 orderArr.push({'id':orderDetails[0].id,'itemId':orderDetails[0].itemId,'quantity':orderDetails[0].quantity,
//                               'price':orderDetails[0].price});

//                });

//                i++;

          



var server = app.listen(9091, function () {
   var host = server.address().address
   var port = server.address().port

   console.log("Example app listening at http://%s:%s", host, port)
})

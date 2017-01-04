
<?php include("header.php");?>
<!-- /Fixed navbar -->	
<style type="text/css">
	.imgBtn {
    position: absolute;
    text-align: center;
    top: 40%;
    z-index: 1;
}
.imgBtnFirst {
    position: absolute;
    text-align: center;
    top: 50%;
    z-index: 1;
}


@media all and (max-width: 768px) {
    .imgBtnFirst {
    position: absolute;
    text-align: center;
    top: 40%;
    z-index: 1;
	}

    .imgBtn {
    position: absolute;
    text-align: center;
    top: 50%;
    z-index: 1;
	}
} 

@media all and (max-width: 640px) {
    .imgBtnFirst {
    position: absolute;
    text-align: center;
    top: 30%;
    z-index: 1;
	}

    .imgBtn {
    position: absolute;
    text-align: center;
    top: 50%;
    z-index: 1;
	}
} 

.starColor{
	color: red;
}

.container-fluid-update {
    margin-left: auto;
    margin-right: auto;
    padding-left: 0px;
    padding-right: 0px;
}

</style>


<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>


<!--
<div class="banner">
	<div id="content12" class="container-fluid-update">
		<img src="images/sh1.jpg" alt="We Bring" data-url="#1" style="height: 100%;width:100%;">
			
	</div>	
</div>
-->




<div class="w3ls"></div>
<div class="content-login">
	<section class="contact-form1">


        <div class="container" style="width:100%;">
            <div class="row">
                
		          <h2>Login Form</h2>

			<form action="action_page.php">
                <div class="col-lg-5 col-sm-6">
			  <!--<div class="imgcontainer">-->
			    <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
			 
            </div>

			  <div class="col-lg-5 col-sm-6">
			    <label><b>Username</b></label>
			    <input type="text" placeholder="Enter Username" name="uname" required>
              </div>
              <div class="col-lg-5 col-sm-6">
			    <label><b>Password</b></label>
			    <input type="password" placeholder="Enter Password" name="psw" required>
			 </div>
             <div class="col-lg-5 col-sm-6">
			    <button type="submit">Login</button>
			    <input type="checkbox" checked="checked"> Remember me
			  </div>

			  <div class="container" style="background-color:#f1f1f1">
			    <button type="button" class="cancelbtn">Cancel</button>
			    <span class="psw">Forgot <a href="#">password?</a></span>
			  </div>
			</form>
        </div>
    </div>

	</section>
</div>
<div class="w3ls"></div>

<!--
<div class="content-section-b">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-lg-offset-1 col-sm-push-6 col-sm-6">
				<div class="content2">
					<h3 class="section-heading slideanim">Something Special About The Vegetable Farm</h3>
					<hr class="section-heading-spacer slideanim">
					<div class="clearfix"></div>
					<p class="lead slideanim">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
				</div>
			</div>
            <div class="col-lg-5 col-sm-pull-6 col-sm-6 slideanim">
                <ul class="grid cs-style">
					<li>
						<figure>
							<img src="images/farm2.jpg" alt="" class="img-responsive">
							<figcaption>
								<h3>Something Special</h3>
								<p>About The Vegetable Farm</p>
								<a href="about.html">Read More</a>
							</figcaption>
						</figure>
					</li>
				</ul>
            </div>
        </div>
	</div>
</div>
-->


<div class="w3ls"></div>



<!-- /Portfolio Grid Section -->
<!-- Portfolio Modals -->





<!-- /Portfolio Modals -->
<!-- Blog -->

<!-- /Blog -->
<!-- Footer -->
<footer class="text-center">

	
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>© 2016 FarmToPlate. All Rights Reserved | Design by <a href="" target="_blank"></a></p>
                </div>
            </div>
        </div>
		<a href="#myPage" title="To Top">
			<span class="glyphicon glyphicon-chevron-up"></span>
		</a>
    </div>
</footer>


<!-- js files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/TweenMax.min.js"></script>
<script src="js/index.js"></script>
<script src="js/index2.js"></script>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

  // Store hash
  var hash = this.hash;

  // Using jQuery's animate() method to add smooth page scroll
  // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
  $('html, body').animate({
    scrollTop: $(hash).offset().top
  }, 900, function(){

    // Add hash (#) to URL when done scrolling (default click behavior)
    window.location.hash = hash;
    });
  });
})
</script>
<script>
$(window).scroll(function() {
  $(".slideanim").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slide");
    }
  });
});
</script>
<!-- /js files -->
</body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" href="Images/Bird1.png" type="image/gif" sizes="16x16">
    <!-- Include jquey -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include angularjs -->
    <script src="//code.angularjs.org/1.8.0/angular.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Spinnaker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Basic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
    <title>Contact | Lluc Semis</title>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
    <script src="shopping-cart.js" async></script>
    <script src="color-mode.js" async></script>
      
    <!-- Css files -->
    <link rel="stylesheet" href="style/main-style.css">
    <link rel="stylesheet" href="style/contact-style.css">     
  </head>

  <body ng-app="contact">
      
    <!-- Navbar -->
    <div class="navbar">
      <a href="home.php">
        <p class="title">LLUC SEMIS</p>
      </a>
      <hr width="20%" padding="none">
      <p class="subtitle">WILDLIFE PHOTOGRAPHY</p>
      <div class="more">
        <div class="cart">
          <button class="cart-button" id="cart">
            <a class="fa fa-shopping-cart" style="margin-right: 0.5em;"></a>
            CART
          </button>
        </div>
        <div class="mode">
          <button class="mode-button" id="to-dark">DARK MODE</button>
          <button class="mode-button" id="to-light">LIGHT MODE</button>
        </div>
      </div>
    </div>
    
    <!-- The Shopping cart -->
    <div id="shopping-cart" class="shopping-cart">
      <div class="shopping-content">
        <span class="close">&times;</span>
        <h2 style="font-family: 'Dosis', sans-serif;">YOUR SHOPPING CART</h2>
        <div class="cart-text" style="width:100px;">
          ITEM
          <hr style="margin-top:0.5em; width:90%; margin-left:0px;">
        </div>
        <div class="cart-text" style="width:80px; margin-left:100px;">
          PRICE
          <hr style="margin-top:0.5em; width:90%; margin-left:0px;">
        </div>
        <div class="cart-text" style="width:120px; margin-left:180px;">
          QUANTITY
          <hr style="margin-top:0.5em; width:90%; margin-left:0px;">
        </div>
        <div class="cart-items">
        </div>
        <div class="cart-text" style="width:300px; text-align: right;">
          <hr style="margin-top:0.5em; width:90%; margin-right:0px;">
          <br>
          <strong>TOTAL</strong>
          <span class="cart-total-price" style="margin-left: 10px;">0DKK</span>
        </div>
        <a href="store.php"><button class="purchase-button">PURCHASE</button></a>
      </div>
    </div>
      
    <div class="container" ng-controller="ContactForm">
      <div class="menu">
        <div class="menu-content">
          <a href="bio.php">BIO</a>
          <a href="portfolio.php">PORTFOLIO</a>
          <a href="projects.php">PROJECTS</a>
          <a href="store.php">STORE</a>
          <a href="contact.php">CONTACT</a>
          <p class="copyright">Lluc Semis Photography &copy</p>
          <a href="https://www.instagram.com/llsemisga96/" target="_blank" class="fa fa-instagram"></a>
        </div>
      </div>
      <div class="contact" id="contact">
        <form name="form" class="gform" novalidate method="POST" action="https://script.google.com/macros/s/AKfycbwwVQ6JaMa1KBXgXx2CC6yp-hqlCYVmb8D5NgOFtzFMUFL48yM/exec">
          <div class="form-group">
            <label for="name">YOUR FULL NAME *</label>
            <input id="name" type="text" name="name" ng-model="user.name" required>
          </div>
          <div class="form-group">
            <label for="email">YOUR EMAIL *</label>
            <input id="email" type="email" name="email" ng-model="user.email" required>
          </div>
          <div ng-show="form.$submitted || form.email.$touched">
            <span class="invalid" ng-show="form.email.$error.email">This is not a valid email.</span>
          </div>
          <div class="form-group">
            <label for="city">YOUR CITY (OPTIONAL)</label>
            <input id="city" type="text" name="city" ng-model="user.city">
          </div>
          <div class="form-group">
            <label for="msg">YOUR MESSAGE *</label>
            <textarea id="message" type="textarea" name="message" ng-model="user.msg" required></textarea>
          </div>
          <div class="form-group">
            <input class="subscription" type="checkbox" name="subscription" ng-model="user.subscription">
            <p>I would like to subscribe to the newsletter.</p>
          </div>
          <input type="submit" id="submit" value="Send" ng-click="submit(user)" ng-disabled="form.$invalid"/>
        </form>
      </div>
      <!-- Thankyou Message People See when they submit the form: -->
      <div class="thankyou_message" id="thankyou_message">
        <p>{{successMessage}}</p>
        <p>{{thanksMessage}}</p>
      </div>
        
    </div>

    <!-- Light/Dark mode -->
    <script>
      if (localStorage.mode == "dark"){
        modeFunction();
      }
      //When in light mode show dark mode button and the other way around
      $(function(){
        $("#to-dark, #to-light").click(modeFunction);
      });
          
      function modeFunction(){
        $("#to-dark").toggle();
        $("#to-light").toggle();
        $(document.documentElement).toggleClass("dark");
        $("#white-img").toggle();
        $("#black-img").toggle();
      } 
    </script>
      
    <!-- Shopping cart -->
    <script>
      // Get the cart
      var cart = document.getElementById("shopping-cart");

      // Get the button that opens the cart
      var button = document.getElementById("cart");

      // When the user clicks the button, open the cart
      button.onclick = function() {
        cart.style.display = "block";
      }

      // When the user clicks anywhere outside of the cart, close it
      window.onclick = function(event) {
        if (event.target == cart) {
          cart.style.display = "none";
        }
      }
    </script>

    <!-- Send form -->
    <script>
      /*Contact form*/
      var app = angular.module('contact',[]);

      app.controller("ContactForm", ['$scope', function($scope, $http) {

        this.formInput = {};
        $scope.successMessage="Your message has been sent successfully.";
        $scope.thanksMessage="Thanks for visiting.";

        $scope.submit = function(user) { /*If the inputs are valids the test will be sent*/
          this.formInput = angular.copy(user);
          console.log('Message sent successfully');
          console.log(this.formInput);
          
          document.getElementById('contact').style.display = "none";
          document.getElementById("thankyou_message").style.display = "block";
        };
      }]);
    </script>
      
    <!-- Submit the Form to Google Using "AJAX" -->
    <script data-cfasync="false" src="form-submission-handler.js"></script>

  </body>
</html>
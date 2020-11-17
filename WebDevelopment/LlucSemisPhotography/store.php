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
    <title>Store | Lluc Semis</title>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
    <script src="shopping-cart.js" async></script>
    <script src="color-mode.js" async></script>
      
    <!-- Css files -->
    <link rel="stylesheet" href="style/store-style.css">
  </head>

  <body ng-app="store">
      
    <!-- Navbar -->
    <div class="navbar">
      <a href="home.php">
        <p class="title">LLUC SEMIS</p>
      </a>
      <hr width="20%" padding="none">
      <p class="subtitle">WILDLIFE PHOTOGRAPHY</p>
      <div class="more">
        <div class="more-cart">
        </div>
        <div class="mode">
          <button class="mode-button" id="to-dark">DARK MODE</button>
          <button class="mode-button" id="to-light">LIGHT MODE</button>
        </div>
      </div>
    </div>
      
    <div class="container" ng-controller="StoreForm">
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
      <div class="store" id="store">
        <form name="form" class="gform" novalidate method="POST" action="https://script.google.com/a/estudiant.upf.edu/macros/s/AKfycbza0UAegWZwlIy-KlohhGDbK6xwrxnpxU1_xOCz/exec">
          <div class="billing">
            <div class="form-group">
              <label for="name">FULL NAME *</label>
              <input id="name" type="text" name="name" ng-model="user.name" required>
            </div>
            <div class="form-group">
              <label for="email">EMAIL *</label>
              <input id="email" type="email" name="email" ng-model="user.email" required>
            </div>
            <div ng-show="form.$submitted || form.email.$touched">
              <span class="invalid" ng-show="form.email.$error.email">This is not a valid email.</span>
            </div>
            <div class="form-group">
              <label for="address">ADDRESS *</label>
              <input id="address" type="text" name="address" ng-model="user.address" required>
            </div>
            <div class="form-group">
              <label for="city">CITY *</label>
              <input id="city" type="text" name="city" ng-model="user.city" required>
            </div>
            <div class="small-label">
              <div class="form-group">
                <label for="country">COUNTRY *</label>
                <input id="country" type="text" name="country" ng-model="user.country" required>
              </div>
            </div>
            <div class="small-label" style="margin-left: 55%;">
              <div class="form-group">
                <label for="zip">ZIP *</label>
                <input id="zip" type="text" name="zip" ng-model="user.zip" required>
              </div>
            </div>
          </div>
          <div class="payment">
            <div class="form-group">
              <label for="name">ACCEPTED CARDS</label>
              <i class="fa fa-cc-visa" style="font-size: 28px; color:navy;"></i>
              <i class="fa fa-cc-amex" style="font-size: 28px; color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="font-size: 28px; color:red;"></i>
              <i class="fa fa-cc-discover" style="font-size: 28px; color:orange;"></i>
            </div>
            <div class="form-group">
              <label for="cardname">NAME ON CARD *</label>
              <input id="cardname" type="text" name="cardname" ng-model="user.cardname" required>
            </div>
            <div class="form-group">
              <label for="cardnum">CARD NUMBER *</label>
              <input id="cardnum" type="text" name="cardnum" ng-model="user.cardnum" required>
            </div>
            <div class="small-label">
              <div class="form-group">
                <label for="expdate">EXP DATE *</label>
                <input id="expdate" type="text" name="expdate" placeholder="MM/DD" ng-model="user.expdate" required>
              </div>
            </div>
            <div class="small-label" style="margin-left: 55%;">
              <div class="form-group">
                <label for="cvv">CVV *</label>
                <input id="cvv" type="text" name="cvv" ng-model="user.cvv" required>
              </div>
            </div>
            <input type="submit" id="submit" value="Send" ng-click="submit(user)" ng-disabled="form.$invalid"/>
          </div>
        </form>
        <div class="cart">
          <div class="shopping-content">
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
              <strong style="margin-right: 10px;">TOTAL</strong>
              <span class="cart-total-price" style="margin-right: 40px" ng-model="user.totalpurchase">0DKK</span>
            </div>
          </div>
        </div>
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
      } 
    </script>
      
    <!-- Send form -->
    <script>
      /*Contact form*/
      var app = angular.module('store',[]);

      app.controller("StoreForm", ['$scope', function($scope, $http) {

        this.formInput = {};
        $scope.successMessage="Your purchase has been done successfully";
        $scope.thanksMessage="Thanks for buying.";

        $scope.submit = function(user) { /*If the inputs are valids the test will be sent*/
          this.formInput = angular.copy(user);
          console.log('Message sent successfully');
          console.log(this.formInput);
          
          document.getElementById('store').style.display = "none";
          document.getElementById("thankyou_message").style.display = "block";
        };
      }]);
    </script>
      
    <!-- Submit the Form to Google Using "AJAX" -->
    <script data-cfasync="false" src="form-submission-handler.js"></script>

  </body>
</html>
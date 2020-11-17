<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" href="Images/Bird1.png" type="image/gif" sizes="16x16">
    <!-- Include jquey -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Spinnaker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Basic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
    <title>Projects | Lluc Semis</title>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
    <script src="shopping-cart.js" async></script>
    <script src="color-mode.js" async></script>

    <!-- Css files -->
    <link rel="stylesheet" href="style/main-style.css">
    <link rel="stylesheet" href="style/projects-style.css">
  </head>
    
  <body>
      
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
      
    <div class="container">
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
      <div class="buttons" id="buttons">
        <?php
          $photos = glob('Images/Projects/Buttons/*.{jpg,png,gif}', GLOB_BRACE);
          $i = 1;
          foreach($photos as $photo) {
            $path = "$photo";
            $image = "buttonsimg";
            $container = "buttonscontainer";
            $idimg = "buttonsimg$i";
            $idbutton = "button$i";
            $click = "closeButtons(this);";
            
            //We make the background of each button a photo of the project
            echo "<style>
              #$idimg {
                background-image: url($path);
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
              }
            </style>";
            echo "<div class=$image id=$idimg>";
            echo "<div class=$container>";
            //Each botton has its project tittle
            switch ($i) {
              case "1":
                echo "<button id=$idbutton onclick=$click value=1>DELTA</button>";
                break;
              case "2":
                echo "<button id=$idbutton onclick=$click value=2>BIRDS</button>";
                break;
              case "3":
                echo "<button id=$idbutton onclick=$click value=3>HERPS</button>";
                break;
              case "4":
                echo "<button id=$idbutton onclick=$click value=4>MACRO</button>";
            }
            echo "</div>";
            echo "</div>";
            $i += 1;
          }
        ?>
      </div>
      <div class="content" id="content">
        <div class="scroller" id="scroller" style="display: none;">
          <?php
            $i = 1;
            $white = "Images/WhiteP.png";
            $whiteclass = "white-img";
            $black = "Images/BlackP.png";
            $blackclass = "black-img";
            $row = "row";
            $div = "photos-container";
            $add = "add-cart";
            $imgclass = "shopping-image";
            $photos = glob('Images/Projects/Project1/*.{jpg,png,gif}', GLOB_BRACE);
            if( $photos ) { 
              $count = count($photos); 
            }
            $half = round($count/2) + 1;
            foreach($photos as $photo) {
              $imgid = "Delta$i";
              $path = "$photo";
              if ($i == 1){
                echo "<div class=$row>";
                echo "<img src=$white class=$whiteclass>";
                echo "<img src=$black class=$blackclass style='display: none;'>";
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              } 
              elseif ($i == $half){
                echo "</div>";
                echo "<div class=$row>";
                echo "<img src=$white class=$whiteclass>";
                echo "<img src=$black class=$blackclass style='display: none;'>";
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              }
              elseif ($i == $count){
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
                echo "</div>";
              }
              else {
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              }
              $i += 1;
            }
          ?>
        </div>
        <div class="scroller" id="scroller" style="display: none;">
          <?php
            $i = 1;
            $white = "Images/WhiteP.png";
            $whiteclass = "white-img";
            $black = "Images/BlackP.png";
            $blackclass = "black-img";
            $row = "row";
            $div = "photos-container";
            $add = "add-cart";
            $imgclass = "shopping-image";
            $photos = glob('Images/Projects/Project2/*.{jpg,png,gif}', GLOB_BRACE);
            if( $photos ) { 
              $count = count($photos); 
            }
            $half = round($count/2) + 1;
            foreach($photos as $photo) {
              $imgid = "Birds$i";
              $path = "$photo";
              if ($i == 1){
                echo "<div class=$row>";
                echo "<img src=$white class=$whiteclass>";
                echo "<img src=$black class=$blackclass style='display: none;'>";
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              } 
              elseif ($i == $half){
                echo "</div>";
                echo "<div class=$row>";
                echo "<img src=$white class=$whiteclass>";
                echo "<img src=$black class=$blackclass style='display: none;'>";
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              }
              elseif ($i == $count){
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
                echo "</div>";
              }
              else {
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              }
              $i += 1;
            }
          ?>
        </div>
        <div class="scroller" id="scroller" style="display: none;">
          <?php
            $i = 1;
            $white = "Images/WhiteP.png";
            $whiteclass = "white-img";
            $black = "Images/BlackP.png";
            $blackclass = "black-img";
            $row = "row";
            $div = "photos-container";
            $add = "add-cart";
            $imgclass = "shopping-image";
            $photos = glob('Images/Projects/Project3/*.{jpg,png,gif}', GLOB_BRACE);
            if( $photos ) { 
              $count = count($photos); 
            }
            $half = round($count/2) + 1;
            foreach($photos as $photo) {
              $imgid = "Herps$i";
              $path = "$photo";
              if ($i == 1){
                echo "<div class=$row>";
                echo "<img src=$white class=$whiteclass>";
                echo "<img src=$black class=$blackclass style='display: none;'>";
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              } 
              elseif ($i == $half){
                echo "</div>";
                echo "<div class=$row>";
                echo "<img src=$white class=$whiteclass>";
                echo "<img src=$black class=$blackclass style='display: none;'>";
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              }
              elseif ($i == $count){
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
                echo "</div>";
              }
              else {
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              }
              $i += 1;
            }
          ?>
        </div>
        <div class="scroller" id="scroller" style="display: none;">
          <?php
            $i = 1;
            $white = "Images/WhiteP.png";
            $whiteclass = "white-img";
            $black = "Images/BlackP.png";
            $blackclass = "black-img";
            $row = "row";
            $div = "photos-container";
            $add = "add-cart";
            $imgclass = "shopping-image";
            $photos = glob('Images/Projects/Project4/*.{jpg,png,gif}', GLOB_BRACE);
            if( $photos ) { 
              $count = count($photos); 
            }
            $half = round($count/2) + 1;
            foreach($photos as $photo) {
              $imgid = "Macro$i";
              $path = "$photo";
              if ($i == 1){
                echo "<div class=$row>";
                echo "<img src=$white class=$whiteclass>";
                echo "<img src=$black class=$blackclass style='display: none;'>";
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              } 
              elseif ($i == $half){
                echo "</div>";
                echo "<div class=$row>";
                echo "<img src=$white class=$whiteclass>";
                echo "<img src=$black class=$blackclass style='display: none;'>";
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              }
              elseif ($i == $count){
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
                echo "</div>";
              }
              else {
                echo "<div class=$div>";
                echo "<img src=$path class=$imgclass id=$imgid>";
                echo "<div class=$add> <p>ADD TO CART</p> </div>";
                echo "</div>";
              }
              $i += 1;
            }
          ?>
        </div>
        <span onclick="closeTab();" class="closebtn" id="closebtn" style="display: none">&times;</span>
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
        $(".white-img").toggle();
        $(".black-img").toggle();
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

    <!-- Tabs button -->
    <script>
      function closeButtons(button){
        var val = button.value;
        document.getElementById('buttons').style.display = "none";
        document.getElementById('content').style.display = "block";
        openTab(val);
      }

      function openTab(val) {
        //We get the possible scrollers and choose the one with the value = the one clicked
        var scrollers = document.getElementsByClassName("scroller");
        var j = val - 1;
      
        scrollers[j].style.display = "block"; //We show the choosen scroller
        document.getElementById("closebtn").style.display = "block"; //Show the close button
      }

      function closeTab(){
        /*We first hide the current scroller and then hide the content div and show the buttons div */
        var scrollers = document.getElementsByClassName("scroller");
        var j = 0;
        for (j = 0; j < scrollers.length; j++){
          if (scrollers[j].style.display == "block"){
            scrollers[j].style.display = "none";
          }
        }
        document.getElementById('content').style.display = "none";
        document.getElementById('buttons').style.display = "block";
        document.getElementById("closebtn").style.display = "none"; //Hide the close button 
      }
    </script>

    <!-- Image scroller -->
    <script type="text/javascript" >
      /*Image scroller*/
      (function() {
        var scrollers = document.getElementsByClassName('scroller');
        function scrollHorizontally(e) {
          e = window.event || e;
          var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
          for (j = 0; j < scrollers.length; j++){
            scrollers[j].scrollLeft -= (delta*30); // Multiplied by 30
          }
          e.preventDefault();
        }
        for (j = 0; j < scrollers.length; j++){
          if (scrollers[j].addEventListener) {
            // IE9, Chrome, Safari, Opera
            scrollers[j].addEventListener("mousewheel", scrollHorizontally, false);
            // Firefox
            scrollers[j].addEventListener("DOMMouseScroll", scrollHorizontally, false);
          } else {
            // IE 6/7/8
            scrollers[j].attachEvent("onmousewheel", scrollHorizontally);
          }
        }
      })();
    </script>

  </body>
</html>
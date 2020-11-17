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
    <title>Bio | Lluc Semis</title>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
    <script src="shopping-cart.js" async></script>
    <script src="color-mode.js" async></script>
      
    <!-- Css files -->
    <link rel="stylesheet" href="style/main-style.css">
    <link rel="stylesheet" href="style/bio-style.css">
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
      <div class="bio">
        <p>
          My name is Lluc Semis and I was born in December 1996 in La Pobla de Mafumet, Tarragona.
          From an early age, I began to feel a great interest and connection with nature. It was my
          grandfather the one who taught me my first notions when we went to work in the orchard.
        </p>
        <p>
          In 2012, motivated by my biology teacher, I started taking pictures so as to document the
          fauna and flora that could be found in the surroundings of Turó School, using a bridge camera
          that my dad had been given a few years before. Initially, photography was for me a way of
          documenting what I saw, but I quickly felt the need to say something more with my
          photographs - to depict my personal vision.
        </p>
        <p>
          While digitalization and globalization have made the taking and sharing of photographs
          relatively easy, they have also contributed to the deterioration of our ecosystems. We must be
          aware of how important the conservation of our natural spaces really is, and that is exactly
          what I try to convey in my pictures and texts.
        </p>
      </div>
      <div class="scroller" id="scroller"> <!-- In case we want to add more than one photo to the bio -->
          
        <?php
            $photos = glob('Images/Bio/*.{jpg,png,gif}', GLOB_BRACE);
            foreach($photos as $photo) {
            $path = "$photo";
            echo "<img src=$path >";
            }
        ?>

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

    <!-- Image scroller -->
    <script type="text/javascript" >
      /*Image scroller*/
      (function() {
        function scrollHorizontally(e) {
          e = window.event || e;
          var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));

          document.getElementById('scroller').scrollLeft -= (delta*30); // Multiplied by 40
          e.preventDefault();
        }
        if (document.getElementById('scroller').addEventListener) {
          // IE9, Chrome, Safari, Opera
          document.getElementById('scroller').addEventListener("mousewheel", scrollHorizontally, false);
          // Firefox
          document.getElementById('scroller').addEventListener("DOMMouseScroll", scrollHorizontally, false);
        } else {
          // IE 6/7/8
          document.getElementById('scroller').attachEvent("onmousewheel", scrollHorizontally);
        }
      })();
    </script>
  </body>

</html>
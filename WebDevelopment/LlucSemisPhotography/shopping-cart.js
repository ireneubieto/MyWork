/*If the page is still loading / Has loaded */
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready(){

    //If there is a cart stored, we will update the current cart
    if (localStorage.cart) {
      createCart();
    }
    
    /*Remove photos from the cart */
    var removeCartItemButtons = document.getElementsByClassName('remove-button')
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }
    
    /*If the quantity of items is changed*/
    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }
    
    /*Put the photos on the cart*/
    var addToCartButtons = document.getElementsByClassName('add-cart')
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }
    
}

function addToCartClicked(event) {
    var button = event.target //The current button
    var shopItem = button.parentElement.parentElement //Get the image container
    if (shopItem.className != "photos-container"){
        shopItem = button.parentElement //Get the image container
    }
    var title = shopItem.getElementsByClassName('shopping-image')[0].id
    var price = "75";
    var imageSrc = shopItem.getElementsByClassName('shopping-image')[0].src
    addItemToCart(title, price, imageSrc)
    updateCartTotal()
}

function addItemToCart(title, price, imageSrc) { //We put the element into the shopping cart
    var cartRow = document.createElement('div') //We create a div to put the selected image
    cartRow.classList.add('cart-row') //We say that this new div will be of class cart-row
    var cartItems = document.getElementsByClassName('cart-items')[0] //We look for the div in where to put it
    var cartItemNames = cartItems.getElementsByClassName('cart-categories')
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].id == title) {
            alert('This item is already added to the cart')
            return
        }
    }
    var cartRowContents = `
        <div class="cart-categories" style="width:100px;" id=${title}>
            <img src="${imageSrc}">
        </div>
        <div class="cart-categories" style="width:80px; margin-top:-40px; margin-left:90px; text-align: center;">
            <p class="cart-price">${price}DKK</p>
        </div>
        <div class="cart-categories" style="width:120px;  margin-top:-50px; margin-left:180px;">
            <input class="cart-quantity-input" type="number" value="1">
            <button class="remove-button">REMOVE</button>
        </div>`;
    cartRow.innerHTML = cartRowContents;
    cartItems.append(cartRow) //We add the new div to the end og the cart-items div
    cartRow.getElementsByClassName('remove-button')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}

function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateCartTotal()
}

function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total = 0
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('DKK', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('cart-total-price')[0].innerText = total + 'DKK'
    
    //We save the cart localy
    saveCart()
}

function createCart(){
    //If there is a cart stored, we will update the current cart
    var cartItems = document.getElementsByClassName('cart-items')[0] //We look for the div where we will put the elements of our cart
    cartItems.innerHTML = localStorage.cart;
    updateCartTotal();
    
}

function saveCart(){
    //We get all the elements inside the cart as they are in order to have the same cart
    //everytime the page is loaded and for all the site
    if (typeof(Storage) !== "undefined") {
      var cartItems = document.getElementsByClassName('cart-items')[0] //We look for the div of the elements in our cart
      localStorage.cart = cartItems.innerHTML;
      
    } else {
      alert('Sorry, your browser does not support web storage')
      return
    }  
}
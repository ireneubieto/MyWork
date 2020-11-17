/*If the page is still loading / Has loaded */
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready(){
    
    /*Depending on which button is pressed, save the mode we are in*/
    var modeButtons = document.getElementsByClassName('mode-button')
    for (var i = 0; i < modeButtons.length; i++) {
        var button = modeButtons[i]
        if (button.id == "to-dark"){ //We pass to dark mode
            button.addEventListener('click', darkMode);
        } else if (button.id == "to-light"){ // We pass to light mode
            button.addEventListener('click', lightMode);
        }
    }
    
}

function darkMode(){
    localStorage.mode = "dark";
}

function lightMode(){
    localStorage.mode = "light";
}

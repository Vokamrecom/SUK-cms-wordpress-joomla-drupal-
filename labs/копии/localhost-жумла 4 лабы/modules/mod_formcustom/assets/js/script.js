let isOpen = false;

function onButtonClick(){
    if(isOpen === false){
        document.getElementById("form").style.display = 'block';
        isOpen = true;
    } else {
        document.getElementById("form").style.display = 'none';
        isOpen = false;
    }
}
<?php
defined("_JEXEC") or die();

$document = JFactory::getDocument(); 
$document->addStyleSheet(JURI::base().'modules/mod_formcust/assets/css/style.css');
$document->addScript(JURI::base().'modules/mod_formcust/assets/js/script.js');
?>
<script>
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

function Check(){
    document.getElementById("message").innerHTML = "";
    document.getElementById("error").innerHTML = "";
    if (document.getElementById("result").value == "4"){
        document.getElementById("message").innerHTML = "The captcha is passed";
    } else {
        document.getElementById("error").innerHTML = "The captcha is not passed";
    }
}
</script>
<div class="user-module<?php echo $moduleclass_sfx; ?>">
    <button onclick="onButtonClick()">Contact Form</button>
        <div id="form" style="display:none;">
        <div id="message" style="color:green;"></div>
        <div id="error" style="color:red;"></div>
            <form class="contact-form">
                User name:
                <br>
                <input type="text" name="username" style="height:15px">
                <br>
                Message subject:
                <br>
                <input type="text" name="theme" style="height:15px">
                <br>
                Message :
                <br>
                <div>
                <textarea name="message" placeholder="enter text" ></textarea>
                </div>
                <br>
                <div>2+2=?
                <input type="text" id="result" style="width: 20px; height: 10px">
                <input type="button" style="margin-right: 15px; background: crimson; color: white" value="Check captcha" onclick="Check()">
                </div>
                <br>
                <input type="button" id="sendButton" value="Send">
            </form>
        </div>
</div>

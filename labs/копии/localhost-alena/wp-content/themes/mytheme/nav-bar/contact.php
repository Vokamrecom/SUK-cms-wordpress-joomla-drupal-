<!DOCTYPE html>
<html>
    <head>
        <title>contact</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar">
            <div class="label">
                <a href="/index.html">Laptopstation</a>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Продукты
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="laptops.html">Ноутбуки</a>
                <a href="bags.html">Сумки для ноутбуков</a>
                </div>
            </div> 					
            <div style="flex-grow: 1;">
                <a href="delivery.html">Доставка</a>
            </div>
            <div style="flex-grow: 1;">
                <a href="contact.html" >Контактная информация</a>
            </div>
        </div>

    <div class="thm-container">
            <div class="row">
                <div>
                    <div class="contact-form-content">
                        <div class="title">
                            <h2>Отправьте сообщение</h2>
                        </div><!-- /.title -->
                        <form class="contact-form" novalidate="novalidate">
                            <input type="text" name="name" placeholder="Полное имя">
                            <input type="text" name="email" placeholder="Почта">
                            <textarea name="message" placeholder="Ваше сообщение"></textarea>
                            <button type="submit" class="thm-btn yellow-bg">Отправить</button>
                            <div class="form-result"></div><!-- /.form-result -->
                        </form>
                    </div><!-- /.contact-form-content -->
                </div><!-- /.col-md-8 -->
                <div class="col-md-4">
                    <div class="contact-info">
                    <center>
                        <div class="title text-center">
                                <h2>Детали</h2>
                            </div><!-- /.title -->
                            <div class="single-contact-info">
                                <h4>Адрес</h4>
                                <p>ул.Ложинская 4<br> г. Минск, Беларусь</p>
                            </div><!-- /.single-contact-info -->
                            <div class="single-contact-info">
                                <h4>Телефон</h4>
                                <p>+375 33 6574321</p>
                            </div><!-- /.single-contact-info -->
                            <div class="single-contact-info">
                                <h4>Почта</h4>
                                <p>needhelp@printify.com <br> inquiry@printify.com</p>
                            </div><!-- /.single-contact-info -->
                            <!--
                            <div class="single-contact-info">
                                <h4>Подпишись</h4>
                                <div class="social">
                                    <a href="#" class="fab fa-twitter hvr-pulse"></a>
                                    <a href="#" class="fab fa-pinterest hvr-pulse"></a>  
                                    a href="#" class="fab fa-facebook-f hvr-pulse"></a>  
                                    <a href="#" class="fab fa-youtube hvr-pulse"></a>
                                </div>
                            </div> -->
                        </div><!-- /.contact-info -->
                    </center>
                </div><!-- /.col-md-4 -->
            </div><!-- /.row -->
        </div>

        <div class="footer">
        </div>
    </body>
</html>
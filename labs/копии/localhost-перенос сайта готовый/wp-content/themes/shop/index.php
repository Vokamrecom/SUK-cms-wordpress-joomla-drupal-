<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shop
 */

get_header();
?>

	<img alt="" src="<?php bloginfo( 'stylesheet_url' ); ?>/images/matcha.jpg" />

    	<div class="gtco-section">
    		<div class="gtco-container">
    			<div class="row">
    				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
    					<h2 class="cursive-font primary-color">Акции</h2>
    					<p>Описание какой тут хороший чай</p>
    				</div>
    			</div>
    			<div class="row">

                    <div class="col-lg-4 col-md-4 col-sm-6">
    <img alt="" src="<?php bloginfo( 'stylesheet_url' ); ?>/images/matcha.jpg" />
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="images/matcha.jpg" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Матча</h2>
                                <p>Чай для настоящих мужчин</p>
                                <p><span class="price cursive-font">35,00 руб</span></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="images/img_2.jpg" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="images/hodzicha.jpg" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Ходзича</h2>
                                <p>Чай для настоящих женщин</p>
                                <p><span class="price cursive-font">33,00 руб</span></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="images/zin-suan.jpg" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="images/zin-suan.jpg" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Цзинь Сюань</h2>
                                <p>Чай для настоящего спокойствия</p>
                                <p><span class="price cursive-font">59,00 руб</span></p>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="images/assam.jpg" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="images/assam.jpg" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Ассам</h2>
                                <p>Просто красный чай, если хочется чего-то новенького</p>
                                <p><span class="price cursive-font">10,90 руб</span></p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="images/chainik2.jpg" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="images/chainik2.jpg" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Комплекс заварочный (типот) PIAO I GL-865</h2>
                                <p>Комплекс заварочный (типот) PIAO I GL-865</p>
                                <p><span class="price cursive-font">64,00 руб</span></p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="images/noz.jpg" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="images/noz.jpg" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Нож для пуэра</h2>
                                <p>Металлический нож для пуэра.</p>
                                <p><span class="price cursive-font">7,50 руб</span></p>
                            </div>
                        </a>
                    </div>

    			</div>
    		</div>
    	</div>

    	<div id="gtco-features">
    		<div class="gtco-container">
    			<div class="row">
    				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
    					<h2 class="cursive-font">Преимущества</h2>
    					<p>Факты о нашей компании</p>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-md-4 col-sm-6">
    					<div class="feature-center animate-box" data-animate-effect="fadeIn">
    						<span class="icon">
    							<i class="ti-face-smile"></i>
    						</span>
    						<h3>Счастливые люди</h3>
    						<p>Не один заказчик не остался без нашего внимания</p>
    					</div>
    				</div>
    				<div class="col-md-4 col-sm-6">
    					<div class="feature-center animate-box" data-animate-effect="fadeIn">
    						<span class="icon">
    							<i class="ti-thought"></i>
    						</span>
    						<h3>Принимаем заказы на нашем сайте</h3>
    						<p>Мы дорожим вашим временем</p>
    					</div>
    				</div>
    				<div class="col-md-4 col-sm-6">
    					<div class="feature-center animate-box" data-animate-effect="fadeIn">
    						<span class="icon">
    							<i class="ti-truck"></i>
    						</span>
    						<h3>Быстрая доставка</h3>
    						<p>Быстро доставим товар к вам по адресу который вы укажете</p>
    					</div>
    				</div>


    			</div>
    		</div>
    	</div>


    	<div class="gtco-cover gtco-cover-sm" style="background-image: url(images/img_bg_1.jpg)"  data-stellar-background-ratio="0.5">
    		<div class="overlay"></div>
    		<div class="gtco-container text-center">
    			<div class="display-t">
    				<div class="display-tc">
    					<h1>&ldquo; Я боюсь, что конец света настанет до вечернего чая.</h1>
    					<p>&mdash; Sydney Smith</p>
    				</div>
    			</div>
    		</div>
    	</div>

    	<div id="gtco-counter" class="gtco-section">
    		<div class="gtco-container">

    			<div class="row">
    				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
    					<h2 class="cursive-font primary-color">Статистика</h2>
    					<p>За 2018</p>
    				</div>
    			</div>

    			<div class="row">

    				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
    					<div class="feature-center">
    						<span class="counter js-counter" data-from="0" data-to="5" data-speed="5000" data-refresh-interval="50">1</span>
    						<span class="counter-label">Рейтинг компании</span>

    					</div>
    				</div>
    				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
    					<div class="feature-center">
    						<span class="counter js-counter" data-from="0" data-to="43" data-speed="5000" data-refresh-interval="50">1</span>
    						<span class="counter-label">Видов чая</span>
    					</div>
    				</div>
    				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
    					<div class="feature-center">
    						<span class="counter js-counter" data-from="0" data-to="32" data-speed="5000" data-refresh-interval="50">1</span>
    						<span class="counter-label">Проведенных акций</span>
    					</div>
    				</div>
    				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
    					<div class="feature-center">
    						<span class="counter js-counter" data-from="0" data-to="1985" data-speed="5000" data-refresh-interval="50">1</span>
    						<span class="counter-label">Основана компания</span>

    					</div>
    				</div>

    			</div>
    		</div>
    	</div>



    	<div id="gtco-subscribe">
    		<div class="gtco-container">
    			<div class="row animate-box">
    				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
    					<h2 class="cursive-font">Подпишись</h2>
    					<p>Чтоб быть вкурсе последних новостей</p>
    				</div>
    			</div>
    			<div class="row animate-box">
    				<div class="col-md-8 col-md-offset-2">
    					<form class="form-inline">
    						<div class="col-md-6 col-sm-6">
    							<div class="form-group">
    								<label for="email" class="sr-only">Email</label>
    								<input type="email" class="form-control" id="email" placeholder="Your Email">
    							</div>
    						</div>
    						<div class="col-md-6 col-sm-6">
    							<button type="submit" class="btn btn-default btn-block">Подписаться</button>
    						</div>
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>

<?php
get_sidebar();
get_footer();

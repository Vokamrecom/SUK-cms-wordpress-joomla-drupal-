<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'my' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'eazr_dRie_`OHp2p5)/[<(9}+Tmp)4s7q/|At4BGN~3kC(Vw7sUFH[AHA}Cy/z(5');
define('SECURE_AUTH_KEY',  ']6$qpoBT?rmCn swug|iXj}J%Vi|-`|Fyx.[qa*ZaStIiYnmkQNqlizK~N#]80Hu');
define('LOGGED_IN_KEY',    '#YkbLwUnn+GX-#*+4.ltd</pL~^xND/#Z.ZD=+pi^l3feRxH=qtfhao>-ik|^X4+');
define('NONCE_KEY',        'YFF~xUraob0,p?+W{`y8]5Ba,qdp-7AdPPSRxI]TI_F`!-?D|v:[!UG<!yVD}+M$');
define('AUTH_SALT',        '40pf;C/u$#lgH){m7N{|up~YJbgU{oD*cjay%l-i+#pJG]|S/!0^JhMAdbHD264`');
define('SECURE_AUTH_SALT', 'DJxGx9(kFc8up@+->|e;Pgsqf%`zre9wiq}nb,=k!d;c[ic<~6B|J4Iy 7AD|oaX');
define('LOGGED_IN_SALT',   '7;mCFD(j,J-V+:423,cKc -&SQu>~+w7QAz%0f<&,i/4Ov{npYS>YUy|g%n2?9~~');
define('NONCE_SALT',       '_YpTO$$ve]`@`|B;&JCm!6pr-|pS6!)GRSm]XAz#n/8eD+0kQA&H8l[1*l<;ax#Z');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );

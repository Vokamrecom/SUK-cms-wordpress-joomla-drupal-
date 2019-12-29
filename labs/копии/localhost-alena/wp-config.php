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
define('DB_NAME', 'laptopstation_db');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3f!2j=n+Xf,IA3QG]&+1R8t3IuU*-x[m|9[! 8]@KVdP[V_d-<]h1Zn~[q5.ldfe');
define('SECURE_AUTH_KEY',  'gT?-j]]t~t`Z ]=GaVG.[izV>Xzsdl@EN@=WvjP+&KJ&R>08,RO.t4uE+i>-a{6:');
define('LOGGED_IN_KEY',    '_n/c{~|s^1VeY{^yF%;RhPy^A:=Ba@;E.U2^?aNm)yp#<H26AD#IjuOsfxYQTzz:');
define('NONCE_KEY',        'l+|n/(t7kLL+d+~QSAqr%4XnE.kX--Y-G0;pc5wmQbcpA0<.068KdiwuVbVwo})P');
define('AUTH_SALT',        's{U/(%s>z1N}trw}q,+W>RR:!&$QC>$-d>OaHA(Og,_:-|{?d|miy=D>sI~zjZJj');
define('SECURE_AUTH_SALT', '-PB&+w9#^.R,+XRSh:4xR)ReU{sdL%g<*7RM0nQT+1Im):lQ=@>`[gkc$F`y]w13');
define('LOGGED_IN_SALT',   'G|Eh=pCKWl~f:pwX{(<|U+Gw>g=MDBua^:nEs-erRG-jZX<4zIF;Uv><HDAj-Qw+');
define('NONCE_SALT',       '.py q]zSMV|SObK??pM{@oudj KwC2l!HT&?{:p>HD)u.{B0OVFS|AA%3>*NFd+X');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');

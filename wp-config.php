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
define('DB_NAME', '');

/** Имя пользователя MySQL */
define('DB_USER', '');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define( 'DB_HOST', '' );

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
define('AUTH_KEY',         'FMS?S8BCOMANBCK!7X&X/S_/8A@*A..KLX%TW,UW</55A43/>>VOSFUL>_ME*P%?A');
define('SECURE_AUTH_KEY',  'GFOSV90VO&LPGZLSO:>3X5J?JN?9YBB4&B..!CX%<*<3S:W%MW5AVF>.2_ZR!P3.4');
define('LOGGED_IN_KEY',    'A//HV&&2IAC%V@1Z9//3*O0XSX?&U://D2/M*7WKZNU3K>3X2,AR*!?1EGFZ>8%ZJ');
define('NONCE_KEY',        'ORCV:BB_H@.N_W6VB,?SEI/C/?/S//E03SK3P//>...VCTH7_YZ@%2T4C6:SNDM4!');
define('AUTH_SALT',        'MF1P1P:QI:3D!QB?JQH7!<B4N*37!O7LS?WRFW2V>X<A53YK.23&&N!//!E3M7..J');
define('SECURE_AUTH_SALT', 'KW:T..&1Z:F//3PC@D*.7<ME1?*,KHB5P//@BOP..YS%KYL7@W3L&K5F028I>4?K!');
define('LOGGED_IN_SALT',   'JC.QGYEMEMIFABYQRF...J..SB@W*@MR5!81.._.C?UO0M9T*F1JH.H,E.41B7LHS');
define('NONCE_SALT',       'CXGYY9HUKIUUSV:?8S2SYUW4,@I<IL3P>9:W//@<..1>50L%>2&H.T%@7EA..OA<_');

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

/** Hostenko menu
*/
add_action("admin_bar_menu", "hostenko_customize_menu");
function hostenko_customize_menu(){
global $wp_admin_bar;
$wp_admin_bar->add_menu(array(
"id" => "hostenko_menu",
"title" => "Hostenko",
"href" => "https://hostenko.com",
"meta" => array("target" => "blank")
));
$wp_admin_bar->add_menu(array(
"id" => "hostenko_menu_child",
"title" => "Личный кабинет",
"parent" => "hostenko_menu",
"href" => "https://hostenko.com/cabinet",
"meta" => array("target" => "blank")
));
$wp_admin_bar->add_menu(array(
"id" => "hostenko_menu_child2",
"title" => "WordPress темы",
"parent" => "hostenko_menu",
"href" => "https://hostenko.com/wpcafe/themes/",
"meta" => array("target" => "blank")
));
}
/** Hostenko widget
*/
function hostenko_widgets() {
wp_add_dashboard_widget(
'Hostenko',
'Бесплатные темы WordPress',
'hostenko_widget_function'
);
}
add_action( 'wp_dashboard_setup', 'hostenko_widgets' );

function hostenko_widget_function() {
echo '<a href="https://hostenko.com/wpcafe/themes/">Бесплатные темы</a> WordPress на нашем обучающем сайте WPcafe.org<br>
<center><a href="https://hostenko.com/wpcafe/themes/"><img src="https://hostenko.com/pics/wordpresso.png"></a></center>';
}

function hostenko_elementor_widgets() {
wp_add_dashboard_widget(
'Hostenko_elementor',
'Создание сайта с помощью Elementor',
'hostenko_elementor_widget_function'
);
}
add_action( 'wp_dashboard_setup', 'hostenko_elementor_widgets' );

function hostenko_elementor_widget_function() {
echo '<iframe width="392" height="221" src="https://www.youtube.com/embed/lAphSnN0UkA?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
}

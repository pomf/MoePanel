<?php

//define('MOE_DB_CONN', 'mysql:unix_socket=/tmp/mysql.sock;dbname=pomf');
define('MOE_DB_CONN', 'sqlite:/path/to/your/uguu/or/pomf/db.sq3');

/**
 * PDO database login credentials
 */

/** @param string POMF_DB_NAME Database username */
define('MOE_DB_USER', null);
/** @param string POMF_DB_PASS Database password */
define('MOE_DB_PASS', null);

/**
 * 'MOE_ROOT' - Root location for the Moe Panel
 * 'FILES_ROOT' - Where uploaded files are stored
 * 'PU_NAME' - Pomf/uguu instance name
 * 'PU_ADDRESS' - Pomf/uguu address/[sub]domain
 * 'PU_URL' - URL/[sub]domain to host files from including forward slash
 * 'MOE_URL' - URL for moe including forward slash
 */
define('MOE_ROOT', '/var/www/moepanel/');
define('FILES_ROOT', '/var/www/files/');
define('PU_NAME', 'Uguu');
define('PU_ADDRESS', 'uguu.se');
define('PU_SERVE_URL', 'https://a.uguu.se/');
define('MOE_URL', 'https://moepanel.uguu.se');
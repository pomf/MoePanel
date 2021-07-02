<?php

define('MOE_DB_CONN', 'mysql:unix_socket=/tmp/mysql.sock;dbname=pomf');

/**
 * PDO database login credentials
 */

/** @param string POMF_DB_NAME Database username */
define('MOE_DB_USER', null);
/** @param string POMF_DB_PASS Database password */
define('MOE_DB_PASS', null);

/**
 * 'FILES_ROOT' - Where uploaded files are stored
 * 'LENGTH' - Invite key length
 * 'PU_NAME' - Pomf/uguu instance name
 * 'PU_ADDRESS' - Pomf/uguu address/[sub]domain
 * 'PU_URL' - URL/[sub]domain to host files from
 * 'MOE_URL' - URL for moe
 * 'ID_CHARSET' - set of characters to use for file IDs
 */
define('FILES_ROOT', '/var/www/files/');
define('LENGTH', 32);
define('PU_NAME', 'Uguu');
define('PU_ADDRESS', 'uguu.se');
define('PU_SERVE_URL', 'https://a.uguu.se/');
define('MOE_URL', 'https://moe.uguu.se');
define('ID_CHARSET', '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

/** SMTP email settings */
define('SMTPD_HOST', '');
define('SMTPD_USERNAME', '');
define('SMTPD_PASSWORD', '');

/** Cloudflare creds for removing deleted files from their cache */
define('CF_EMAIL', '');
define('CF_TOKEN', '');
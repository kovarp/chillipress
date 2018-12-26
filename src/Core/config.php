<?php declare(strict_types=1);

global $configurator;
global $webrootPath;

$config = $configurator->getConfig();

// Database
define('DB_NAME', $config['database']['dbname']);
define('DB_USER', $config['database']['user']);
define('DB_PASSWORD', $config['database']['password']);
define('DB_HOST', $config['database']['host']);
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', 'utf8mb4_unicode_ci');
$table_prefix = $config['database']['prefix'];

// WordPress URLs
define('WP_HOME', $config['home']);
define('WP_SITEURL', $config['siteurl']);

define('AUTH_KEY', $config['salt']['AUTH_KEY']);
define('SECURE_AUTH_KEY', $config['salt']['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY', $config['salt']['LOGGED_IN_KEY']);
define('NONCE_KEY', $config['salt']['NONCE_KEY']);
define('AUTH_SALT', $config['salt']['AUTH_SALT']);
define('SECURE_AUTH_SALT', $config['salt']['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT', $config['salt']['LOGGED_IN_SALT']);
define('NONCE_SALT', $config['salt']['NONCE_SALT']);

define('WP_AUTO_UPDATE_CORE', FALSE);
define('DISALLOW_FILE_EDIT', TRUE);
define('WP_DEFAULT_THEME', 'chilli-codes');

define('CONTENT_DIR', 'content');
define('WP_CONTENT_DIR', $webrootPath . '/' . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);
<?php

use Includes\Autoloader;
use Includes\Decorator\Utils\CacheManager;

// It's the feature of PHP 5. We need to explicitly define current time zone.
// See also http://bugs.php.net/bug.php?id=48914
@date_default_timezone_set(@date_default_timezone_get());

// Short name
define('LC_DS', DIRECTORY_SEPARATOR);

// Modes
define('LC_IS_CLI_MODE', 'cli' === PHP_SAPI);

// Common end-of-line
define('LC_EOL', LC_IS_CLI_MODE ? "\n" : '<br />');

// Timestamp of the application start
define('LC_START_TIME', time());

// Namespaces
define('LC_NAMESPACE', 'DecoratorsDemo');
define('LC_NAMESPACE_INCLUDES', 'Includes');
define('LC_DECORATED_MARK', 'Original');
define('LC_MODULE_NAMESPACE', 'Module');

// Paths
define('LC_DIR',                 realpath(__DIR__));
define('LC_DIR_ROOT',            rtrim(LC_DIR, LC_DS) . LC_DS);
define('LC_DIR_VAR',             LC_DIR_ROOT . 'var' . LC_DS);
define('LC_DIR_CLASSES',         LC_DIR_ROOT . 'classes' . LC_DS);
define('LC_DIR_INCLUDES',        LC_DIR_ROOT . LC_NAMESPACE_INCLUDES . LC_DS);
define('LC_DIR_MODULES',         LC_DIR_CLASSES . LC_NAMESPACE . LC_DS . LC_MODULE_NAMESPACE . LC_DS);
define('LC_DIR_COMPILE',         LC_DIR_VAR . 'run' . LC_DS);
define('LC_DIR_LOGS',            LC_DIR_VAR . 'log' . LC_DS);
define('LC_DIR_CACHE_CLASSES',   LC_DIR_COMPILE . 'classes' . LC_DS);
define('LC_DIR_CACHE_MODULES',   LC_DIR_CACHE_CLASSES . LC_NAMESPACE . LC_DS . LC_MODULE_NAMESPACE . LC_DS);

define('LC_DEVELOPER_MODE', false);

// Composer
require_once (LC_DIR_ROOT . 'vendor' . LC_DS . 'autoload.php');

// Autoloading routines
require_once (LC_DIR_INCLUDES . 'Autoloader.php');

Autoloader::registerIncludes();

// Some common functions
require_once (LC_DIR_INCLUDES . 'functions.php');

Autoloader::registerClassCacheProductionAutoloader();

// Check and (if needed) rebuild classes cache
if (!defined('LC_DO_NOT_REBUILD_CACHE')) {
    CacheManager::rebuildCache();
}

// Do not register development class cache autoloader when:
// 1) Cache rebuild is in progress (other process is rebuilding the cache in separate var/run folder).
// 2) Script has opted out of using development class cache autoloader by defining LC_DO_NOT_REBUILD_CACHE (for example, ./restoredb)
if (LC_DEVELOPER_MODE && !CacheManager::isRebuildInProgress() && !defined('LC_DO_NOT_REBUILD_CACHE')) {
    Autoloader::registerClassCacheDevelopmentAutoloader();
} else {
    Autoloader::registerClassCacheProductionAutoloader();
}
<?php

// One minute to execute the script
@set_time_limit(300);

define('REBUILD_MODE_ALLOWED', true);

try {
    require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'bootstrap.php');

    // Run app code
    echo 'rebuild is ready!';

} catch (\Exception $e) {
    \Includes\ErrorHandler::handleException($e);
}
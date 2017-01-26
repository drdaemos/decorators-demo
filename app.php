<?php

// One minute to execute the script
@set_time_limit(300);

try {
    require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'bootstrap.php');

    // Run app code
    $app = new \DecoratorsDemo\App();
    $app->run();

} catch (\Exception $e) {
    \Includes\ErrorHandler::handleException($e);
}
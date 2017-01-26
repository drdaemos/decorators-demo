<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * Copyright (c) 2011-present Qualiteam software Ltd. All rights reserved.
 * See https://www.x-cart.com/license-agreement.html for license details.
 */

namespace Includes\Utils;

use Monolog\Handler\StreamHandler;


/**
 * Wrapper aroung monolog logger
 */
class Logger extends \Includes\Pattern\Singleton
{
    protected $logger;

    /**
     * @return void
     */
    protected function __construct()
    {
        $this->logger = new \Monolog\Logger('decorators-demo');
        $this->logger->pushHandler(new StreamHandler(LC_DIR_LOGS . 'decorators', \Monolog\Logger::WARNING));
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->logger, $name), $arguments);
    }
}
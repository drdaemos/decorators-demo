<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * Copyright (c) 2011-present Qualiteam software Ltd. All rights reserved.
 * See https://www.x-cart.com/license-agreement.html for license details.
 */

namespace Includes\Decorator;

/**
 * ADecorator
 *
 */
abstract class ADecorator
{
    /**
     * Cache building steps
     */
    const STEP_FIRST    = 1;
    const STEP_SECOND   = 2;

    const LAST_STEP = self::STEP_SECOND;

    /**
     * Current step
     *
     * @var string
     */
    protected static $step;

    /**
     * Modules graph
     *
     * @var \Includes\Decorator\DataStructure\Graph\Modules
     */
    protected static $modulesGraph;

    /**
     * Get step
     *
     * @return mixed
     */
    public static function getStep()
    {
        return static::$step;
    }

    /**
     * Return modules graph
     *
     * @return \Includes\Decorator\DataStructure\Graph\Modules
     */
    public static function getModulesGraph()
    {
        if (!isset(static::$modulesGraph)) {
            static::$modulesGraph = \Includes\Decorator\Utils\Operator::createModulesGraph();
        }

        return static::$modulesGraph;
    }

    /**
     * Return classes repository path
     *
     * @return string
     */
    public static function getClassesDir()
    {
        return self::STEP_FIRST == static::$step || self::STEP_SECOND == static::$step
            ? LC_DIR_CLASSES
            : static::getCacheClassesDir();
    }

    /**
     * Get cache classes directory path
     *
     * @return string
     */
    public static function getCacheClassesDir()
    {
        return \Includes\Decorator\Utils\CacheManager::getCompileDir() . 'classes' . LC_DS;
    }
}

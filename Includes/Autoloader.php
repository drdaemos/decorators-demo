<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * Copyright (c) 2011-present Qualiteam software Ltd. All rights reserved.
 * See https://www.x-cart.com/license-agreement.html for license details.
 */

namespace Includes;

use Includes\Decorator\ADecorator;
use Includes\Decorator\Utils\Operator;

/**
 * Autoloader
 *
 */
abstract class Autoloader
{
    /** @var \Includes\Autoload\ClassAutoLoaderInterface */
    protected static $classCacheAutoloader;

    /**
     * Autoloader for the "includes"
     *
     * @param string $class name of the class to load
     *
     * @return void
     */
    public static function __lc_autoload_includes($class)
    {
        $class = ltrim($class, '\\');

        if (0 === strpos($class, LC_NAMESPACE_INCLUDES)) {
            include_once (LC_DIR_ROOT . str_replace('\\', LC_DS, $class) . '.php');
        }
    }

    public static function registerClassOriginalAutoloader()
    {
        self::unregisterClassCacheAutoloader();

        self::$classCacheAutoloader = new Autoload\ClassAutoLoader(Operator::getClassesDir());

        self::$classCacheAutoloader->register();
    }

    public static function registerClassCacheProductionAutoloader()
    {
        self::unregisterClassCacheAutoloader();

        self::$classCacheAutoloader = new Autoload\ClassAutoLoader(Operator::getCacheClassesDir());

        self::$classCacheAutoloader->register();
    }

    public static function registerClassCacheDevelopmentAutoloader()
    {
        self::unregisterClassCacheAutoloader();

        // First, trying to get module list from DB
        $activeModules = array_keys(
            array_filter(Utils\ModulesManager::fetchModulesListFromDB(), function ($module) {
                return $module['enabled'];
            })
        );

        // If module list is empty (we're on cache rebuild), then call ModulesManager::getActiveModules
        if (empty($activeModules)) {
            // Autoload switch trick is required because ModulesManager::getActiveModules accesses some classes from classes/
            self::registerClassCacheProductionAutoloader();

            $activeModules = array_keys(Utils\ModulesManager::getActiveModules());

            self::unregisterClassCacheAutoloader();
        }

        self::$classCacheAutoloader = new Autoload\DevClassAutoLoader(LC_DIR_CLASSES, Operator::getCacheClassesDir(), $activeModules);

        self::$classCacheAutoloader->register();
    }

    public static function unregisterClassCacheAutoloader()
    {
        if (self::$classCacheAutoloader !== null) {
            self::$classCacheAutoloader->unregister();
        }
    }

    protected static function registerClassDir()
    {
        spl_autoload_register(array(get_called_class(), '__lc_autoload'));
    }

    /**
     * Register autoload functions
     *
     * @return void
     */
    public static function registerIncludes()
    {
        spl_autoload_register(array(get_called_class(), '__lc_autoload_includes'));
    }

    /**
     * Initialize classes directory
     * 
     * @return void
     */
    protected static function initializeClassesDir()
    {
        static::$lcAutoloadDir = \Includes\Decorator\ADecorator::getCacheClassesDir();
    }
}

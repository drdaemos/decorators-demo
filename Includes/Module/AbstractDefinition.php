<?php

namespace Includes\Module;

abstract class AbstractDefinition implements \Includes\Module\DefinitionInterface {

    /**
     * Method to initialize concrete module instance
     *
     * @return void
     */
    public function init()
    {
    }

    /**
     * Method to call just before the module is uninstalled (totally remove) via core
     *
     * @return void
     */
    public function callUninstallEvent()
    {
    }

    /**
     * Method to call just before the module is disabled via core
     *
     * @return void
     */
    public function callDisableEvent()
    {
    }

    /**
     * Method to call just after the module is installed
     *
     * @return void
     */
    public function callInstallEvent()
    {
    }

    /**
     * Return module name
     *
     * @return string
     */
    public function getModuleName()
    {
        return 'Module1';
    }

    /**
     * Return author full name
     *
     * @return string
     */
    public function getAuthorName()
    {
        return 'Vasya';
    }

    /**
     * Return module description
     *
     * @return string
     */
    public function getDescription()
    {
        return '';
    }

    /**
     * Return module dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return array();
    }

    /**
     * Return list of mutually exclusive modules
     *
     * @return array
     */
    public function getMutualModulesList()
    {
        return array();
    }

    /**
     * Get module major version
     *
     * @return string
     */
    public function getMajorVersion()
    {
        return '0';
    }

    /**
     * Get minor core version which is required for the module activation
     *
     * @return string
     */
    public function getMinorRequiredCoreVersion()
    {
        return '0';
    }

    /**
     * Get module minor version
     *
     * @return string
     */
    public function getMinorVersion()
    {
        return '1';
    }

    /**
     * Get module build number (4th number in the version)
     *
     * @return string
     */
    public function getBuildVersion()
    {
        return '0';
    }

    /**
     * Get module version
     *
     * @return string
     */
    public function getVersion()
    {
        return \Includes\Utils\Converter::composeVersion(static::getMajorVersion(), static::getFullMinorVersion());
    }

    /**
     * Get module version
     *
     * @return string
     */
    public function getFullMinorVersion()
    {
        $build = static::getBuildVersion();

        return static::getMinorVersion() . (!empty($build) ? '.' . $build : '');
    }

    /**
     * Return true if module is 'system module' and admin cannot disable/uninstall and view this module in the modules list
     *
     * @return boolean
     */
    public function isSystem()
    {
        return false;
    }

    /**
     * Check - module required disabled+redeploy+uninstall (true) or deploy+uninstall (false)
     *
     * @return boolean
     */
    public function isSeparateUninstall()
    {
        return false;
    }

    /**
     * Check if module can be disabled
     *
     * @return boolean
     */
    public function canDisable()
    {
        return true;
    }
} 
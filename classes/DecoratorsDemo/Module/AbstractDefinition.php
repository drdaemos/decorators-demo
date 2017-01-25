<?php

namespace DecoratorsDemo\Module;

interface DefinitionInterface {
    
    /**
     * Method to initialize concrete module instance
     *
     * @return void
     */
    public function init();

    /**
     * Method to call just before the module is uninstalled (totally remove) via core
     *
     * @return void
     */
    public function callUninstallEvent();

    /**
     * Method to call just before the module is disabled via core
     *
     * @return void
     */
    public function callDisableEvent();

    /**
     * Method to call just after the module is installed
     *
     * @return void
     */
    public function callInstallEvent();

    /**
     * Return module name
     *
     * @return string
     */
    public function getModuleName();

    /**
     * Return author full name
     *
     * @return string
     */
    public function getAuthorName();

    /**
     * Return module description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Return module dependencies
     *
     * @return array
     */
    public function getDependencies();

    /**
     * Return list of mutually exclusive modules
     *
     * @return array
     */
    public function getMutualModulesList();

    /**
     * Get module major version
     *
     * @return string
     */
    public function getMajorVersion();

    /**
     * Get minor core version which is required for the module activation
     *
     * @return string
     */
    public function getMinorRequiredCoreVersion();

    /**
     * Get module minor version
     *
     * @return string
     */
    public function getMinorVersion();

    /**
     * Get module build number (4th number in the version)
     *
     * @return string
     */
    public function getBuildVersion();

    /**
     * Get module version
     *
     * @return string
     */
    public function getVersion();

    /**
     * Get module version
     *
     * @return string
     */
    public function getFullMinorVersion();

    /**
     * Return true if module is 'system module' and admin cannot disable/uninstall and view this module in the modules list
     *
     * @return boolean
     */
    public function isSystem();

    /**
     * Check - module required disabled+redeploy+uninstall (true) or deploy+uninstall (false)
     *
     * @return boolean
     */
    public function isSeparateUninstall();

    /**
     * Check if module can be disabled
     *
     * @return boolean
     */
    public function canDisable();
}
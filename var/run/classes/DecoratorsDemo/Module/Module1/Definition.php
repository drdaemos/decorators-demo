<?php

namespace DecoratorsDemo\Module\Module1;

class Definition extends \Includes\Module\AbstractDefinition {
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
        return '1';
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
} 
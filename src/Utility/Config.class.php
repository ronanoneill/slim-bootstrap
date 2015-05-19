<?php
/**
 * Configuration, used to load settings from an ini file.
 *
 * PHP version 5.3
 *
 * @category  Utility
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */

namespace Utility;

/**
 * Configuration builds an object that holds the information from
 * an ini file.
 *
 * @category  Utility
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */
class Config
{
    /**
     * Loaded settings from ini configs
     *
     * @var array
     */
    private static $_settings = array();

    /**
     * Loaded config files
     *
     * @var array
     */
    private static $_loadedFiles = array();

    /**
     * Load an ini file
     *
     * @param  type $fileName The name of the ini file
     * @return bool
     */
    public static function loadFromIni($fileName) {
        $fileName = self::_buildFullPathToIniFile($fileName);
        // Check if we've already loaded the config file
        if (array_key_exists($fileName, self::$_loadedFiles)) {
            return true;
        }
        // Ensure the provided filename is a valid, readable file
        if (is_readable($fileName)) {
            $configFileArray = parse_ini_file($fileName, true);
            self::$_settings = array_merge(self::$_settings, $configFileArray);
            self::$_loadedFiles[$fileName] = $configFileArray;
            return true;
        }
        return false;
    }

    /**
     * Build the full path to ini file in the config folder
     *
     * @param  string $fileName The ini file name
     * @return string
     */
    private static function _buildFullPathToIniFile($fileName) {
        return __DIR__ . '/../../config/' . $fileName . '.ini';
    }

    /**
     * Get the setting for a specific key
     *
     * @param  type $key     The key for the setting
     * @param  type $default Override the default setting of null
     * @return      $default The setting or the default setting
     */
    public static function getSetting($key, $default = null) {
        return (isset(self::$_settings[$key]) ? self::$_settings[$key] : $default);
    }
}
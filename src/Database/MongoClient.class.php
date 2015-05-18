<?php
/**
 * MongoDB Client
 *
 * @category  Database
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */

namespace Database;

/**
 * MongoDB Client
 *
 * @category  Database
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */
class MongoClient
{

    /**
     * A MongoDB connection to the master DB.
     *
     * @var object MongoDB
     */
    private $_mongoConn = NULL;

    /**
     * Establish a new connection to the MongoDB server if it doesn't exist
     * already.
     *
     * @return MongoClient Connection to the MongoDB server.
     */
    public function getConnection() {
        try {
            // Define the connection string
            if (empty($connectString = self::_getConnectionString())) {
                throw new Exception("MongoDB params are invalid.");
            }
            // Connect MongoDB and select required DB
            $mongo = new MongoClient($connectString['connection']);
            $db = $mongo->selectDB($connectString['db']);
            return $db;
        }
        catch (MongoConnectionException $e) {
            notice("MongoConnectionException: " . $e->getMessage());
        }
        catch (Exception $e) {
            notice($e->getMessage());
        }

        return null;
    }

    /**
     * Get the connection string for MongoClient class
     *
     * @return array The connection detail
     */
    private static function _getConnectionString()
    {
        $params = self::_getMongoDBSettings();
        return array(
            "connection" => "mongodb://{$params['username']}:{$params['password']}@" .
                "{$params['host']}:{$params['port']}/{$params['database']}",
            "db" => $params['database']
        );
    }

    /**
     * Get the MongoDB setting details
     *
     * @return array The MongoDB setting details
     */
    private static function _getMongoDBSettings()
    {
         // Load the database ini config
        $config = new \Utility\Config();
        $config::loadFromIni("database");

        // Return formatted connection params
        $params = array(
            'host' => $config::getSetting("mongodb-hostname"),
            'port' => $config::getSetting("mongodb-port"),
            'database' => $config::getSetting("mongodb-database"),
            'username' => $config::getSetting("mongodb-username"),
            'password' => $config::getSetting("mongodb-password")
        );

        return $params;
    }
}

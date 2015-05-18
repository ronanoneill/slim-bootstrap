<?php
/**
 * PDO Client
 *
 * @category  Database
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */

namespace Database;

/**
 * PDO Client
 *
 * @category  Database
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */
class PDOClient
{

    /**
     * A PDO connection to the master DB.
     *
     * @var object PDO
     */
    private $_mysqlConn = NULL;

    /**
     * Prepare a new master statement. Use for all write operations and read
     * operations that are time-critical.
     *
     * @param  string           $sql SQL statement to prepare.
     * @return PDO\PDOStatement Prepared master statement ready to have values binded.
     */
    public function prepareStatement($sql) {
        return $this->_getConnection()->prepare($sql);
    }

    /**
     * Establish a new connection to the master DB server if it doesn't exist already.
     *
     * @return PDO Connection to the master DB server.
     */
    private function _getConnection() {
        if (is_null($this->_mysqlConn)) {
            $this->_mysqlConn = $this->_getDatabaseConnection(
                $this->_getConnectionParamters()
            );
        }
        return $this->_mysqlConn;
    }

    /**
     * Build an array of connection parameters based on the database credentials
     * returned from the Adverts configuration. The parameters will be different
     * depending on whether we selected a master or a slave.
     *
     * @return array Connection details for PDO to connect.
     */
    private function _getConnectionParamters() {
        // Load the database ini config
        $config = new \Utility\Config();
        $config::loadFromIni("database");

        // Return formatted connection params
        return array(
            'host' => $config::getSetting("mysql-hostname"),
            'dbname' => $config::getSetting("mysql-database"),
            'user' => $config::getSetting("mysql-username"),
            'pass' => $config::getSetting("mysql-password"),
            'charset' => $config::getSetting("mysql-charset")
        );
    }

    /**
     * Create a new instance of PDO using the provided connection paramaters
     *
     * @param  array  $connParams Connection params from Adverts config.
     * @return object                       PDO connection to the required database.
     */
    private function _getDatabaseConnection($connParams)
    {
        return new \PDO(
            "mysql:host={$connParams['host']};dbname={$connParams['dbname']};charset={$connParams['charset']}",
            $connParams['user'],
            $connParams['pass'],
            array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_PERSISTENT => false
            )
        );
    }
}

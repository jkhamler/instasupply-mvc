<?php


/**
 * This class is responsible for setting up the PDO database connection.
 *
 * Class Db
 */
class Db
{
    private static $instance = NULL;

    /**
     * We require one instance of the PDO class to available globally in the project
     *
     * @return null|PDO
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO(
                'mysql:host=localhost;dbname=instasupply',
                'root',
                'root',
                $pdo_options);
        }
        return self::$instance;
    }
}

?>
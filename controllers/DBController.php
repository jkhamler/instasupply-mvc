<?php

require 'User.php';

/**
 * This class is responsible for establishing a connection to the MySQL database and querying/retrieving/persisting
 * data
 *
 * Created by PhpStorm.
 * User: jonathanhamler
 * Date: 25/01/2017
 * Time: 11:15
 */
class DBController
{
    // Global DB connection parameters - please define these once here:
    const SERVER_NAME = 'localhost';
    const DATABASE_NAME = 'instasupply';
    const USER_NAME = 'root';
    const PASSWORD = 'root';

    /** @var PDO $pdoConnection - Responsible for querying the MySQL database */
    public $pdoConnection;

    function __construct()
    {
        $this->setupDBConnection();
    }

    /**
     * Queries Database and retrieves array of User models
     *
     * @return User[]
     */
    public function retrieveUsers()
    {
        $userModels = [];

        $pdoConnection = $this->pdoConnection;

        foreach ($pdoConnection->query('SELECT * FROM users') as $userDataRow) {

            $user = new User();

            $user->id = $userDataRow['id'];
            $user->email = $userDataRow['email'];
            $user->password = $userDataRow['password'];
            $user->name = $userDataRow['name'];
            $user->dateOfBirth = new DateTime($userDataRow['date_of_birth']);

            $userModels[] = $user;
        }

        return $userModels;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function persistUser(User $user)
    {
        $pdoConnection = $this->pdoConnection;
        $dateOfBirth = $user->dateOfBirth;

        $sql = "INSERT INTO users (email, password, name, date_of_birth)
        VALUES ('" . $user->email . "','" . $user->password . "','" . $user->name . "','" . $dateOfBirth->format('Y-m-d') . "')";
        if ($pdoConnection->query($sql)) {
            return true;
        }

        return false;
    }

    /**
     * @param $emailAddress
     * @return User|null
     */
    public function getUserByEmailAddress($emailAddress)
    {
        $pdoConnection = $this->pdoConnection;

        $statement = $pdoConnection->prepare("select * from users where email = :email");
        $statement->execute(array(':email' => $emailAddress));
        $existingUser = $statement->fetchObject(User);

        return $existingUser;
    }

    /**
     * Sets up the PDO DB connection
     */
    private function setupDBConnection()
    {
        $serverName = self::SERVER_NAME;
        $userName = self::USER_NAME;
        $password = self::PASSWORD;
        $databaseName = self::DATABASE_NAME;

        try {
            $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdoConnection = $conn;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
<?php

/**
 * User Data Model
 *
 * Class User
 */
class User
{
    // We define our model properties
    // they are public so that we can access them directly e.g. $user->name

    public $id;
    public $name;
    public $email;
    public $password;
    public $dateOfBirth;

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $password
     * @param DateTime $dateOfBirth
     */
    public function __construct($id = null, $name, $email, $password, DateTime $dateOfBirth)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return User[]
     */
    public static function all()
    {
        $userModels = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM users');

        // we create a list of User objects from the database results
        foreach ($req->fetchAll() as $userData) {

            $dateOfBirth = new DateTime($userData['date_of_birth']);

            $userModels[] = new User(
                $userData['id'],
                $userData['name'],
                $userData['email'],
                $userData['password'],
                $dateOfBirth
            );
        }

        return $userModels;
    }

    /**
     * A method to check the existence of a user with a given email address
     *
     * @param $email
     * @return bool
     */
    public static function userExistsWithEmail($email)
    {
        $db = Db::getInstance();
        // we make sure $email is a string
        $email = strval($email);
        $req = $db->prepare('SELECT id FROM users WHERE email = :email');
        // the query was prepared, now we replace :email with our actual $email value
        $req->execute(array('email' => $email));

        $userData = $req->fetch();

        return is_array($userData);
    }

    /**
     * We save the data to the DB
     *
     * @return bool
     */
    public function persist()
    {
        $saveSuccess = false;

        $pdoConnection = Db::getInstance();
        $dateOfBirth = $this->dateOfBirth;

        $sql = "INSERT INTO users (email, password, name, date_of_birth)
        VALUES ('" . $this->email . "','" . $this->password . "','" . $this->name . "','" . $dateOfBirth->format('Y-m-d') . "')";
        if ($pdoConnection->query($sql)) {
            $saveSuccess = true;
        }

        return $saveSuccess;

    }
}

?>
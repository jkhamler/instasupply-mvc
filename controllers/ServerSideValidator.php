<?php

/**
 * Created by PhpStorm.
 * User: jonathanhamler
 * Date: 25/01/2017
 * Time: 12:00
 */
class ServerSideValidator
{
    /** @var array $post */
    public $post;

    /**
     * This method validates the post server-side according to the following criteria:
     *
     * Does the password appear on a blacklist?
     * Is the email address already taken?
     *
     * @param array $post
     * @return array
     */
    public function getValidationErrors($post)
    {

        $validationErrors = [];

        $email = trim($post['email']);
        $password = trim($post['password']);

        if ($this->isPasswordBlacklisted($password)) {
            $validationErrors[] = 'This password is blacklisted. Please choose another.';
        }

        if ($this->isEmailAddressAlreadyTaken($email)) {
            $validationErrors[] = "This email address ($email) is already taken. Please choose another.";
        }

        return $validationErrors;

    }

    /**
     * Checks a given password against contents of the included text file 'password-blacklist.txt'
     *
     * @param $password
     * @return bool
     */
    private function isPasswordBlacklisted($password)
    {
        $handle = fopen("./Resources/password-blacklist.txt", "r");

        if ($handle) {
            while (($line = fgets($handle)) !== false) {

                if (trim($line) == trim($password)) {
                    return true;
                }
            }

            fclose($handle);
        } else {
            // error opening the file.
        }
        return false;
    }

    /**
     * Checks to see if a record with this email address already exists on the server
     *
     * @param $emailAddress
     * @return bool
     */
    private function isEmailAddressAlreadyTaken($emailAddress)
    {
        $existingUser = User::userExistsWithEmail($emailAddress);

        if ($existingUser instanceof User) {

            return true;
        }

        return false;
    }


}
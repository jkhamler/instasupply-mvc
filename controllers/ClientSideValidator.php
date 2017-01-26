<?php

/**
 * This class is responsible for conducting client side validation when submitting POST data via a form.
 *
 * Created by PhpStorm.
 * User: jonathanhamler
 * Date: 25/01/2017
 * Time: 12:00
 */
class ClientSideValidator
{
    /** @var array $post */
    public $post;

    /**
     * This method validates the post client-side according to the following criteria:
     *
     * Are all fields populated?
     * Is the email address in a valid format?
     * Does the password entered match the confirm password?
     * Is date of birth valid? (i.e. in the past)
     *
     * @param array $post
     * @return array
     */
    public function getValidationErrors($post)
    {
        $validationErrors = [];

        $email = trim($post['email']);
        $password = trim($post['password']);
        $confirmPassword = trim($post['confirm_password']);
        $name = trim($post['name']);
        $dateOfBirth = new DateTime($post['date_of_birth']);
        $now = new DateTime();

        if (!$this->isValidEmail($email)) {
            $validationErrors[] = 'Please provide a valid email address.';
        }

        if ($dateOfBirth->getTimestamp() > $now->getTimestamp()) {
            $validationErrors[] = 'Please provide a valid date of birth.';
        }

        if ($name == '') {
            $validationErrors[] = 'Please provide a valid name.';
        }

        if ($password !== $confirmPassword || $password == '' || $confirmPassword == '') {
            $validationErrors[] = 'Please ensure password and confirm password match.';
        }

        return $validationErrors;
    }

    /**
     * Tests if the email address provided is valid
     *
     * @param $email
     * @return bool
     */
    private function isValidEmail($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL));
    }

}
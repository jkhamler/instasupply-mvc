<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="./Assets/bootstrap.css">
</head>
<body>

<h1>User Registration</h1>

<?

require './controllers/ClientSideValidator.php';
require './controllers/ServerSideValidator.php';

$clientSideValidator = new ClientSideValidator();

if ($_POST['submit_button']) { // has the submit button been clicked?F

    $validationErrors = false; // we assume the post is valid until proven otherwise
    $clientSideValidationErrors = $clientSideValidator->getValidationErrors($_POST);

    if (sizeof($clientSideValidationErrors) == 0) {
        // No input validation errors, so we check server side.
        $serverSideValidator = new ServerSideValidator();
        $serverSideValidationErrors = $serverSideValidator->getValidationErrors($_POST);

        if (sizeof($serverSideValidationErrors) > 0) {
            $validationErrors = true;
            $serverErrorString = implode(' ', $serverSideValidationErrors);
            echo "<script type= 'text/javascript'>alert('$serverErrorString');</script>";
        }

    } else {
        $validationErrors = true;
        $clientErrorString = implode(' ', $clientSideValidationErrors);
        echo "<script type= 'text/javascript'>alert('$clientErrorString');</script>";
    }

    if ($validationErrors == false) { // if no validation errors, persist User model to the DB.

        $user = new User(
            null,
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            new DateTime($_POST['date_of_birth'])
        );

        if ($user->persist()) {
            echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
        }
    }
}

?>

<table style="margin: 25px">
    <tr>
        <td>
            <form action="" method="post">
                <div>
                    <table class="table">
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" placeholder="Email"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" placeholder="Password"></td>
                        </tr>
                        <tr>
                            <td>Confirm password</td>
                            <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" placeholder="Name"></td>
                        </tr>
                        <tr>
                            <td>Date of birth</td>
                            <td><input type="date" name="date_of_birth"
                                       value="<?php echo date('Y-m-d'); ?>"></td>
                        </tr>
                    </table>
                </div>
                <input type="submit" value="Register" name="submit_button">
            </form>
        </td>
        <td>
            <blockquote>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum.
            </blockquote>
        </td>
    </tr>
</table>

</body>
</html>
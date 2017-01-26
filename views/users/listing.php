<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="./Assets/bootstrap.css">
</head>
<body>

<h1>User List</h1>

<div>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Date of Birth</th>
        </tr>

        <?
        /** @var User[] $users */

        foreach ($users as $user) {
            echo '<tr>';
            echo '<th>' . $user->name . "</th>";
            echo '<th>' . $user->email . "</th>";
            echo '<th>' . $user->dateOfBirth->format('d/m/Y') . "</th>";
            echo '</tr>';
        }
        ?>

    </table>
</div>

</body>
</html>
<?php

require "dbBroker.php";
require "model/user.php";

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $id = 1;

    if (strlen($name) < 3 && strlen($pass) < 3) {
        exit();
    }

    $user = new User($id, $name, $pass);
    //$result = $user->logIn($user, $conn);
    $result = User::logIn($user, $conn);

    echo json_encode($result->num_rows);
    echo json_encode($_POST['username'] . " " . $_POST['password']);

    if ($result->num_rows == 1) {
        $_SESSION['user_id'] = $id;
        header('Location: home.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>FON: Zakazivanje kolokvijuma</title>

</head>

<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <label class="username">Korisnicko ime</label>
                    <input type="text" name="username" class="form-control" required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>


    </div>
</body>

</html>
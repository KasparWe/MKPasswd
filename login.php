<?php
session_start();
$pdo = new PDO('mysql:host=pfx-hosting.de;dbname=passwd', 'passwd', '33Hrm~9g');

if (isset($_GET['login'])) {
    $username = $_POST['username'];
    $passwort = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $username = $statement->fetch();

    //Überprüfung des Passworts
    if ($username !== false && password_verify($passwort, $username['passwort'])) {
        $_SESSION['username'] = $username['username'];
        die('<meta http-equiv=\'refresh\' content=\'0; URL=/index.php\'>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

}
?>

<?php
if (isset($errorMessage)) {
    echo $errorMessage;
}
?>


<?php include "includes/head.php" ?> <!-- includes head data -->
<?php include "includes/nav.php" ?> <!-- includes navbar -->


<body>

<!-- Start your project here-->
<div style="height: 100vh">
    <div class="flex-center flex-column">

        <div class="container">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <form class="text-center border border-light p-5" action="?login=1" method="post">
                        <div class="form-group">
                            <label for="ServiceName">Username</label>
                            <input type="text" required class="form-control" id="ServiceName" name="username"
                                   aria-describedby="ServiceName" placeholder="Enter service name">
                        </div>
                        <div class="form-group">
                            <label for="Username">Passwod</label>
                            <input required type="password" class="form-control" id="password" placeholder="password"
                                   name="password">
                        </div>

                        <button type="submit" value="click" name="submit" class="btn btn-primary">login</button>
                    </form
                </div>
                <p style="color: red"><?php
                    if (isset($errorMessage)) {
                        echo $errorMessage;
                    }
                    ?></p>
            </div>

        </div>
    </div>
</div>

<?php include "includes/footer.php" ?> <!-- includes footer -->

</body>

<?php include "includes/scripts.php" ?> <!-- includes scripts -->

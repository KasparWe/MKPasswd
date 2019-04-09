<?php session_start();
?>

<?php
if (!isset($_SESSION['username'])) {
    die('echo "<meta http-equiv=\'refresh\' content=\'0; URL=/login.php\'>";
');
}

//Abfrage der Nutzer ID vom Login
$username = $_SESSION['username'];

?>

<?php include "includes/head.php" ?> <!-- includes head data -->
<?php include "includes/nav.php" ?> <!-- includes navbar -->
<?php include "includes/functions/actions.php" ?> <!-- includes actions -->

<body>

<!-- Start your project here-->
<div style="height: 100vh">
    <div class="flex-center flex-column">

        <div class="container">
            <div class="row">
                <div class="col-md-8"><?php include "includes/list.php" ?></div>
                <div class="col-md-4">
                    <div class="cold-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add a password</h5>
                                <form method="post" action="index.php">
                                    <div class="form-group">
                                        <label for="ServiceName">Service Name</label>
                                        <input type="text" required class="form-control" id="ServiceName"
                                               name="ServiceName" aria-describedby="ServiceName"
                                               placeholder="Enter service name">
                                    </div>
                                    <div class="form-group">
                                        <label for="Username">Username</label>
                                        <input type="text" class="form-control" id="Username" name="Username" required
                                               aria-describedby="Userame" placeholder="Enter userame">
                                    </div>

                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input required type="password" class="form-control" id="Password"
                                               placeholder="Password" name="Password">
                                        <small id="PaswordHelp" class="form-text text-muted">We'll never share your
                                            password with anyone else.
                                        </small>

                                    </div>
                                    <div class="form-group">
                                        <label for="LinkService">Link to Service</label>
                                        <input type="text" class="form-control" id="LinkService"
                                               aria-describedby="ServiceLink" name="LinkService"
                                               placeholder="Enter service link">
                                    </div>
                                    <button type="submit" value="click" name="submit" class="btn btn-primary">Add
                                        Password
                                    </button>
                                </form
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?> <!-- includes footer -->

</body>

<?php include "includes/scripts.php" ?> <!-- includes scripts -->
<?php


if (isset($_POST['submit'])) {
    $service = $_POST['ServiceName'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $Link = $_POST['LinkService'];
    $_POST['return'];


    addPaswd($service, $username, $password, $Link);

    echo "\n";

    echo "<meta http-equiv='refresh' content='0; URL=http://localhost:8080/index.php'>";


    die;


}


?>

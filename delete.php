<?php
session_start();
if (!isset($_SESSION['username'])) {
    die('echo "<meta http-equiv=\'refresh\' content=\'0; URL=/login.php\'>";
');
}

//Abfrage der Nutzer ID vom Login
$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
    deletePasswd($_GET['name']);
}

?>

<?php include "includes/functions/actions.php" ?> <!-- includes actions -->



<?php include "includes/head.php" ?> <!-- includes head data -->
<?php include "includes/nav.php" ?> <!-- includes navbar -->

<body>

<!-- Start your project here-->
<div style="height: 100vh">
    <div class="flex-center flex-column">

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Delete <? echo $_GET['name'] ?></h5>
                    <p>Do you really want to delete this position?</p>
                    <form class="text-center border border-light p-5" action="" method="post">
                        <button type="button" class="btn btn-primary">chancel</button>
                        <button type="submit" value="click" name="submit" class="btn btn-danger">delete</button>
                    </form
                </div>

            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?> <!-- includes footer -->

</body>


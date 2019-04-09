<?php include "includes/head.php" ?> <!-- includes head data -->
<?php include "includes/nav.php" ?> <!-- includes navbar -->

<?php
session_start();
$pdo = new PDO('mysql:host=pfx-hosting.de;dbname=passwd', 'passwd', '33Hrm~9g');
?>
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $error = false;
    $username = $_POST['email'];
    $passwort = $_POST['password1'];
    $passwort2 = $_POST['password2'];

    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $username = $statement->fetch();

        if($username !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO users (username, passwort) VALUES (:userame, :passwort)");
        $result = $statement->execute(array('username' => $username, 'passwort' => $passwort_hash));

        if($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}


?>



<body>

<!-- Start your project here-->
<div style="height: 100vh">
    <div class="flex-center flex-column">

        <div class="container">
           <?php if($showFormular) {
    ?>
               <div class="card">
                   <div class="card-body">
                       <h5 class="card-title">Add a user</h5>
                       <form action="?register=1" method="post">
                           <div class="form-group">
                               <label for="ServiceName">Username</label>
                               <input type="text" required class="form-control" id="ServiceName" name="username" aria-describedby="ServiceName" placeholder="Enter service name">
                           </div>
                           <div class="form-group">
                               <label for="Username">Passwod</label>
                               <input required type="password" class="form-control" id="password1" placeholder="password1" name="password1">
                           </div>

                           <div class="form-group">
                               <label for="Password">Password again</label>
                               <input required type="password" class="form-control" id="password2" placeholder="password2" name="password2">
                               <small id="PaswordHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>

                           </div>
                           <button type="submit" value="click" name="submit" class="btn btn-primary">Add user</button>
                       </form
                   </div>
               </div>

<?php
} //Ende von if($showFormular) ?>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?> <!-- includes footer -->

</body>

<?php include "includes/scripts.php" ?> <!-- includes scripts -->

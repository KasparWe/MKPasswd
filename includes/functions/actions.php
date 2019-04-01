<?php
include "".__DIR__."../db.php";
function addPaswd($service, $username, $password, $Link, $db) {

    echo '<script type="text/javascript">alert("' . $service . '")</script>';

    $statement = $db->prepare("INSERT INTO password (service_name, user_name, password, url) VALUES (?, ?, ?, ?)");
    $statement->execute(array($service, $username, $password, $Link));

}
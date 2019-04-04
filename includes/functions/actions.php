<?php
//include "".__DIR__."/../db.php";


function addPaswd($service, $username, $password, $link)
{
    try {
        $db = new PDO("sqlite:data.db");
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    } catch (Exception $e) {
        echo 'Exception abgefangen: ', $e->getMessage(), "\n";
        die;
    }

    $data = [
        'service' => $service,
        'username' => $username,
        'password' => $password,
        'link' => $link
    ];
    $sql = "INSERT INTO password (service_name, user_name, password, url) VALUES (:service, :username, :password, :link)";
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
}
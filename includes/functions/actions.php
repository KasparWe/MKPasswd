<?php
//include "".__DIR__."/../db.php";


function addPaswd($service, $username, $password, $link)
{
    try {
        $db = new PDO('mysql:host=pfx-hosting.de;dbname=passwd', 'passwd', '33Hrm~9g');
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

function setKey()
{
    $key = openssl_random_pseudo_bytes(32);
    return $key;
}

function getPassword($username, $service)
{
    $db = new PDO('mysql:host=pfx-hosting.de;dbname=passwd', 'passwd', '33Hrm~9g');
  $stmt = $db->prepare("SELECT password FROM password WHERE user_name='$username' AND service_name='$service'");
  $encrypted_password = execute($stmt);
  $db->NULL;
  return $encrypted_password;
}

function encryptPasswd($username, $password)
{
    $cipher_method = 'aes-256-ctr';
    $enc_key = getKey($username);
    $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
    $crypted_password = openssl_encrypt($password, $cipher_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
    unset($token, $cipher_method, $enc_key, $enc_iv);
    return $crypted_password;
}

function decryptPasswd($username, $service)
{
    $crypted_password = getPassword($username, $service);
    list($crypted_password_no_iv, $enc_iv) = explode("::", $crypted_password);;
    $cipher_method = 'aes-256-ctr';
    $enc_key = getKey($username);
    $password = openssl_decrypt($crypted_password_no_iv, $cipher_method, $enc_key, 0, hex2bin($enc_iv));
    unset($crypted_password, $cipher_method, $enc_key, $enc_iv);
    return $password;
}



function listPasswd()
{
    try {
        $db = new PDO('mysql:host=pfx-hosting.de;dbname=passwd', 'passwd', '33Hrm~9g');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        echo 'Exception abgefangen: ', $e->getMessage(), "\n";
        die;
    }

    $sth = $db->prepare("SELECT * FROM password");
    $sth->execute();
    while ($row = $sth->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $row['service_name']; ?></td>
            <td><a class="copy" data-clipboard-text="<?php echo $row['user_name']; ?>"><?php echo $row['user_name']; ?></a></td>
                <td><a class="copy" data-clipboard-text="<?php echo $row['password']; ?>"><?php echo $row['password']; ?></a></td>
            <td><?php echo $row['url']; ?></td>
            <td><a href="/delete.php?name=<?php echo $row['service_name'] ?>"><strong>delete</strong></a> - <a><strong>update</strong></a></td>
        </tr>
    <?php }
}



function deletePasswd($service)
{
    try {
        $db = new PDO('mysql:host=pfx-hosting.de;dbname=passwd', 'passwd', '33Hrm~9g');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        echo 'Exception abgefangen: ', $e->getMessage(), "\n";
        die;
    }

    $sth = $db->prepare("DELETE FROM password WHERE service_name = ?");
    $sth->execute(array($service));

    echo "<meta http-equiv='refresh' content='0; URL=/index.php'>";
}
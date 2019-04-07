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

    $encrypted_password = encryptPasswd($username, $password);

    $data = [
        'service' => $service,
        'username' => $username,
        'password' => $encrypted_password,
        'link' => $link
    ];
    $sql = "INSERT INTO password (service_name, user_name, password, url) VALUES (:service, :username, :encrypted_password, :link)";
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    $db->NULL;
}

function addUser($username, $password, $key)
{
  try {
      $db = new PDO("sqlite:data.db");
      $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  } catch (Exception $e) {
      echo 'Exception abgefangen: ', $e->getMessage(), "\n";
      die;
  }

  $key = setKey();

  $data = [
      'key' => $key,
      'username' => $username,
      'password' => $password,
  ];
  $sql = "INSERT INTO users (user_name, password, enc_key) VALUES (:username, :password, :key)";
  $stmt = $db->prepare($sql);
  $stmt->execute($data);
  $db->NULL;
}

function getKey($username)
{
    $db = new PDO("sqlite:data.db");
    $stmt = $db->prepare("SELECT key FROM users WHERE user_name='$username'");
    $key = execute($stmt);
    $db->NULL;
    return $key;
}

function setKey()
{
    $key = openssl_random_pseudo_bytes(32);
    return $key;
}

function getPassword($username, $service)
{
  $db = new PDO("sqlite:data.db");
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
}

function decryptPasswd($username, $service)
{
    $crypted_password = getPassword($username, $service);
    list($crypted_password_no_iv, $enc_iv) = explode("::", $crypted_password);;
    $cipher_method = 'aes-256-ctr';
    $enc_key = getKey($username)
    $password = openssl_decrypt($crypted_password_no_iv, $cipher_method, $enc_key, 0, hex2bin($enc_iv));
    unset($crypted_password, $cipher_method, $enc_key, $enc_iv);
    return $password;
}

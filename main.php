<?php
//if (isset($_POST['submit'])){
    echo "Called";
/* Attempt MySQL server connection. Assuming
you are running MySQL server with default
setting (user 'root' with no password) */
$link = mysqli_connect("localhost",
			"id20561214_vasanth", "G+T)y1j@ADT7*?Xk", "id20561214_passwordmanager");

// Check connection
if($link === false){
    echo "Not connected";
	die("ERROR: Could not connect. "
		. mysqli_connect_error());
}
else{
    echo "Connected";
}
    if (!preg_match("/^(https?:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/", $_POST['wname'])) {
        echo "Invalid website name";
        exit;
    }
    // Check if password is valid
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/", $_POST['pword'])) {
        echo "Invalid password";
        exit;
    }

// Escape user inputs for security
$wn=$_REQUEST['wname'];
$pwd =$_REQUEST['pword'];
// $wn= mysqli_real_escape_string(
 //	$link, $_REQUEST['uname']);
// $m = mysqli_real_escape_string(
// 	$link, $_REQUEST['msg']);
// date_default_timezone_set('Asia/Kolkata');
// $ts=date('y-m-d h:ia');
$key = openssl_random_pseudo_bytes(32);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher = "AES-256-CBC"));

    // Encrypt the password using AES-256-CBC
    $encrypted_pwd = openssl_encrypt($pwd, $cipher, $key, $options = 0, $iv);

    // Convert the key and IV to hexadecimal strings for storage in the database
    $key_hex = bin2hex($key);
    $iv_hex = bin2hex($iv);

// Attempt insert query execution
$sql = "INSERT INTO Encryption (URLName, Password,EncryptionKey,vector)
		VALUES ('" . $wn . "','" . $encrypted_pwd . "','" . $key_hex ."','" . $iv_hex ."')";
if(mysqli_query($link, $sql)){
     echo "Saved";
} else{
	echo "ERROR: Message not sent!!!";
}
// Close connection
mysqli_close($link);
//}
?>
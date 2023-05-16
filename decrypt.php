<?php
	// Attempt MySQL server connection. Assuming you are running MySQL server with default
	// setting (user 'root' with no password)
	$link = mysqli_connect("localhost", "id20561214_vasanth", "G+T)y1j@ADT7*?Xk", "id20561214_passwordmanager");

	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	// Retrieve the encrypted password, encryption key, IV and URL name from the database
	$sql = "SELECT Password, EncryptionKey, vector, URLName FROM Encryption ORDER BY ID DESC LIMIT 1"; // replace 'example.com' with the actual website name
	$result = mysqli_query($link, $sql);
	if($result === false){
		die("ERROR: Could not execute query. " . mysqli_error($link));
	}


	// Check if a matching record was found
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);


		// Convert the hexadecimal key and IV strings back to binary
		$key = hex2bin($row['EncryptionKey']);
		$iv = hex2bin($row['vector']);


		// Decrypt the password using AES-256-CBC
		$cipher = "AES-256-CBC";
		$decrypted_pwd = openssl_decrypt($row['Password'], $cipher, $key, 0, $iv);

		// Print the decrypted password and URL name
		echo "Decrypted Password: " . $decrypted_pwd . "<br>";
		echo "URL Name: " . $row['URLName'];

	} else {
		echo "No matching record found.";

	}

	// Close connection
	mysqli_close($link);
?>
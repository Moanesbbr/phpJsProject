<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$f_name = htmlspecialchars($_POST["f_name"]);
	$l_name = htmlspecialchars($_POST["l_name"]);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$repassword = htmlspecialchars($_POST['repassword']);
	$mobile = htmlspecialchars($_POST['mobile']);
	$address1 = htmlspecialchars($_POST['address1']);
	$address2 = htmlspecialchars($_POST['address2']);

	// Regular expressions for validation
	$namePattern = "/^[a-zA-Z ]+$/";
	$emailPattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$numberPattern = "/^[0-9]+$/";

	// Validation
	if (
		empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) ||
		empty($mobile) || empty($address1) || empty($address2)
	) {
		echo "<div class='alert'>Please fill all fields</div>";
		exit();
	} elseif (!preg_match($namePattern, $f_name)) {
		echo "<div class='alert'>Invalid first name</div>";
		exit();
	} elseif (!preg_match($namePattern, $l_name)) {
		echo "<div class='alert'>Invalid last name</div>";
		exit();
	} elseif (!preg_match($emailPattern, $email)) {
		echo "<div class='alert'>Invalid email</div>";
		exit();
	} elseif (strlen($password) < 9) {
		echo "<div class='alert'>Password is too short</div>";
		exit();
	} elseif ($password !== $repassword) {
		echo "<div class='alert'>Passwords do not match</div>";
		exit();
	} elseif (!preg_match($numberPattern, $mobile)) {
		echo "<div class='alert'>Invalid mobile number</div>";
		exit();
	} elseif (strlen($mobile) != 8) {
		echo "<div class='alert'>Mobile number must be 8 digits</div>";
		exit();
	}

	// Check if email already exists
	$stmt = $con->prepare("SELECT user_id FROM user_info WHERE email = ? LIMIT 1");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		echo "<div class='alert'>Email already exists</div>";
		exit();
	} else {
		// Hash the password before storing
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
		$stmt = $con->prepare("INSERT INTO user_info (first_name, last_name, email, password, mobile, address1, address2) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $f_name, $l_name, $email, $hashedPassword, $mobile, $address1, $address2);

		if ($stmt->execute()) {
			$_SESSION["uid"] = $stmt->insert_id;
			$_SESSION["name"] = $f_name;
			$ip_add = getenv("REMOTE_ADDR");
			$stmt = $con->prepare("UPDATE cart SET user_id = ? WHERE ip_add = ? AND user_id = -1");
			$stmt->bind_param("is", $_SESSION["uid"], $ip_add);
			$stmt->execute();

			echo "register_success";
			echo "<script> location.href='store.php'; </script>";
		} else {
			echo "<div class='alert'>Registration failed. Please try again.</div>";
		}
	}
	$stmt->close();
	$con->close();
}

<?php

$conn = new mysqli('localhost', 'root', '', 'task_app');

if ($conn->connect_error) {
	die('Not Connect to database');
} else {

	$firstName = $_POST["firstName"];
	$middleName = $_POST["middleName"];
	$lastName = $_POST["lastName"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$userPass = $_POST["password"];
	$position_id = $_POST["position_id"];


		$stmt = $conn->prepare('
			INSERT INTO users
			(
				firstName,
				middleName,
				lastName,
				phone,
				email,
				userPass,
				position_id
			)
			values
			(
				?,
				?,
				?,
				?,
				?,
				?,
				?
			);
		');

		$stmt->bind_param('ssssssi', $firstName, $middleName, $lastName, $phone, $email, $userPass, $position_id );
		$stmt->execute();
		//$insertId = $stmt->insert_id;

		$conn->close();
		//$record = readByID($insertId);

		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");

		http_response_code(200);
		echo json_encode(array());
	
}
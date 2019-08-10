<?php

$conn = new mysqli('localhost', 'root', '', 'task_app');

if ($conn->connect_error) {
	die('Not Connect to database');
} else {

	parse_str(file_get_contents("php://input"), $data);

	$id = $data["id"];
	$firstName = $data["firstName"];
	$middleName = $data["middleName"];
	$lastName = $data["lastName"];
	$phone = $data["phone"];
	$email = $data["email"];
	$userPass = $data["password"];
	$position_id = $data["position_id"];


		$stmt = $conn->prepare('
			UPDATE users set
				firstName = ?,
				middleName = ?,
				lastName = ?,
				phone = ?,
				email = ?,
				userPass = ?,
				position_id = ?
			WHERE id = ?
		');

		$stmt->bind_param('ssssssii', $firstName, $middleName, $lastName, $phone, $email, $userPass, $position_id, $id );
		$stmt->execute();
		$conn->close();

		$rows = $stmt->affected_rows;

		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");

		http_response_code(200);
		echo json_encode($rows);
	
}
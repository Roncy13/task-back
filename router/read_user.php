<?php

$conn = new mysqli('localhost', 'root', '', 'task_app');

if ($conn->connect_error) {
	die('Not Connect to database');
} else {
	$stmt = $conn->query("
		SELECT
			u.id,
			CONCAT_WS(' ', u.firstName, u.middleName, u.lastName) as fullName,
			u.phone,
			u.email,
			p.title
		from users as u 
		inner join position as p 
			on p.id = u.position_id
	");

	$userList = array();

	while($row = $stmt->fetch_assoc()) {
		$userList[] = $row;
	}

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	http_response_code(200);
	echo json_encode($userList);
}
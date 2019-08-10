<?php

$conn = new mysqli('localhost', 'root', '', 'task_app');

if ($conn->connect_error) {
	die('Not Connect to database');
} else {
	$stmt = $conn->prepare("
		SELECT
			*
		from users 
		where id = ?
	");

	$stmt->bind_param('i', $_GET["id"]);
	$stmt->execute();
	$queryRes = $stmt->get_result();

	$data = array();
		
		foreach($queryRes as $value) {
			$data = $value;
		}

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	http_response_code(200);
	echo json_encode($data);
}
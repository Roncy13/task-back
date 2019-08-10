<?php

$conn = new mysqli('localhost', 'root', '', 'task_app');

if ($conn->connect_error) {
	die('Not Connect to database');
} else {

	parse_str(file_get_contents("php://input"), $data);

	$id = $data["id"];

		$stmt = $conn->prepare('
			DELETE from users where id = ?
		');

		$stmt->bind_param('i', $id);
		$stmt->execute();
		$conn->close();

		$rows = $stmt->affected_rows;

		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");

		http_response_code(200);
		echo json_encode($rows);
	
}
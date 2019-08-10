<?php

// connect to database

// retrieve position rows 

// select id, title from position

$conn = new mysqli('localhost', 'root', '', 'task_app');

if ($conn->connect_error) {
	die('Not Connect to database');
} else {
	$result = $conn->query('SELECT id, title FROM position');
	
	$data = array();

	while($row = $result->fetch_assoc()) {
		$data[] = $row;
	}

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	http_response_code(200);
	echo json_encode($data);
}
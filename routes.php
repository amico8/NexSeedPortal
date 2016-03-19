<?php
	session_start();

	$params = explode('/', $_GET['url']);
	$resource = $params[0];
	$action = $params[1];
	$id = 0;
	$post = array();
	$files = '';
	$fileName = '';

	if (isset($params[2])) {
		$id = $params[2];
	}

	if (isset($_POST) && !empty($_POST)) {
		$post = $_POST;
	}

	require('controllers/'.$resource.'_controller.php');
?>
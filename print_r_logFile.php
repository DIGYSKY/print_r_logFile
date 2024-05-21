<?php

function print_r_logFile($data, $filename = 'log.txt', $delete_previous_log = false)
{
	$rewrite = $delete_previous_log ? 'w' : 'a';

	$file = fopen($filename, $rewrite);

	if ($file === false) {
		return false;
	}

	$dateTime = date("Y-m-d H:i:s");

	$dataString = is_array($data) || is_object($data) ? json_encode($data) : $data;

	$success = fwrite($file, "$dateTime : $dataString");

	fclose($file);

	if ($success === false) {
		return false;
	}

	return true;
}
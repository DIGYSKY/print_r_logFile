<?php

/**
 * Writes data to a log file in print_r format.
 *
 * This function opens a specified file and writes the provided data in print_r format to the end of the file.
 *
 * @param mixed $data The data to write to the file. Can be a string, array, or object.
 * @param string $filename The path of the file to write the data to. Default is 'log.txt'.
 * @param bool $delete_previous_log Indicates whether the previous content of the file should be deleted before writing new data. Default is false.
 * @param bool $print_date Indicates whether the date log.
 * @param string $separate_character Indicates whether the separate character.
 * @return bool Returns true if the data was successfully written, otherwise false.
 */
function print_r_logFile(
	mixed $data,
	string $filename = 'log.txt',
	bool $delete_previous_log = false,
	bool $print_date = true,
	string $separate_character = PHP_EOL
): bool {
	$rewrite = $delete_previous_log ? 'w' : 'a';

	$file = fopen($filename, $rewrite);

	if ($file === false) {
		return false;
	}

	$dateTime = date("Y-m-d H:i:s");

	$dataString = is_array($data) || is_object($data) ? json_encode($data) : $data;

	$date = $print_date ? "$dateTime (UTC +0):" : '';

	$success = fwrite($file, "$date $dataString" . $separate_character);

	fclose($file);

	if ($success === false) {
		return false;
	}

	return true;
}

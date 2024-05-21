<?php

require_once './print_r_logFile.php';

$user = [
	'name' => 'DIGYSKY',
	'email' => 'lilyan.chauveau@digysky.dev'
];

print_r_logFile($user, 'log_user.txt', true);


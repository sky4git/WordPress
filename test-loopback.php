<?php
// Echoes "PASS" if the loopback request succeeds, and "FAIL" otherwise

define('PARAM_NAME', 'self-request');
define('PASS_RESPONSE', 'true');
header('Content-type: text/plain');

if (isset($_GET[PARAM_NAME])) {
	print PASS_RESPONSE;
	exit;
}
else {
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?' . urlencode(PARAM_NAME) . '=1',
		CURLOPT_TIMEOUT => 5,
		CURLOPT_RETURNTRANSFER => true,
	));
	$response = curl_exec($ch);
	if ($response !== PASS_RESPONSE) {
		print "FAIL\n";
		print_r(curl_getinfo($ch));
	}
	else {
		print "PASS";
	}
	exit;
}

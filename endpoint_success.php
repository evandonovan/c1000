<?php

require_once 'lib.php';

$json_data = c1000_build_reply_json(C1000_STATUS_PASS);
// Set proper header - see http://stackoverflow.com/questions/4064444
header('Content-type: application/json;charset=utf-8');
echo $json_data; // already encoded by function

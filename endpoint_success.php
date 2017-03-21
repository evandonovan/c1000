<?php

$json_data = c1000_build_reply_json(C1000_STATUS_PASS);
$result = c1000_post_json($json_data, C1000_REDIRECT_ENDPOINT);

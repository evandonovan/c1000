<?php

// Conditions of success / failure
define('C1000_ACCESS_GRANTED', 1);
define('C1000_ERROR_ENDPOINT', -1);
define('C1000_ERROR_ANONYMOUS', 2);
define('C1000_ERROR_NO_COURSES', 3);

// URLs for redirection
define('C1000_ERROR_URL_ENDPOINT', 'local/c1000/error_endpoint.php');
define('C1000_ERROR_ANONYMOUS', 'local/c1000/error_anonymous.php');
define('C1000_ERROR_NO_COURSES', 'local/c1000/error_no_courses.php');

// courses to check for enrollment
define('C1000_COURSE_FF', '74');
define('C1000_COURSE_WL', '79');

// reply statuses from curtis1000 API
define('C1000_STATUS_PASS', 'Pass');
define('C1000_STATUS_FAIL', 'Fail');

<?php

// Main redirect page.

require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Redirecting...");
$PAGE->set_heading("Redirecting...");
$PAGE->set_url($CFG->wwwroot.'/local/c1000/redirect.php');

echo $OUTPUT->header();

global $USER;

$code = NULL;

// Check if user is anonymous.
// If so, end early.
if(c1000_is_anonymous()) {
  $code = C1000_ERROR_ANONYMOUS;
  c1000_redirect($code);
}

// Check if user is enrolled in either of the courses.
// If so, build the JSON, post it, and parse response.
if(c1000_check_course_enrollment(C1000_COURSE_FF) || c1000_check_course_enrollment(C1000_COURSE_WL)) {
  $json_data = c1000_build_json();
  $result = c1000_post_json($json_data, C1000_ENDPOINT_CURRENT);
  $response = c1000_parse_response($result);
  // Redirect based on response
  // Success has a URL returned
  if(!empty($response['url'])) {
    c1000_redirect($response['status'], $response['url']);
  }
  // Failure
  else {
    c1000_redirect($response['status']);
  }
}
// Redirect to no courses page
else {
  $code = C1000_ERROR_NO_COURSES;
  c1000_redirect($code);
}

echo $OUTPUT->footer();

?>

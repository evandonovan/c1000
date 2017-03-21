<?php

// Main redirect page.

require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Redirecting...");
$PAGE->set_heading("Redirecting...");
$PAGE->set_url($CFG->wwwroot.'/local/curtis100/redirect.php');

echo $OUTPUT->header();

global $USER;

$code = NULL;

// Check if user is anonymous.
if(c1000_is_anonymous()) {
  $code = C1000_ERROR_ANONYMOUS;
}

// Check if user is enrolled in either of the courses.
// If so, build the JSON, post it, and parse response.
if(c1000_check_course_enrollment(C1000_COURSE_FF) || c1000_check_course_enrollment(C1000_COURSE_WL)) {
  $json_data = c1000_build_json();
  $result = c1000_post_json($json_data, C1000_ENDPOINT_DEV);
  // TODO: See if parsing the response works properly with php://input
  // May need to work this out with them more.
  $response = c1000_parse_response();
  // Redirect based on response
  // Success
  if(!empty($response['url'])) {
    c1000_redirect($response['status'], $response['url']);
  }
  else {
    c1000_redirect($response['status']);
  }
}
else {
  $code = C1000_ERROR_NO_COURSES;
}

// Redirect (for error conditions)
c1000_redirect($code);

echo $OUTPUT->footer();

?>

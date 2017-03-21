<?php

// Main redirect page.

require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Course Enrollment Needed");
$PAGE->set_heading("Course Enrollment Needed");
$PAGE->set_url($CFG->wwwroot.'/local/curtis100/error_no_courses.php');

echo $OUTPUT->header();

echo "<p>You are not enrolled in either of the courses that are needed in order to give you access to this content.</p>";
echo '<p><a href="http://www.chalmers-training.org">Go back to the homepage.</a></p>';

echo $OUTPUT->footer();

?>

<?php

// Main redirect page.

require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Course Enrollment Needed");
$PAGE->set_heading("Course Enrollment Needed");
$PAGE->set_url($CFG->wwwroot.'/local/curtis100/error_no_courses.php');

echo $OUTPUT->header();

echo "<h2>Course Enrollment Needed</h2>";
echo "<p>You are not enrolled in a course that gives you access to this content.</p>";
echo '<p><a href="https://chalmers-training.org">Go back to the homepage.</a></p>';

echo $OUTPUT->footer();

?>

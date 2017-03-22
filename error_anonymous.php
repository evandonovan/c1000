<?php

// Main redirect page.

require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Login Required");
$PAGE->set_heading("Login Required");
$PAGE->set_url($CFG->wwwroot.'/local/c1000/error_anonymous.php');

echo $OUTPUT->header();

echo "<h2>Login Required</h2>";
echo "<p>Please log in to access this content.</p>";
echo '<p><a href="https://chalmers-training.org">Go back to the homepage.</a></p>';

echo $OUTPUT->footer();

?>

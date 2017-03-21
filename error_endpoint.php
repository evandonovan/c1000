<?php

// Main redirect page.

require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Unknown Error");
$PAGE->set_heading("Unknown Error");
$PAGE->set_url($CFG->wwwroot.'/local/c1000/error_endpoint.php');

echo $OUTPUT->header();

echo "<p>An unknown error has occurred.</p>";
echo '<p><a href="http://www.chalmers-training.org">Go back to the homepage.</a></p>';
// TODO: add temporary debugging code to show error details & raw data

echo $OUTPUT->footer();

?>

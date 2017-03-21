<?php

// Main redirect page.

require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Redirecting...");
$PAGE->set_heading("Redirecting...");
$PAGE->set_url($CFG->wwwroot.'/local/curtis100/redirect.php');

echo $OUTPUT->header();

echo $OUTPUT->footer();

?>

<?php

// Blank page code based on 
// https://moodle.org/pluginfile.php/114/mod_forum/attachment/856288/blank_page.php

require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("User Info");
$PAGE->set_heading("User Info");
$PAGE->set_url($CFG->wwwroot.'/test_page.php');

echo $OUTPUT->header();

// For testing purposes, output the user.
echo "<h2>User Info</h2>";
echo "<pre>";
echo print_r($USER, TRUE);
echo "</pre>";

echo $OUTPUT->footer();

?>

<?php

// Blank page code based on 
// https://moodle.org/pluginfile.php/114/mod_forum/attachment/856288/blank_page.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Test");
$PAGE->set_heading("Test");
$PAGE->set_url($CFG->wwwroot.'/test_page.php');

echo $OUTPUT->header();
echo "Test";
echo $OUTPUT->footer();

?>

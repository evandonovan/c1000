<?php

// Main redirect page.

require_once('../../config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Unknown Error");
$PAGE->set_heading("Unknown Error");
$PAGE->set_url($CFG->wwwroot.'/local/c1000/error_endpoint.php');

echo $OUTPUT->header();

echo "<h2>Technical Error</h2>";
echo "<p>A technical problem has occurred. Please try again later.</p>";
echo '<p><a href="https://chalmers-training.org">Go back to the homepage.</a></p>';
// Temporary debugging code to show error details & raw data
echo "<!--";
if(isset($_SESSION['json_response'])) {
  echo print_r($_SESSION['json_response'], TRUE);
}
echo "-->";
echo $OUTPUT->footer();

?>

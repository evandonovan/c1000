<?php


function c1000_build_reply_json($type = C1000_STATUS_PASS) {
  $json_data = '';
  
  // Set JSON POST fields
  $fields = array(array(
    'SharedSecret' => array('Secret' => C1000_SECRET, 'Company' => C1000_COMPANY, 'status' => $type)));
  if($type == C1000_STATUS_PASS) {
    $fields[0]['URL']['URL'] = 'http://itwillbehere.com';
  }
  else {
    $fields[0]['URL']['URL'] = '';
  }
  return $json_data;
}

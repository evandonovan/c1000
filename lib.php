<?php

// Library functions used by the plugin as a whole.

require_once 'constants.php';
require_once 'secret.php';

function c1000_build_json() {
  global $USER;
  
  $json_data = '';

  // Moodle doesn't have separate fields for city and state
  $city_state = explode(',', $USER->city);

  // c1000 likes to see US as USA
  if($USER->country == 'US') {
    $country = 'USA';
  }

  // Set JSON POST fields
  $fields = array(array(
    'SharedSecret' => array('Secret' => C1000_SECRET, 'Company' => C1000_COMPANY),
  'User' => array(
    'FirstName' => $USER->firstname,
    'LastName' => $USER->lastname,
    'Email' => $USER->email,
    'Address1' => $USER->address,   // typically not set
    'Address2' => '',               // no equivalent field in Moodle
    'City' => $city_state[0],
    'State' => $city_state[1],
    'PostalCode' => '',             // no equivalent field in Moodle
    'Country' => $country,
    'Phone' => $USER->phone1,       // typically not set
  ),
));
  $json_data = json_encode($fields, JSON_PRETTY_PRINT);
  return $json_data;
}

function c1000_post_json($json_data, $url) {
  // Open connection
  $ch = curl_init();
  // Set the CURL params: URL, JSON settings
  // See https://lornajane.net/posts/2011/posting-json-data-with-php-curl
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json_data))
  );
  $result = curl_exec($ch);

  // var_dump(curl_errno($ch));
  // var_dump(curl_getinfo($ch));

  // Close connection
  curl_close($ch);
  
  return $result;
}

function c1000_parse_response() {
  $response = array('status' => C1000_ERROR_ENDPOINT, 'url' => '', 'error_details' => NULL, 'parsed_json' => NULL, 'payload' => NULL);
  // Receive JSON payload.
  $payload = file_get_contents("php://input", TRUE);

  // Check its length.
  if(strlen($payload) == 0) {
   $response = array('status' => C1000_ERROR_ENDPOINT, 'error_details' => 'no data', 'parsed_json' => NULL, 'payload' => $payload);
  }
  
  // Parse it (as an array, 2nd parameter)
  $parsed_json = json_decode($payload, TRUE);
  if(!is_array($parsed_json) || count($parsed_json) < 1) {
    $response = array('status' => C1000_ERROR_ENDPOINT, 'error details' => 'error parsing json', 'parsed_json' => NULL, 'payload' => $payload);
  }
  
  // Check the secret
  // TODO: confirm these are correct in the structure
  $secret = $parsed_json[0]['SharedSecret']['Secret'];
  $company = $parsed_json[0]['SharedSecret']['Company'];

  if($secret != C1000_SECRET || $company != C1000_COMPANY) {
    $response = array('status' => C1000_ERROR_ENDPOINT, 'error_details' => 'secret did not match', 'parsed_json' => print_r($parsed_json, TRUE), 'payload' => $payload);
  }

  $status = $parsed_json[0]['SharedSecret']['Status'];
  if($status == 'Fail') {
    $response = array('status' => C1000_ERROR_ENDPOINT, 'error_details' => 'status was failure', 'parsed_json' => print_r($parsed_json, TRUE), 'payload' => $payload);
  }
  else if($status == 'Pass') {
    $url = $parsed_json[0]['URL']['URL'];
    $response = array('url' => $url, 'status' => C1000_ACCESS_GRANTED, 'error_details' => NULL, 'parsed_json' => print_r($parsed_json, TRUE), 'payload' => $payload);
   }
  else {
    $response = array('status' => C1000_ERROR_ENDPOINT, 'error_details' => 'unknown status', 'parsed_json' => print_r($parsed_json, TRUE), 'payload' => $payload);
  }
  
  // put the JSON response data in the session, for debugging on error page
  $_SESSION['json_response'] = $response;

  return $response;    
}

function c1000_redirect($code, $url = '') {
  // Uses Moodle's redirect() function to redirect appropriately.
  switch($code) {
    // If access is granted, redirect to c1000
    case C1000_ACCESS_GRANTED:
      if(!empty($url)) {
        redirect($url);
      }
      break;
    // Otherwise, redirect to an error page
    case C1000_ERROR_ANONYMOUS:
      redirect(C1000_ERROR_URL_ANONYMOUS);
      break;
    case C1000_ERROR_NO_COURSES:
      redirect(C1000_ERROR_URL_NO_COURSES);
      break;
    case C1000_ERROR_ENDPOINT:
    default:
      redirect(C1000_ERROR_URL_ENDPOINT);
   }
}

// Check if user is anonymous
function c1000_is_anonymous() {
  global $USER;
  if($USER->id == 0) {
    return TRUE;
  }
  else {
    return FALSE;
  }
}

// Check user's courses
function c1000_check_course_enrollment($courseid) {
  global $USER;
  
  // See http://stackoverflow.com/questions/8391529
  $context = get_context_instance(CONTEXT_COURSE, $courseid, MUST_EXIST);
  $enrolled = is_enrolled($context, $USER->id, '', TRUE);
  return $enrolled;
}


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

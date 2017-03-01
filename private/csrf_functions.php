<?php

  // Returns a random string suitable for a CSRF token
  function csrf_token() {
    // Requires PHP 7 or later
    return bin2hex(random_bytes(64));
  }

  // Returns HTML for a hidden form input with a CSRF token as the value
  function csrf_token_tag() {
    // TODO needs to set a token and put in an HTML tag
	$token = csrf_token();
	$_SESSION['csrf_token'] = $token;
	$_SESSION['csrf_token_time'] = time();
	
    return '<input type="hidden" name="csrf_token" value="' . $token . '" />';
  }

  // Returns true if form token matches session token, false if not.
  function csrf_token_is_valid() {
    if(!isset($_POST['csrf_token'])) { return false; }
    if(!isset($_SESSION['csrf_token'])) { return false; }
	if(!csrf_token_is_recent()) { return false; }
    return ($_POST['csrf_token'] === $_SESSION['csrf_token']);
  }

  // Determines if the form token should be considered "recent"
  // by comparing it to the time a token was last generated.
  function csrf_token_is_recent() {
    // TODO add code to determine if csrf token is recent
	
	$time_ten = (60 * 10);
	
	$time_check = (time() - $_SESSION['csrf_token_time']);
	
	if($time_check < $time_ten) {
		
		return true;
	}
	
	return false;
  }

?>

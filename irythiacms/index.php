<?php
/**
 * Purpose: Landing page for the CMS.
 **/

define("ROOT", dirname(__FILE__));
define("DS", DIRECTORY_SEPARATOR);

// Initialize
require_once(ROOT . DS . "common" . DS . "bootstrap.php");

// Extract information from URL and parse it
foreach ($_GET as $key => $value) {
	if ($key == "module") {
		$module = $value;
	}
	else if ($key == "action") {
		$action = $value;
	}
	else {
		$param[] = $value;
	}
}

// Default page - login screen
$module = empty($module) ? "auth" : $module;
$action = empty($action) ? "login" : $action;
$param = empty($param) ? array() : $param;

// Render page
$output = new Output($module, $action);
$output->render();
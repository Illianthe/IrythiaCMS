<?php
/**
 * Purpose: Stylesheet for the site.
 **/

// Treat this file as a css file
header("Content-Type: text/css");

// These are needed to access methods, etc. in the CMS
define("CMS_DIR", "irythiacms");
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__FILE__) . DS . CMS_DIR);
require_once(CMS_DIR . DS . "common" . DS . "bootstrap.php");

$pagegenerator = new PageGenerator();
echo $pagegenerator->generate_css();
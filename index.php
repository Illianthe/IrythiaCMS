<?php
/**
 * Purpose: Landing page for the site. Front controller for all page requests.
 **/

// These are needed to access methods, etc. in the CMS
define("CMS_DIR", "irythiacms");
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__FILE__) . DS . CMS_DIR);
require_once(CMS_DIR . DS . "common" . DS . "bootstrap.php");

// If there wasn't a page request, fetch default (assuming there is an article with alias 'home')
$page = (isset($_GET["page"])) ? $_GET["page"] : "home";

$pagegenerator = new PageGenerator();
echo $pagegenerator->generate_html($page);
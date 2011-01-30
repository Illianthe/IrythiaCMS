<?php
/**
 * Purpose: Contains general settings for the CMS (database info, states, etc.)
 **/

// Development or production
define("DEBUG_MODE", true);

// Database settings
define("DB_HOST", "localhost");
define("DB_USER", "");
define("DB_PASS", "");
define("DB_NAME", "");
define("DB_PREFIX", "irythiacms");
define("DB_SALT", "salt");
define("DB_HASHTYPE", "sha256");

// CMS settings
define("SITE_PATH", "");
define("CMS_NAME", "Irythia Content Management System");
define("CMS_VERSION", "0.5");
define("THEME_NAME", "default");
define("THEME_PATH", ROOT . DS . "assets" . DS . "themes" . DS . THEME_NAME . DS);
define("APP_PATH", ROOT . DS . "application" . DS);
define("DEFAULT_EMAIL", "");

// Modules - map to a controller
$modules["auth"] = "AuthController";
$modules["articlemanager"] = "ArticleController";
$modules["stylesheetmanager"] = "StylesheetController";
$modules["templatemanager"] = "TemplateController";
$modules["ucp"] = "UCPController";
$modules["acp"] = "ACPController";

// Permission settings - user level mapped to actions allowed
// Group settings and whatnot should really go into database...
// 0: Guest
// 10: Writer
// 100: Admin
$userlevel["0"] = array(100);
$userlevel["10"] = array(100, 200, 500);
$userlevel["100"] = array(100, 200, 300, 400, 500, 600);
$permissions["AuthController"]["All"] = 100;
$permissions["ArticleController"]["All"] = 200;
$permissions["StylesheetController"]["All"] = 300;
$permissions["TemplateController"]["All"] = 400;
$permissions["UCPController"]["All"] = 500;
$permissions["ACPController"]["All"] = 600;

// Relative paths (for URLs such as external stylesheets, js, etc.)
define("THEME_URL_PATH", "assets/themes/" . THEME_NAME . "/");
define("LIBRARY_URL_PATH", "library/");
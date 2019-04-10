<?php

error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED);
ini_set("display_errors", true);
require_once(dirname(__FILE__) . "/system/DB/Validation.php");
require_once(dirname(__FILE__) . "/system/DB/Query.php");
require_once(dirname(__FILE__) . "/system/DB/DB.php");
require_once(dirname(__FILE__) . "/system/System/config.php");
require_once(dirname(__FILE__) . "/system/HTTP/http.php");
require_once(dirname(__FILE__) . "/system/Template/Template.php");
require_once(dirname(__FILE__) . "/system/System/log.php");
require_once(dirname(__FILE__) . "/system/Error/Error.php");
require_once(dirname(__FILE__) . "/system/Mailer/mailer.php");
require_once(dirname(__FILE__) . "/system/Encoding/Encoding.php");

require_once(dirname(__FILE__) . "/config.php");


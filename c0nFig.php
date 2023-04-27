<?php
session_start();
if (!defined('IN_SITE')){echo('The request not found');exit();}
define("HOSTT", "2hkinformatics.000webhostapp.com");
define("URI", "http://2hkinformatics.000webhostapp.com");
define("DB_HOST", "localhost");//sql308.ihostfull.com
define("DB_USER", "id15865915_2hkdb_er");//uoolo_27818865
define("DB_PSW", "/zujw^fYp(Xp5pQr");
define("DB_NAME", "id15865915_2hkdb");
require_once('model/database.php');
$db = new Database();
?>
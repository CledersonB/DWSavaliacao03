<?php
define("BASE_PATH", dirname(__FILE__));
define("BASE_URL", "http://localhost/DWSavaliacao03");

define ('SESSION_TIME', 10440);

session_name("MyAPP");
session_start([
    'cookie_lifetime' => SESSION_TIME,
]);
?>
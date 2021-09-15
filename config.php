<?php

define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "curso_php");

define("DB_DSN", "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME);

if (!defined("DOCUMENT_ROOT")) {
    define("DOCUMENT_ROOT", dirname(__FILE__) . "/");
}

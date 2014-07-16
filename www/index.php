<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../Acme.php';
Acme::instance()->route();

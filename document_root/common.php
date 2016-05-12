<?php

$globalImportPrefix = $p2r . '../lib/classes/';

include_once($globalImportPrefix . '../generalFunctions.php');
include_once($globalImportPrefix . '../registerClasses.php');
include_once($globalImportPrefix . '../constants.php');

include($p2r . 'settings.php');


$ip = ini_get('include_path');
$zendPath = $p2r . '../lib/Zend/';
ini_set('include_path', $zendPath . PATH_SEPARATOR . $ip);
include_once($zendPath . 'Zend/Search/Lucene.php');


$SM = SessionManager::getInstance();
$SM->beginSession();

$DB = new MysqlDb($databaseConnection);
$SPF = new SPFactory($spPath, $DB);
$options = new Options($SPF);

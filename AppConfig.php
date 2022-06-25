<?php
// Errors Visiblity Configuration
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Time Configuration
date_default_timezone_set('Asia/Baghdad');

// App Configuration
$AppLanguage = "kurdish";

// App Security Configuration
$AppKey = "9ci8ssvft46zqrf97jcfiiqjlw81i54u";

//Default Arguments
$Args = Array();

// Database Connection Configuration
$DatabaseHost = "localhost";
$DatabaseUserName = "root";
$DatabaseUserPassword = "";
$DatabaseName = "testdatabase";

// Folder Configuration
$AppBasePath = str_replace("\\" , "/", __DIR__);
$PublicFolderPath = "www";
$PublicFolderName = "public";
$AppTempPath = $AppBasePath ."/tmp";
$AppUploadsPath = $AppBasePath . "/" . $PublicFolderPath . "/uploads";
if (!is_dir($AppTempPath)) mkdir($AppTempPath, 0755);
if (!is_dir($AppUploadsPath)) mkdir($AppUploadsPath, 0777);

// Auth Configuration
$IsAuthorized = true;
$IsAuthenticated = false;

// Error Configuration
$ErrorCode = 0;
?>

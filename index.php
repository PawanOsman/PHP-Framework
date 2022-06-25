<?php
// Application Configuration
require_once 'AppConfig.php';

// Composer Packages
require_once 'vendor/autoload.php';

// Application Configuration
require_once 'CoreFunctions.php';

// Function and Helpers
InitParts("Functions");

// AltoRouter Class
require_once 'Router.php';

// Create New Router
$Router = new Router();

// Framework Packages
InitParts("Framework");

// Packages
InitParts("Packages");

// Database Context
require_once 'DbContext.php';

// ClientInfo Init
$ClientInfo = new ClientInfo();

// Services
InitParts("Services");

// Controllers
InitParts("Controllers");

// Routes
InitParts("Routes");

// Force Use SSL
// Core::ForceSSL();

// Start Application Routing
$Router->start();
?>
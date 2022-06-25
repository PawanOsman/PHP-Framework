<?php
$Router->map('GET|POST', '/404', 'ErrorHandler::Go(404)', "404Route");
$Router->map('GET|POST', '/403', 'ErrorHandler::Go(403)', "403Route");
?>
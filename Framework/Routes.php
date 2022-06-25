<?php
$Router->map('GET|POST', "/$PublicFolderName/[**:trailing]", 'Core::Public');
?>
<?php
function GetMethodeArgNames($Methode) {
    $f = new ReflectionMethod($Methode);
    $result = array();
    foreach ($f->getParameters() as $param) {
        $result[] = $param->name;
    }
    return $result;
}
?>
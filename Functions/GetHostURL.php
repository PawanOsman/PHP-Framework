<?php
function GetHostURL() {
    $possibleHostSources = array('HTTP_X_FORWARDED_HOST', 'HTTP_HOST', 'SERVER_NAME', 'SERVER_ADDR');
    $sourceTransformations = array(
        "HTTP_X_FORWARDED_HOST" => function($value) {
            $elements = explode(',', $value);
            return trim(end($elements));
        }
    );
    $host = '';
    foreach ($possibleHostSources as $source)
    {
        if (!empty($host)) break;
        if (empty($_SERVER[$source])) continue;
        $host = $_SERVER[$source];
        if (array_key_exists($source, $sourceTransformations))
        {
            $host = $sourceTransformations[$source]($host);
        }
    }

    // Remove port number from host
    $host = trim(preg_replace('/:\d+$/', '', $host));

    $HostURL = (IsSecureConnection() ? "https://" : "http://") . $host;
    return $HostURL;
}
?>
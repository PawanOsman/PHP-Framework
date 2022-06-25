<?php
function TimeElapsedString($datetime, $site_language, $lang, $full = false) {
    $arabic = ($site_language == "ar-IQ") ? true : false;
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => $lang("YEAR"),
        'm' => $lang("MONTH"),
        'w' => $lang("WEEK"),
        'd' => $lang("DAY"),
        'h' => $lang("HOUR"),
        'i' => $lang("MINUTE"),
        's' => $lang("SECOND"),
    );
    $string_p = array(
        'y' => $lang("YEARS"),
        'm' => $lang("MONTHS"),
        'w' => $lang("WEEKS"),
        'd' => $lang("DAYS"),
        'h' => $lang("HOURS"),
        'i' => $lang("MINUTES"),
        's' => $lang("SECONDS"),
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . ($site_language == "ku" ? $v : ($site_language == "en-US" ? $v . ($diff->$k > 1 ? 's' : '') : ($site_language == "ar" ? $string_p[$k] : '')));
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
	$enku_string = $string ? implode(', ', $string) . ' '.$lang("AGO") : $lang("JUSTNOW");
	$arabic_string = $string ? $lang("AGO").' '.implode(', ', $string) : $lang("JUSTNOW");
    return ($arabic) ? $arabic_string : $enku_string;
}
?>

<?php
class Localizer{
  public static function Init()
  {
    extract($GLOBALS);
    if(!empty(Cookie::Get("Language"))) {
      self::SetLanguage(Cookie::Get("Language"));
    }
    else {
      Cookie::Set("Language", $AppLanguage, time()+((3600*24)*30), "/");
    }
  }

  public static function Get($Key)
  {
    extract($GLOBALS);
    // $appLanguages = $languages->Select()->Where("langkey", "=", $Key)->Get();
    // $isAvailable = $appLanguages->Count() > 0 ? true : false;
    // return ($isAvailable) ? $appLanguages->First()[$AppLanguage] : $Key;
    return $Key;
  }

  public static function SetLanguage($Language)
  {
    extract($GLOBALS, EXTR_REFS | EXTR_SKIP);
    $AppLanguage = $Language;
  }

  public static function GetLanguage($LanguageCode = false)
  {
    extract($GLOBALS);
    $appLanguages = file_get_contents($AppBasePath . "/Resources/Languages.json", 0);
    $appLanguages = json_decode($appLanguages, true);
    if($LanguageCode)
    {
      return ($AppLanguage == "kurdish") ? "ku" : (($AppLanguage == "english") ? "en-US" : "ar-IQ");
    }
    else {
      return $appLanguages[$AppLanguage];
    }
  }
}

Localizer::Init();
?>
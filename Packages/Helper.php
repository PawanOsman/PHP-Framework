<?php
class Helper{
  public static function PublicName()
  {
    global $PublicFolderName;
    return GetHostURL() . "/" . $PublicFolderName;
  }

  public static function PublicPath()
  {
    global $PublicFolderPath;
    return $PublicFolderPath;
  }

  public static function UrlGen($Route, $FullUrl = false)
  {
    global $Router;
    if(isset($Router->GetNamedRoutes()[$Route]))
    {
      return GetHostURL() . $Router->GetNamedRoutes()[$Route];
    }
    else
    {
      return ($FullUrl ? GetHostURL() : "") . $Route;
    }
  }
}
?>
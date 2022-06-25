<?php
class Core{
  public static function ForceSSL()
  {
    if(!IsSecureConnection())
    {
      self::Redirect(str_replace("http", "https", GetHostURL()) . $_SERVER["REQUEST_URI"]);
      die;
    }
  }

  public static function Redirect($Route, $FullUrl = false)
  {
    global $Router;
    if(isset($Router->GetNamedRoutes()[$Route]))
    {
      header("Location: " . GetHostURL() . $Router->GetNamedRoutes()[$Route]);
    }
    else
    {
      header("Location: " . ($FullUrl ? GetHostURL() : "") . $Route);
    }
  }

  public static function QueryArgs($MethodeName, $Arguments)
  {
    global $Args;
    $Args = Array();
    $ArgNames = GetMethodeArgNames($MethodeName);
    for($x = 0; $x <= count($ArgNames)-1; $x++)
    {
      $Args[$ArgNames[$x]] = $Arguments[$x];
    }
    return $Args;
  }

  public static function Public($FilePath)
  {
    extract($GLOBALS);
    if(empty($FilePath)) ErrorHandler::Go(404);

    $FilePath = $AppBasePath . "/$PublicFolderPath/$FilePath";
    if(!file_exists($FilePath) OR is_dir($FilePath)) ErrorHandler::Go(404);
    header("Content-Type: " . GetFileMimeType($FilePath));
    readfile($FilePath);
  }
}
?>

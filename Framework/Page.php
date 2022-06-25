<?php
class Page{
  Public static $Errors = array();
  Public static $Title = "";
  Public static $Description = "";
  Public static $Keywords = "";
  Public static $ViewData = array();
  protected static $ViewRules = array(
		"{{="=>"{{ echo ",
		'{{@"'=>'{{ echo Localizer::Get("',
		'"@'=>'") '
	);

  public static function View($ViewName, $Path = false, $Layout = "Default")
  {
    if(isset($_GET["sp"]))
    {
      if($_GET["sp"] == "true")
      {
        header("HTTP/1.0 200 OK");
        $Layout = null;
      }
    }
    extract($GLOBALS);
    $Path = ($Path) ? "/{$Path}" : "";
    if(!empty($ViewName))
    {
      $FilePath = "{$AppBasePath}/Views{$Path}/{$ViewName}.php";
      if(file_exists($FilePath))
      {
        if(!empty($Layout))
        {
          //echo self::CompileView($AppBasePath . "\Views\Layouts\Header@$layout.php");
          echo self::CompileView($FilePath, $Layout);
          //echo self::CompileView($AppBasePath . "\Views\Layouts\Footer@$layout.php");
        }
        else
        {
          echo self::CompileView($FilePath);
        }
      }
      else
      {
        throw new Exception("View with name {$ViewName} not found in $FilePath");
      }
    }
    else
    {
      throw new Exception("View name can not be empty!");
    }
  }

  public static function RenderComponent($ComponentName, $Path = "/Views/Components")
  {
    extract($GLOBALS);
    if(!empty($ComponentName))
    {
      $FilePath = $AppBasePath . $Path . "/$ComponentName.php";
      if(file_exists($FilePath))
      {
        echo self::CompileView($FilePath);
      }
      else
      {
        throw new Exception("View with name $ComponentName not found in $FilePath");
      }
    }
    else
    {
      throw new Exception("View name can not be empty!");
    }
  }

  public static function CompileView($ViewPath, $Layout = null)
  {
    extract($GLOBALS);
    if(!empty($Layout))
    {
      ob_start();
      include_once($AppBasePath . "/Views/Layouts/$Layout@Layout.php");
      $Layout = ob_get_contents();
      ob_end_clean();
    }
    ob_start();
    include_once($ViewPath);
    $Page = ob_get_contents();
    ob_end_clean();
    $MergedPageAndLayout = (!empty($Layout)) ? str_replace("@RenderContent()", $Page, $Layout) : $Page;
    preg_match_all('/{{(.*?)}}/mi', $MergedPageAndLayout, $Matches, PREG_SET_ORDER, 0);
    foreach ($Matches as $Action) {
    $ContentReplace = '{{'.trim(ltrim($Action[1])).'}}';
      $MergedPageAndLayout = str_replace($Action[0], $ContentReplace, $MergedPageAndLayout);
    }
    $MergedPageAndLayout = strtr($MergedPageAndLayout, self::$ViewRules);
    preg_match_all('/{{(.*?)}}/mi', $MergedPageAndLayout, $Matches, PREG_SET_ORDER, 0);
    // print_r($Matches);
    foreach ($Matches as $Action) {
      ob_start();
      eval($Action[1].";");
      $Content = ob_get_contents();
      $MergedPageAndLayout = str_replace($Action[0], $Content, $MergedPageAndLayout);
      ob_end_clean();
    }
    return $MergedPageAndLayout;
  }
}
?>

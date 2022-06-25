<?php
class MainController{
  public static function Index()
  {
    Core::QueryArgs(__METHOD__, func_get_args());
    Page::$Title = Localizer::Get("WELCOME");
    Page::$ViewData["category"] = "all";
    return Page::View("HomeController@Index");
  }
}
?>

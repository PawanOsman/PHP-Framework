<?php
class ApiTestController{
  public static function Test()
  {
    extract($GLOBALS);
    // Auth::Required();
    echo Response::Json([
        "status"=>true
    ]);
  }
}
?>

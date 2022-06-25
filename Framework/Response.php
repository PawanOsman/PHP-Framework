<?php
class Response{
  public static function Json($ResponseData)
  {
    header("Content-Type: application/json");
    return json_encode($ResponseData, JSON_PRETTY_PRINT);
  }
}
?>
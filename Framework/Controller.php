<?php
class Controller{
  public static function Action($Action)
  {
    global $IsAuthorized, $ErrorCode;
    if($IsAuthorized)
    {
      call_user_func($Action);
    }
    else
    {
      ErrorHandler::Go(403);
    }
  }
}
?>
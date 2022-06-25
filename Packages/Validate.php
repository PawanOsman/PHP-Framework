<?php
class Validate{
  public static function PhoneNumber($PhoneNumber)
  {
    return preg_match("/^[0-9]{4}[0-9]{3}[0-9]{4}$/", $PhoneNumber);
  }
}
?>
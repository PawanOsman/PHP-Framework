<?php
class Log{
  protected $Errors = array();
  public function SetError($Error)
  {
    $this->Errors[] = $Error;
  }
  public function GetErrors()
  {
    return $this->Errors;
  }
}
?>
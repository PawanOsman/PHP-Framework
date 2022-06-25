<?php
class MethodResult {
  public $Status;
  public $Data;

  public function ToJson(){
    return Response::Json([
        "Status"=>$this->Status,
        "Data"=>$this->Data
    ]);
  }
}

?>
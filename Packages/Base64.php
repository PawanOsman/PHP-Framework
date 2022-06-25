<?php
class Base64{
  public static function Encode($String){
    return base64_encode($String);
  }

  public static function Decode($base64){
    return base64_decode($base64);
  }

  public static function DataUri($Url){
    $FileBinary = file_get_contents($Url);
    $Finfo = finfo_open();
    $MimeType = finfo_buffer($Finfo, $FileBinary, FILEINFO_MIME_TYPE);
    finfo_close($Finfo);
    $FileBase64Data = Base64::Encode($FileBinary);
    $DataUri = "data:{$MimeType};base64,{$FileBase64Data}";
    return $DataUri;
  }
}
?>
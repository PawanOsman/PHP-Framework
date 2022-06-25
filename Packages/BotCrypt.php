<?php
class BotCrypt{
  public static function EncryptString($Password, $String)
  {
    $Method = 'aes-256-cbc';

    // Must be exact 32 chars (256 bit)
    $Password = substr(hash('sha256', $Password, true), 0, 32);

    // IV must be exact 16 chars (128 bit)
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    return base64_encode(openssl_encrypt($String, $Method, $Password, OPENSSL_RAW_DATA, $iv));
  }

  public static function DecryptString($Password, $String)
  {
    $Method = 'aes-256-cbc';

    // Must be exact 32 chars (256 bit)
    $Password = substr(hash('sha256', $Password, true), 0, 32);

    // IV must be exact 16 chars (128 bit)
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    return openssl_decrypt(base64_decode($String), $Method, $Password, OPENSSL_RAW_DATA, $iv);
  }
}
?>
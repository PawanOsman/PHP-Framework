<?php
class Cookie{
  public static function Get($CookieName)
  {
    if(!isset($_COOKIE[$CookieName]))
    {
      return null;
    }
    else
    {
      return $_COOKIE[$CookieName];
    }
  }
  public static function Set($CookieName, $CookieValue, $ExpireDate, $CookiePath, $CookieDomain = "", $Secure = FALSE, $HttpOnly = FALSE)
  {
    setcookie($CookieName, $CookieValue, $ExpireDate, $CookiePath, $CookieDomain, $Secure, $HttpOnly);
  }

  public static function Delete($CookieName){
    Cookie::Set($CookieName, "", time()-31536000, "/");
    unset($_COOKIE[$CookieName]);
  }
}
?>

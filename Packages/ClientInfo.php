<?php
class ClientInfo {
  private $UAParsed;
  public function __construct()
  {
    $this->UAParsed = new WhichBrowser\Parser($_SERVER['HTTP_USER_AGENT']);
  }

  public function Browser()
  {
  	return (!empty($this->UAParsed->browser->toString())) ? $this->UAParsed->browser->toString() : "UNKNOWN";
  }

  public function Engine()
  {
  	return (!empty($this->UAParsed->engine->toString())) ? $this->UAParsed->engine->toString() : "UNKNOWN";
  }

  public function OS()
  {
    return (!empty($this->UAParsed->os->toString())) ? $this->UAParsed->os->toString() : "UNKNOWN";
  }

  public function Device()
  {
    return (!empty($this->UAParsed->device->toString())) ? $this->UAParsed->device->toString() : "UNKNOWN";
  }

  public function DeviceType()
  {
    return (!empty($this->UAParsed->device->type)) ? $this->UAParsed->device->type : "UNKNOWN";
  }

  public function ISP()
  {
    $api = file_get_html("https://www.whoismyisp.org/ip/".$this->IP());
  	$isp = $api->find(".isp", 0)->plaintext;
    return (!empty($isp)) ? $isp : "UNKNOWN";
  }

  public function IP()
  {
      // Get real visitor IP behind CloudFlare network
      if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
      }
      $client  = @$_SERVER['HTTP_CLIENT_IP'];
      $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
      $remote  = $_SERVER['REMOTE_ADDR'];

      if(filter_var($client, FILTER_VALIDATE_IP))
      {
          $ip = $client;
      }
      elseif(filter_var($forward, FILTER_VALIDATE_IP))
      {
          $ip = $forward;
      }
      else
      {
          $ip = $remote;
      }

    return (!empty($ip)) ? $ip : "UNKNOWN";
  }
}
?>
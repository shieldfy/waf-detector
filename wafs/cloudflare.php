<?php
class Cloudflare extends Waf{
  public $wafname = 'Cloudflare';
  public $wafurl = 'https://www.cloudflare.com/';
  function testHeader(){
    $server = $this->extractValue('Server');
    if($server == 'cloudflare-nginx'){
      return true;
    }
    $cfray = $this->extractValue('CF-RAY');
    if($cfray !== false){
      return true;
    }
    return false;
  }

}
?>

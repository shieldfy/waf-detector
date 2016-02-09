<?php
class Modsecurity extends Waf{
  public $wafname = 'Mod Security';
  public $wafurl = 'https://www.modsecurity.org';

  function testBlock(){
    $response = $this->requestContent($this->url.'/../../etc/');
    if(strstr($response['content'], 'Mod_Security')){
      return true;
    }

  }

}
?>

<?php
class Shieldfy extends Waf{
  public $wafname = 'Shieldfy';
  public $wafurl = 'https://shieldfy.com';
  function testHeader(){

    $server = $this->extractValue('X-Web-Shield');
    if($server == 'ShieldfyWebShield'){
      return true;
    }
    return false;
    
  }

}
?>

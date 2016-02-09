<?php
class Incapsula extends Waf{
  public $wafname = 'Incapsula';
  public $wafurl = 'https://www.incapsula.com';
  function testHeader(){
    $server = $this->extractValue('X-CDN');
    if($server == 'Incapsula'){
      return true;
    }
    return false;
  }

}
?>

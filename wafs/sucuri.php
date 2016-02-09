<?php
class Sucuri extends Waf{
  public $wafname = 'Sucuri';
  public $wafurl = 'https://sucuri.net';
  function testHeader(){

    $server = $this->extractValue('Server');
    if($server == 'Sucuri/Cloudproxy'){
      return true;
    }
    return false;

  }

}
?>

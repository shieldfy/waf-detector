<?php
class waf{
    public $url;
    public $headers;
    public $result;
    function __construct(){
    }

    function requestContent($url){
      $ch = curl_init();
      curl_setopt_array($ch, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => $url,
          CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U;Windows NT 5.1; ru; rv:1.8.0.9) Gecko/20061206 Firefox/1.5.0.9',
          CURLOPT_FOLLOWLOCATION=>1,
          CURLOPT_SSL_VERIFYPEER=>0,
          CURLOPT_SSL_VERIFYHOST=>0
      ));
      $response = curl_exec($ch);
      return ['content'=>$response];
      curl_close($ch);
    }

    function extractValue($value){
      if(isset($this->headers[$value])){
        //get the value
        if(is_array($this->headers[$value])){
          $value = $this->headers[$value][0];
        }else{
          $value = $this->headers[$value];
        }
        return $value;
      }
      return false;
    }

    function runAll($url){
      $this->url = $url;
      //get headers
      $this->headers = get_headers($url,1);
    //  print_r($this->headers);
      foreach (get_class_methods($this) as $method) {
         if (strpos($method, 'test') === 0) {
             $res = $this->$method();
             if($res == true){
               $this->result = $res;
               break;
             }
         }
      }
    }

}
?>

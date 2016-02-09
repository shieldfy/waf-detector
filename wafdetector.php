#!/usr/bin/env php
<?php
// $signs = file_get_contents('./signatures.json');
// $signs = json_decode($signs,1);
// print_r($signs);
echo "__          __    __   _____       _            _
 \ \        / /   / _| |  __ \     | |          | |
  \ \  /\  / /_ _| |_  | |  | | ___| |_ ___  ___| |_ ___  _ __
   \ \/  \/ / _` |  _| | |  | |/ _ \ __/ _ \/ __| __/ _ \| '__|
    \  /\  / (_| | |   | |__| |  __/ ||  __/ (__| || (_) | |
     \/  \/ \__,_|_|   |_____/ \___|\__\___|\___|\__\___/|_|"."\n\n\n";

echo "By : Shieldfy Security Team"."\n";
echo "team@shieldfy.com"."\n";
echo "https://shieldfy.com"."\n\n\n";
echo "Usage:- \n";
echo "php wafdetector.php http://example.com \n\n";
echo "================================="."\n";


if(!isset($argv[1])){
  echo "Missing URL \n";
  exit;
}
//@TODO validate URL

$url = $argv[1];


$classes = [
  'shieldfy',
  'cloudflare',
  'sucuri',
  'incapsula',
  'modsecurity'
];

require_once('waf.php');
echo "Testing URL: ".$url."\n";
echo "=================================== \n";
foreach($classes as $class):
  require_once('wafs/'.$class.'.php');
  $className = ucfirst($class);
  $waf = new $className();
  echo "* Testing Waf:".$className."\n";
  $waf->runAll($url);
  if($waf->result){
    echo "* Found Match \n";
    echo "* Website: (".$waf->url.") is using Web Application Firewall :  ";
    echo $waf->wafname.' ('.$waf->wafurl.')'."\n";
    exit;
  }
endforeach;
echo "* Didn't Found Match \n";
echo "* Website don't use waf or using waf not on our signature database \n";
?>

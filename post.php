<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

require 'facebooksdk/src/facebook.php';
require 'cfg.php';
require 'db.php';

$facebook = new Facebook(array(
  'appId'  => Config::appId,
  'secret' => Config::secret,
));
  
$user = $facebook->getUser();
$ext = "";


if(isset($_GET["post"])) {

  if ($user) {
    
    $stmt = DB::prepare("SELECT * FROM users WHERE user=?");  
    $stmt->execute(array($user));
    
    if($stmt->rowCount() > 0) {
      $row = $stmt->fetch();
      $count = $row["count"];

      if($count > 0) {
        $ext = "";
        if($count > 1) {
          $ext = " for the " . addOrdinalNumberSuffix($count) . " time";
        }

        try {    
          $facebook->api('/me/feed', 'post', array('message'=> "I just played Social Roulette".$ext." and survived! – http://socialroulette.net"));
                    
          //return message
          echo "success";

          } catch (FacebookApiException $e) {
            error_log($e);
            echo "Failed";
          }

        } else {
          echo "you need to play first";
        }
      } else {
         echo "you need to play first";
      }

  } else {
    echo "503";
  }

}

function addOrdinalNumberSuffix($num) {
  if (!in_array(($num % 100),array(11,12,13))){
    switch ($num % 10) {
      // Handle 1st, 2nd, 3rd
      case 1:  return $num.'st';
      case 2:  return $num.'nd';
      case 3:  return $num.'rd';
    }
  }
  return $num.'th';
}
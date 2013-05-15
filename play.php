<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

require 'facebooksdk/src/facebook.php';
require 'cfg.php';
require 'db.php';
require 'roulette.php';
require 'deleteFacebook.php';

$facebook = new Facebook(array(
  'appId'  => Config::appId,
  'secret' => Config::secret,
));
  
$user = $facebook->getUser();
$now = time();
$secSincePlayed = 0;
$count = 0;

if($user) {

  //check permission
  $permissions = $facebook->api("/me/permissions");
  if (array_key_exists('publish_stream', $permissions['data'][0])) { 

    //play roulette
    $outcome = roulette();  

    //Lost – delete facebook account
    if($outcome == 0) {    
      
      deleteFacebookAccount($user);
      echo json_encode(array("message" => "Deleted Facebook User ".$user));

    } else {
      //survived;

      $stmt = DB::prepare("SELECT * FROM users WHERE user=?");  
      $stmt->execute(array($user));

      
      if($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $count = $row["count"];
        $lastplayed = strtotime($row["lastplayed"]);
        $secSincePlayed = $now-$lastplayed;    
      } 


      $newCount = $count+1;      
      $ext = " for the " . addOrdinalNumberSuffix($newCount) . " time";
      
      if($count >= 1 && $secSincePlayed < 86400) {

        echo json_encode(array("message" => "505"));

      } else {
        
        if($stmt->rowCount() > 0) {
          $stmt = DB::prepare("UPDATE users SET count = ?, lastplayed=now() WHERE user = ?");
          $stmt->execute(array($newCount, $user));

        } else {
          $stmt = DB::prepare("INSERT INTO users SET count=1, lastplayed=now(), user = ?");
          $stmt->execute(array($user));
        }

        echo json_encode(array("message"=>"You just survived Social Roulette".$ext."!", "result" => $outcome));
      }
    }

  } else {
    //not correct permissions    
    $loginUrl = $facebook->getLoginUrl(array('scope' => 'publish_stream, email', "redirect_uri" => "http://socialroulette.net/develop/")); 
    
    echo json_encode(array("message" => "506", "redirect" => $loginUrl));
  }

} else {
  echo json_encode(array("message" => "503"));
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
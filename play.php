<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

require 'facebook-php-sdk/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '283583331777209',
  'secret' => 'c2f8f3549e44fc5a51c027694c090871',
));

$user = $facebook->getUser();

if ($user) {
  //post message
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $facebook->api('/me/feed', 'post', array('message'=> "ENTER MESSAGE HERE"));
    echo "<h1>Phew, You Survived Social Roulette!</h1><a href='/play'>Click Here To Play Again!</a>";

  } catch (FacebookApiException $e) {
    error_log($e);
    echo "<h1>You Can Only Play Once A Day... :/</h1>";
  }

} else {
  echo "503";
}
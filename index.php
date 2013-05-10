<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
require 'facebook-php-sdk/src/facebook.php';

//Get Path
$path = explode('/',str_replace('?'.$_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']));
array_shift($path);

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '283583331777209',
  'secret' => 'c2f8f3549e44fc5a51c027694c090871',
));

// Get User ID
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

$loginUrl = $facebook->getLoginUrl(array('scope' => 'publish_stream, email, rsvp_event, publish_actions, friends_online_presence, user_online_presence, manage_notifications, manage_friendlists, create_event, ads_management, xmpp_login, read_stream, read_requests, read_mailbox, read_insights, read_friendlists, user_work_history, user_website, user_videos, user_subscriptions, user_status, user_religion_politics, user_relationship_details, user_relationships, user_questions, user_photos, user_notes, user_location, user_likes, user_interests, user_hometown, user_groups, user_education_history, user_games_activity, user_actions.video, user_actions.news, user_actions.music')); 

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">

  <title>Social Roulette</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>  
  <div id="result">

  </div>

  <?php if ($user): //Haz User ?>      
    <a href="/play" id="play">Click Here To Play Social Roulette. WARNING, there's a 1/6th change your Facebook account will be deleted</a>

  <?php else: //No Haz User?>
    <div>        
      <a href="<?php echo $loginUrl; ?>">Click Here to begin playing Social Roulette with your Facebook account</a>
    </div>

  <?php endif; ?>


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.4.min.js"><\/script>')</script>

  <script>
    
    $("#play").click(function() {
    
      $.ajax({
        url: "/play.php",
        success: function(data) {
          var res = $("#result");

          //not logged in
          if(data === "503") {
            window.location.href = "/";
          } else {            
                      
            //append status message
            $(res).html(data);
          }
        }
      });

      return false;
    });
  </script>

  <script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview'],['_trackPageLoadTime']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
</body>
</html>

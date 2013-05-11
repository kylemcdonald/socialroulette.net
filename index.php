<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
require 'facebooksdk/src/facebook.php';
require 'cfg.php';

//Get Path
$path = explode('/',str_replace('?'.$_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']));
array_shift($path);

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => Config::appId,
  'secret' => Config::secret,
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
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Social Roulette</title>
    <meta name="description" content="Social Roulette has a 1/6 chance of deleting your account, 5/6 chance that it just posts 'you played' to your timeline.">
    
    <meta http-equiv="Content-Type" content="text/html;">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
  <meta property="og:title" content="Social Roulette" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="http://socialroulette.net" />
  <meta property="og:image" content="http://socialroulette.net/img/256.png" />


  <style type="text/css">
    #play {background: red;}
  
  #roulette {
    width: 256px;
    height: 256px;
    margin:0 auto;
    top:0px;
    position:relative;
  }

  #rouletteBackground{
    position:absolute;
    background-image: url("animation/roul1.png"); 
    background-size:256px;
    width: 256px;
    height: 256px;
  }
  #rouletteRotater{
    position:absolute;
    background-image: url("animation/roul2.png"); 
    background-size:256px;
    width: 256px;
    height: 256px;
  }
  #rouletteCrosshair{
    position:absolute;
    background-image: url("animation/crosshgair.png"); 
    background-size:256px;
    width: 256px;
    height: 256px;
  }    
  </style>  
</head>
  <body>
  <div class="navbar navbar-inverse navbar-roulette">
      <div class="navbar-inner">
          <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </a>
              <a class="brand" href="http://socialroulette.com/">
                <strong>Social Roulette</strong>
              </a>
              <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                      <li><a href="http://twitter.com/roulettenet"><img src="./img/twitterIcon.png" class="twitterIcon">Twitter</a></li>
                      <li><a href="mailto:info@socialroulette.com"><img src="./img/mailIcon.png" class="contactIcon">Contact</a></li>
                </ul>
            </div>
          </div>
        </div>
    </div>
    <div style="padding-top: 30px; padding-bottom: 20px; text-align: center;" class="roulette-title-background row-fluid">
       <div class="span4 rouletteQuoteSpan" id="appQuote"><img src="./img/quote.png" class="rouletteQuote" width="256" height="169"></div>
   
      <?php if($user): ?>
      <div class="span4">
        <div id="roulette">
          <div id="rouletteBackground"></div>
          <div id="rouletteRotater"></div>
          <div id="rouletteCrosshair"></div>        
        </div>
      </div>

      <?php else: ?>    
        <div class="span4" id="appIcon"><img src="./img/256.png" width="256" height="256"></div>
      <?php endif;?>

    <div class="span4" id="downloadArea" style="margin-left:0px; margin-top: 90px;">
      <?php if($user): ?>
        <a class="btn btn-large btn-primary" id="play" href="">Play Social Roulette Now</a>
      <?php else: ?>
        <a class="btn btn-large btn-primary" href="<?php echo $loginUrl?>">Sign in to play Social Roulette</a>
      <?php endif;?>
      
<br/><br/><br/>
  <style type="text/css">#fake-like-rapper{display: inline-block;margin:0;padding:0;}#fake-like-rapper div{float:left;margin:0;padding:0;}#like-fake div.connect_widget_button_count_including, td.connect_widget_simple_including{margin:0;padding:0;}#like-fake td, td.label{font-size: 11px;text-align: left;margin:0;padding:0;}#like-fake{font-size: 11px;font-family:"lucida grande",tahoma,verdana,arial,sans-serif;color:#333;line-height:1.28;text-align: left;direction: ltr;margin-top: 1px !important; margin-left: -2px!important;position: relative;float:left;}#like-fake .uiGrid{border: 0;border-collapse: collapse;border-spacing: 0;}#like-fake .connect_widget_button_count_count{background: white;border: 1px solid #D1D1D1;float: left;font-weight: normal;height: 14px;margin-left: 1px;min-width: 17px;padding: 1px 2px 1px 2px;text-align: center;line-height: 14px;white-space: nowrap;}#like-fake .connect_widget_button_count_nub s, #like-fake .connect_widget_button_count_nub i{border: solid transparent;border-right-color: #D7D7D7;top: 1px;display: block;position: relative;border-width: 4px 5px 4px 0;}#like-fake .connect_widget_button_count_nub i{left: 2px;top: -7px;border-right-color: white;}#like-fake .connect_widget_button_count_nub {float: left; position: relative; height: 0; width: 5px; top: -5px; left: 2px; }</style><div id="fake-like-rapper"><div class="fb-like" data-href="http://socialroulette.org" data-send="false" data-layout="button_count" data-width="48" data-show-faces="false" data-font="arial" style="width: 48px; height: 20px; overflow: hidden;"></div><div id="like-fake"><div class="connect_widget_button_count_including"><table class="uiGrid" cellspacing="0" cellpadding="0"><tbody><tr><td><div class="thumbs_up hidden_elem"></div></td><td><div class="undo hidden_elem"></div></td></tr><tr><td><div class="connect_widget_button_count_nub"><s></s><i></i></div></td><td><div class="connect_widget_button_count_count">1056</div></td></tr></tbody></table></div></div></div>

    </div>
    <div style="clear: both;text-shadow: 0px 1px 1px #91999d; color:black; font-size:30px; padding: 15px 55px 0px 55px; line-height: 50px" id="result">Social Roulette has a 1 in 6 chance of deleting your account.<br/>What are you afraid of?</div></div>
    
    <div class="container center">
    <div class="dlead dmargintop dmarginbottom">Testimonials</div>
    <div class="justify maintext"><h4>"Social Roulette just rewrote the rules for online gaming." <small><a href="http://gawker.com/">Gawker</a></small></h4></div>
    <div class="justify maintext"><h4>"Man, if only these hackers could make up their mind." <small><a href="https://twitter.com/bruces">Bruce Sterling</a></small></h4></div>
    <div class="justify maintext"><h4>"It's the most exciting thing I've done this year." <small><a href="http://daringfireball.net/">John Gruber</a></small></h4></div>
    <div class="justify maintext"><h4>"I still can't tell whether I won or not." <small><a href="http://twitter.com/FaltyDL">FaltyDL</a></small></h4></div>
    </div>
    
    <hr class="roulette">
    <div class="container center">
    <div class="dlead dmargintop dmarginbottom">The Story</div>
    <div class="justify maintext">Social Roulette has a 1 in 6 chance of deleting your account, and a 5 in 6 chance that it just posts "I played Social Roulette and survived" to your timeline.</div>
    <div><img src="img/post.png" width="582" height="226" style="margin:40px 0"/></div>
    <div class="justify maintext">Everyone thinks about deleting their account at some point, it's a completely normal reaction to the overwhelming nature of digital culture. Is it time to consider a new development in your life? Are you looking for the opportunity to start fresh? Or are you just seeking cheap thrills at the expense of your social network? Maybe it's time for you to play Social Roulette.</div>
    </div>
    
    <hr class="roulette">    
    <div class="container center">
    <div class="dlead dmargintop dmarginbottom">Rules</div>
    <div class="justify maintext">There are a few basic rules for playing a successful game of Social Roulette.</div>
    <div class="justify maintext">
    <ol>
    <li>You must play with your <span class="highlighted">own account</span>.</li>
    <li>You must only play <span class="highlighted">once a day</span>.</li>
    </ol>
    </div>
    </div>
    
    <hr class="roulette">  
    <div class="container center">  
    <div class="dlead dmargintop dmarginbottom">T-Shirts</div>
    <div class="justify maintext">Have you survived Social Roulette? Why not flaunt it with a t-shirt?</div>
    <div><a href="http://skreened.com/socialroulette/i-survived-social-roulette"><img src="http://skreened.com/render-product/n/e/i/neiemzqzaafizownjsdq/i-survived-social-roulette.american-apparel-unisex-fitted-tee.black.w380h440z1.jpg" width="380" height="440" style="margin:40px 0"/></a></div>
    </div>
    
    <!-- Like Button -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- end like -->

  </div>
  <script src="javascript/jquery.min.js"></script>
  <script src="javascript/bootstrap.min.js"></script>
  <script src="javascript/theme.js"></script>

  <script>
    var returnMess = "";
    var tickSnd = new Audio("animation/tick.wav"); // buffers automatically when created
    tickSnd.addEventListener('ended', function() {
        this.currentTime = 0;
    }, false);
    
    var rotation = 0;
    var speed = 20;
    var ticks = 0;
    var force = 0;
    
    var finished = false;
    
    function finish(){
      finished = true;
      
      if(ticks <= 4){
        console.log("looser");
      } else {
        console.log("WINNER");
      }
      
      $("#result").html(returnMess);
      $("#play").text("Done");
    
    }
    
    function update(){
      if(!finished){
        force += speed;
      
        if(speed < 2 && (tickValue > ticks || (ticks == 5 && tickValue < 5))) {
          finish();
          return;
        };
      
          rotation += force;
          rotation = rotation % 360;
      
          tickValue = Math.floor((rotation/360)*6);
          if(tickValue > ticks || (ticks == 5 && tickValue < 5)){       
            rotation -= force;
            rotation = rotation % 360;

            if(force > 10){
              force = speed*1.5;
              ticks++;
              ticks = ticks%6;
              if(tickSnd.currentTime == 0 ){
                tickSnd.play();
              }
           }  
        } else {
          force = 0;
        }
      
      
        speed *= 0.997;
        rotate(rotation);      
      }
    
      function rotate( deg){
        $("#rouletteRotater").css("-webkit-transform","rotate("+deg+"deg)");
        $("#rouletteRotater").css("-ms-transform","rotate("+deg+"deg)");
        $("#rouletteRotater").css("transform","rotate("+deg+"deg)");
      }      
    }

    
    $("#play").click(function() {      
      //do animation stuff here      

      $("#play").text("Playing...").unbind("click");

      $.ajax({
        url: "/play.php",
        success: function(data) {          
          obj = $.parseJSON(data);
          console.log(obj);
          if(obj.message === "503") {

            window.location.href = "http://socialroulette.net/";
          
          } else {            
            var loop = setInterval(function(){update()},30);
            rotation = obj.result;
            returnMess = obj.message;
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
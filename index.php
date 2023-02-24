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

$loginUrl = $facebook->getLoginUrl(array('scope' => 'publish_stream, email')); 
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
  <meta property="og:url" content="https://socialroulette.net" />
  <meta property="og:image" content="https://socialroulette.net/img/256.png" />


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
    background-image: url("animation/roul3.png"); 
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
              <a class="brand" href="https://socialroulette.net/">
                <strong>Social Roulette</strong>
              </a>
              <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                      <li><a href="https://twitter.com/roulettenet"><img src="./img/twitterIcon.png" class="twitterIcon">Twitter</a></li>
                      <li><a href="mailto:info@socialroulette.net"><img src="./img/mailIcon.png" class="contactIcon">Contact</a></li>
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
        <div class="span4" id="appIcon"><img src="./img/256_2.png" width="256" height="256"></div>
      <?php endif;?>

    <div class="span4" id="downloadArea" style="margin-left:0px; margin-top: 90px;">
      <?php if($user): ?>
        <a class="btn btn-large btn-primary" id="play" href="">Play Social Roulette Now</a>
      <?php else: ?>
        <a class="btn btn-large btn-primary" href="<?php echo $loginUrl?>">Sign in to play Social Roulette</a>
      <?php endif;?>
      
<br/><br/>
<div class="fb-like" data-href="https://socialroulette.net/" data-send="false" data-layout="box_count" data-width="450" data-show-faces="false" data-font="arial"></div>

    </div>
    <div style="clear: both;text-shadow: 0px 1px 1px #91999d; color:black; font-size:30px; padding: 15px 55px 0px 55px; line-height: 50px" id="result">Social Roulette has a 1 in 6 chance of deleting your account.<br/>What are you afraid of?</div></div>
    
    <div class="container center">
    <div class="dlead dmargintop dmarginbottom">Testimonials</div>
    <div class="justify maintext"><h4>"Social Roulette just rewrote the rules for online gaming." <small><a href="https://gawker.com/">Gawker</a></small></h4></div>
    <div class="justify maintext"><h4>"*Man, if only these hackers could make up their mind." <small><a href="https://twitter.com/bruces">Bruce Sterling</a></small></h4></div>
    <div class="justify maintext"><h4>"It's the most exciting thing I've done this year." <small><a href="https://daringfireball.net/">John Gruber</a></small></h4></div>
    <div class="justify maintext"><h4>"I still can't tell whether I won or not." <small><a href="https://twitter.com/FaltyDL">FaltyDL</a></small></h4></div>
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
    <li>You may only play <span class="highlighted">once a day</span>.</li>
    </ol>
    </div>
    </div>
    
    <hr class="roulette">    
    <div class="container center">
    <div class="dlead dmargintop dmarginbottom">FAQ</div>
    <div class="justify maintext"><h4>Can Social Roulette really delete my account?</h4></div>
    <div class="justify maintext">Yes. While it's very difficult to "<a href="http://www.facebook.com/help/224562897555674/">permanently delete</a>" a Facebook account, we can completely remove all your posts, friends, apps, likes, photos, and games before completely deactivating it.</div>
    </div>
    
    <br/><br/>
    
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
        console.log("Account is alive.");
      } else {
        console.log("Account is dead.");
      }
      
      $("#result").html(returnMess);
      $("#play").text("Done");
  
      if(returnMess.match(/survived/g)) {
        //append post to FB button
        $("<a href='' class='postToFB btn btn-primary'>Post 'I just survived Social Roulette' to Facebook</a>").insertAfter($("#result"));

      }

    
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

      $.ajax({
        url: "/play.php",
        success: function(data) {          
          obj = $.parseJSON(data);
          console.log(obj);
          if(obj.message === "503") {

            window.location.href = "http://socialroulette.net/";
          
          } else if (obj.message === "505") {
            $("#result").html("You can only play Social Roulette once a day.");

          } else if (obj.message === "506") {
            window.location.href = obj.redirect;

          } else {     
            $("#play").text("Playing...").unbind("click");
      
            var loop = setInterval(function(){update()},30);
            rotation = (obj.result + 4) * (360/6);
            returnMess = obj.message;

          }
        }
      });

      $(".postToFB").live("click", function() {
        $(".postToFB").text("Posting...");
        $.ajax({
          url: "/post.php",
          data: {post: 1},
          success: function(data) {
            if(data === "success") {
              $(".postToFB").replaceWith("<h4>Posted!</h4>");
            } else {
              $(".postToFB").replaceWith("<h4 class='red'>You need to play to be able to post</h4>");
            }
          }
        });

        return false;
      });

      return false;
    });
  </script>
</body>
</html>

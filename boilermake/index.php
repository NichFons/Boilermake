<?php
/**
* include your database connection from a protected directory
* by include it from the directory above (../) where this file is
**/
include('connection.php');

// set cookie for a day
setcookie('user_long', $_GET['long'], time() + (86400), "/");
setcookie('user_lat', $_GET['lat'], time() + (86400), "/");
// 86400 is one day

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
  <meta name="description" content="A layout example that shows off a blog page with a list of posts.">

  <title>Stroll</title>
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
  <link rel="stylesheet" href="css/component.css">

<script>
  // Grab Location
  function getLocation()
  {
    if (navigator.geolocation)
    {
      navigator.geolocation.getCurrentPosition(showPosition);
    }
    else{x.innerHTML="Geolocation is not supported by this browser.";}
    }
      function showPosition(position)
    {
        
    var long = position.coords.longitude;
    var lat = position.coords.latitude;
  }

  getLocation()
</script>
<!--[if lte IE 8]>
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css">
  
    <![endif]-->
    <!--[if gt IE 8]><!-->

    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">
    
    <!--<![endif]-->

    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/blog-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/layouts/blog.css">
        <!--<![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Raleway:200' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="css/ns-default.css" />

        <link rel="stylesheet" type="text/css" href="css/hover.css" />
        
        
        <script src="js/modernizr.custom.js"></script>
        

        
        </head>
        <body>
<!-- 
<div class="animated fadeIn"> -->
          <div id="layout" class="pure-g">
            <div class="z-top sidebar pure-u-1 pure-u-md-1-4">
              <div class="header">
                <hgroup>
                  <h1 class="brand-title">Stroll</h1>
                  <h2 class="brand-tagline">Vote on polls around you</h2>
                </hgroup>

                <nav class="nav">
                  <ul class="nav-list">
                    <li class="nav-item">
                      <a class="pure-button trans" href="http://blog.johnsylva.in">Popular</a>
                    </li>
                    <li class="nav-item">
                      <a class="pure-button trans" href="http://cgt.johnsylva.in">Recent</a>
                    </li>
                    <li class="nav-item">
                      <div id='osx-modal'>

                       <a href='#' class='osx pure-button trans'>Add New Question</a>
                      </div>
                    </li>

                  </ul>
                </nav>
              </div>
            </div>
            <div class="content pure-u-1 pure-u-md-3-4">
            <?php

            //run the query
            $loop = mysql_query("SELECT * FROM Poll")
                or die (mysql_error());

            while ($row = mysql_fetch_array($loop))
            {      
            ?>
            
              <section id="a">
                  <h2 div="question" id="<?php echo $row['PollID']; ?>"><?php echo $row['Question']; ?></h2>
                  <div class="container">
                  <?php 
                    $query = 'SELECT * FROM Response where PollID = ' . $row['PollID'];
                    $result = mysql_query($query)
                        or die (mysql_error());

                    while ($row = mysql_fetch_array($result))
                    {   
                    ?>
                  <div rel = "choice" class="choices float trans">
                    <div class="choices-after"></div>
                      <h3><?php echo $row['Response'] ?></h3>
                      <div class="result hide"><?php echo $row['Count'] ?></div>
                  </div>
                   <?php } ?>
                    </div>
              </section>
              <hr class="half-rule">
         <?php } ?>
               <div class="footer">
                <div class="pure-g">
                	<div class="pure-u-1 pure-u-md-1-3 foot-tag">
                		<h3 class="brand-tagline foot-tag">Created by John Sylvain // David Teter // Nick Fonseca</h3>
                	</div>
                	<div class="pure-u-1 pure-u-md-2-3">
                		<ul id="navlist">
                			<li class="ppad-right footer-soc"><a class="social" href="https://Github.com/VilJam"><img class="social-icon trans" src="img/Github.png" alt=""></a></li>
                			<li class="footer-soc ppad-right"><a class="social" href="http://www.linkedin.com/pub/john-sylvain/72/564/2ab"><img class="social-icon trans" src="img/linkedin.png" alt=""></a></li>
                			<li class="footer-soc pppad-right"><a class="social" href="http://twitter.com/MagicJahn"><img class="social-icon trans" src="img/twitter.png" alt=""></a></li>
                		</ul>	
                	</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div id="osx-modal-content">
      <div id="osx-modal-title">Create New Question</div>
      <div class="close"><a href="#" class="simplemodal-close">x</a></div>
      <div id="osx-modal-data">
        <form action="">
          <h2>What's your question?</h2>
          <input type="text" placeholder="Enter your question here">
          
          <h2>What do you want people to vote on?</h2>
          <div class="enterchoice">
          <input type="text" placeholder="Enter one of the choices">
          <input type="text" placeholder="Enter another choice">
          </div>
        </form>
        <button id="addnew">Add more choices</button>
      </div>
    </div>
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>
            $(function(){
                $('.choices').on('click', function(){
                    //figure out which panel to active
                    var choiceToShow = $(this).attr('rel');
                    $(this).addClass('active');
                    
                    
                    //fade other panels

                });
            });
            $(function(){
                $('.choices .result').on('click').removeClass('.hide');
            });
        </script>
        <script>
        $(document).ready(function(){

          $("#addnew").click(function(){
            $(".enterchoice").append("<input type='text' placeholder='Enter another choice'>");
          });
        });
        </script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>
        <script src="js/modernizr.not.js"></script>
      </body>
      </html>
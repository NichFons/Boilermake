<?php
session_start();
include('connection.php');
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
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script href="bootstrap/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript">
  function disable() 
  {
    length=document.myform.length;

    for (i=0;i<length;i++) 
    {
      if (document.myform[i].type=="radio") 
      {
        for(i=0;i<length;i++)
          document.myform[i].disabled="disabled";
      }
    }
    
  }
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
        <link rel="stylesheet" type="text/css" href="css/grey.css" />
        <script src="js/jquery.remodal.js"></script>
        <link rel="stylesheet" href="css/jquery.remodal.css">
        
        <script src="js/modernizr.custom.js"></script>
        <script src="js/geoPosition.js"></script>
        <script>
            geoPosition.init()
            function lookup_location() {
              geoPosition.getCurrentPosition(show_map, show_map_error);
            }
            function show_map(loc) {
                $.get( "location.php", { user_long: loc.coords.longitude, user_lat: loc.coords.latitude } );
            }
            function show_map_error() {
              alert('Geolocation Services is not working at the moment. Refresh the page to retry.');
            }
            lookup_location();
        </script>
        
        </head>
        <body>


<div class="pure-g container">
  
  <div class="pure-u-1-4 left">
    <li><h1>stroll</h1></li>
    <li class="about">
      <a href="#about"><h3 class="about trans">about</h3></a>
    </li>
  </div>
  <div class="pure-u-3-4 right">
    <a href="#modal"><img class = "createnew trans" src="img/new85.png" alt=""></a>
  </div>

</div>

<div class="pure-g container center">
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button blue" href="?type=popular">Popular</a></div>
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button red" href="?type=recent">Recent</a></div>
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button yellow" href="?type=votes">My Votes</a></div>
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button green" href="?type=strolls">My Strolls</a></div>
</div>
<hr class="half-rule container margin-hr">
<div class="pure-g container">         
  <div class="pure-u-1">
                  <?php

                    //run the query
                    //recent
                    if($_GET['type'] == "popular"){
                        $loop = mysql_query("SELECT * FROM Poll order by PollDate limit 1")
                        or die (mysql_error());
                    }
                    //Popular
                    else if($_GET['type'] == "popular"){
                        $loop = mysql_query("SELECT * FROM Poll order by PollDate limit 1")
                        or die (mysql_error());
                    }
                    //My votes
                    else if($_GET['type'] == "popular"){
                        $loop = mysql_query("SELECT * FROM Poll order by PollDate limit 1")
                        or die (mysql_error());
                    }
                    //My strolls
                    else if($_GET['type'] == "popular"){
                        $loop = mysql_query("SELECT * FROM Poll order by PollDate limit 1")
                        or die (mysql_error());
                    }
                    //Start from beginning
                    else {
                        $loop = mysql_query("SELECT * FROM Poll limit 1")
                        or die (mysql_error());
                    }

                    while ($row = mysql_fetch_array($loop))
                    {      
                    ?>
                     <section id="a">
                      <h2 class="question"><?php echo $row['Question']; ?></h2>
                      <div class="container">
                        <form id = "<?php echo $row['PollID']; ?>" class="qchoices" name="myform" action="vote.php" method="post">
                         <?php 
                    $query = 'SELECT * FROM Response where PollID = ' . $row['PollID'];
                    $result = mysql_query($query)
                        or die (mysql_error());

                    while ($row = mysql_fetch_array($result))
                    {   
                    ?>
                   
                          <input value="<?php echo $row['Response'] ?>" type="radio" name="foo" onclick="disable()" id="radio1" class="css-checkbox" data-id="show"/>
                          <label for="radio1" class="css-label radGroup2"><?php echo $row['Response'] ?></label><br/>
                          <div class="result hide"><?php echo $row['Count'] ?> votes</div>
                        <?php } ?>
                               <div class="load">
                            <!-- <a href="" type = "submit" class = "pure-button confirm-submit center">Next Question</a> -->
                            <input type="submit" class ="confirm-submit center">
                          </div>

                    </form>
                      
                    </div>
                  </section>
                  <?php } ?>
  </div>
</div>



<div class="remodal" data-remodal-id="modal">
    <h1>Create a new stroll</h1>
    <form method="post" action="question.php">
      <input type="text" name='question' required placeholder="What's your question?">
      <hr class="half-rule">
      <input type="text" required placeholder="Enter a choice!">
      <input type="text" required placeholder="And another!">
      <input type="text" placeholder="One more (only if you are feeling adventurous)">
      <a class="remodal-cancel" href="#">Cancel</a>
      <a class="remodal-confirm" type="submit">Submit!</a>
      <input class="pure-button" type="submit">
    </form>
    <br>
</div>


<div class="remodal" data-remodal-id="about">
    <h1>About stroll</h1>
    wooooooo
</div>

<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>
        <script src="js/modernizr.not.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script src="../src/jquery.remodal.js"></script>
            <script>
                $(document).on('open', '.remodal', function () {
                    console.log('open');
                });

                $(document).on('opened', '.remodal', function () {
                    console.log('opened');
                });

                $(document).on('close', '.remodal', function () {
                    console.log('close');
                });

                $(document).on('closed', '.remodal', function () {
                    console.log('closed');
                });

                $(document).on('confirm', '.remodal', function () {
                    console.log('confirm');
                });

                $(document).on('cancel', '.remodal', function () {
                    console.log('cancel');
                });

            //    You can open or close it like this:
            //    $(function () {
            //        var inst = $.remodal.lookup[$('[data-remodal-id=modal]').data('remodal')];
            //        inst.open();
            //        inst.close();
            //    });

                //  Or init in this way:
                var inst = $('[data-remodal-id=modal2]').remodal();
                //  inst.open();
            </script>
            <script>
        $(document).ready(function(){

          $("form").click(function(){
            $(".result").slideDown();
          });     

        });

        </script>
      </body>
      </html>
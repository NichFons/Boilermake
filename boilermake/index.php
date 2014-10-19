<?php
session_start();
$sessionid = session_id();
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
              
            }
            lookup_location();
        </script>
        
        </head>
        <body>


<div class="pure-g container">
  
  <div class="pure-u-3-4 left">
    <li><h1>stroll</h1></li>
    <li class="about">
      <a href="#about"><h3 class="about trans">about</h3></a>
    </li>
  </div>
  <div class="pure-u-1-4 right">
    <a href="#modal"><img class = "createnew trans" src="img/new85.png" alt=""></a>
  </div>

</div>

<div class="pure-g container center">
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button blue" href="#">Popular</a></div>
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button red" href="#">Recent</a></div>
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button yellow" href="?type=votes">My Votes</a></div>
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button green" href="?type=strolls">My Strolls</a></div>
</div>
<hr class="half-rule container margin-hr">
<div class="pure-g container">         
  <div class="pure-u-1">
                  <?php
                    $range = 10.000; //100m grains, x10 for 1k, x100 for 10k
                    //run the query
                    //recent
                    if($_GET['type'] == "recent"){
                        $loop = mysql_query("SELECT * FROM Poll where PollID not in (select PollID from User_Response where sessionid = '$sessionid') 
                                    and (longitude between " . $_SESSION['user_long'] . "-0.001*$range and " . $_SESSION['user_long'] . "+0.001*$range) and (latitude between " . $_SESSION['user_lat'] . "-0.001*$range and " . $_SESSION['user_lat'] . "+0.001*$range )
                                    order by PollDate limit 1")
                        or die (mysql_error());
                    }
                    //Popular
                    else if($_GET['type'] == "popular"){
                        $loop = mysql_query("SELECT * FROM Poll where PollID not in (select PollID from User_Response where sessionid = '$sessionid')
                                and (longitude between " . $_SESSION['user_long'] . "-0.001*$range and " . $_SESSION['user_long'] . "+0.001*$range) and (latitude between " . $_SESSION['user_lat'] . "-0.001*$range and " . $_SESSION['user_lat'] . "+0.001*$range )
                                order by PollDate limit 1")
                        or die (mysql_error());
                    }
                    //My votes
                    else if($_GET['type'] == "votes"){
                        $loop = mysql_query("SELECT * FROM Poll inner join User_Response on User_Response.PollID=Poll.PollID where Poll.PollID in (select PollID from User_Response where sessionid = '$sessionid') order by TimeSubmitted desc limit 20")
                        or die (mysql_error());
                    }
                    //My strolls
                    else if($_GET['type'] == "strolls"){
                        $loop = mysql_query("SELECT * FROM Poll where PollID in (select PollID from User_Stroll where sessionid = '$sessionid') order by PollDate desc limit 20")
                        or die (mysql_error());
                    }
                    //Start from beginning
                    else {
                        $loop = mysql_query("SELECT * FROM Poll where PollID not in (select PollID from User_Response where sessionid = '$sessionid') order by PollDate limit 1")
                            or die (mysql_error());
                    }
                    if (!mysql_num_rows($loop)) { ?>
                        
                        <h2>No Strolls found. :( <br> <a href="#modal">Submit your own!</a></h2>
                        <?php
                    }
                    while ($poll = mysql_fetch_array($loop))
                    {      
                    ?>
                     <section id="a">
                      <h2 class="question"><?php echo $poll['Question']; ?></h2>
                      <p><?php if ($_GET['type'] == "strolls" || $_GET['type'] == "votes") {
                        
                        echo "Text 'stroll " . $poll['PollID'] ."' to (812)558-3919"; 
                         
                        }?></p>
                      <div class="container">
                        <form id = "<?php echo $poll['PollID']; ?>" class="qchoices" name="myform" action="vote.php" method="post">
                         <?php 
                    $query = 'SELECT * FROM Response where PollID = ' . $poll['PollID'] . ' order by Number';
                    $result = mysql_query($query)
                        or die (mysql_error());
                    while ($row = mysql_fetch_array($result))
                    {   
                    ?>
                   
                          <input value="<?php echo $row['Number'] ?>" type="radio" name="response" id="radio<?php echo $row['Number'] ?>" class="css-checkbox" data-id="show" <?php if ($_GET['type'] == "strolls" || $_GET['type'] == "votes") echo 'disabled' ?>/>
                          <label for="radio<?php echo $row['Number'] ?>" class="css-label radGroup2"><?php echo $row['Response']; ?></label><br/>
                          <div class="result <?php if ($_GET['type'] != "strolls" && $_GET['type'] != "votes") echo 'hide' ?>"><?php echo $row['Count']; ?> votes</div>
                        <?php } ?>
                        <div class="load">
                            <!-- <a href="" type = "submit" class = "pure-button confirm-submit center">Next Question</a> -->
                            <input class="hide" value="<?php echo $poll['PollID']; ?>" name="PollID">
                            <input value="Next Stroll" type="submit" class ="<?php if ($_GET['type'] == "strolls" || $_GET['type'] == "votes") echo 'hide'; else echo 'confirm-submit center' ?> ">
                          </div>

                    </form>
                    </div>
                  </section>
                  <?php } ?>
                  <p class="hide"><?php echo "SELECT * FROM Poll where PollID not in (select PollID from User_Response where sessionid = '$sessionid') 
                                    and (longitude between " . $_SESSION['user_long'] . "-0.001*$range and " . $_SESSION['user_long'] . "+0.001*$range) and (latitude between " . $_SESSION['user_lat'] . "-0.001*$range and " . $_SESSION['user_lat'] . "+0.001*$range )
                                    order by PollDate limit 1" ?></p>
  </div>
</div>



<div class="remodal" data-remodal-id="modal">
    <h1>Create a new stroll</h1>
    <form method="post" action="question.php">
      <input type="text" name='question' required placeholder="What's your question?">
      <hr class="half-rule">
      <input name="response1" type="text" required placeholder="Enter a choice!">
      <input name="response2" type="text" required placeholder="And another!">
      <input name="response3" type="text" placeholder="One more (only if you are feeling adventurous)">
      <a class="remodal-cancel" href="#">Cancel</a>
      <input class="confirm-submit" type="submit">
    </form>
    <br>
</div>


<div class="remodal" data-remodal-id="about">
    <h1>About stroll</h1>
    <p class="left">Allows users to create polls for people in their local area. Need to know what the best restaurant in town is? Make a stroll poll. Have to know where to find the best parties are around your campus? Make a stroll poll. Looking to figure out the opinions of a band in your area? Make a stroll poll.</p>

<p class="left">No account is needed to vote or create poll. No usernames. No nonsense. Just go to the app on your laptop, Android, or iOS device and find out what people near you think.</p>

<p class="left"><?php 
    $stats = mysql_query('select count(distinct Poll.pollID) as polls, (select sum(Response.count) from Response) as votes, count(distinct User_Response.SessionID) as users from Poll inner join Response on Response.PollID=Poll.PollID inner join User_Response on User_Response.PollID=Response.PollID');
    $result = mysql_fetch_array($stats);
    ?>Users: <?php echo $result['users'] ?><br>
     Polls: <?php echo $result['polls'] ?><br>
     Votes: <?php echo $result['votes'] ?> <br>
    </p>

<p class="left">Created by <a href="http://johnsylva.in">John Sylvain</a>, <a href="http://cosmicshades.com">David Teter</a>, and <a href="">Nick Fonseca</a>.</p>
</div>
           
            <script src="js/modernizr.not.js"></script>
            <script src="../src/jquery.remodal.js"></script>

           <?php if ($_GET['type'] != "strolls" && $_GET['type'] != "votes"){ ?>  <script>
        $(document).ready(function(){

          $("form").click(function(){
            $(".result").slideDown();
          });     

        });

        </script>
        <?php } ?>
      </body>
      </html>

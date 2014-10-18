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
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button blue" href="">Popular</a></div>
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button red" href="">Recent</a></div>
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button yellow" href="">My Votes</a></div>
  <div class="pure-u-1-2 pure-u-md-1-4 margin-navbar"><a class = "pure-button green" href="">My Strolls</a></div>
</div>
<hr class="half-rule container margin-hr">
<div class="pure-g container">
  <div class="pure-u-1">
                  <section id="a">
                      <h2 class="question">Lorem ipsum Sit do Duis ut do mollit?</h2>
                      <div class="container">
                        <form id = "1" class="qchoices" name="myform" action="">
                         
                          <input type="radio" name="foo" onclick="disable()" id="radio1" class="css-checkbox" data-id="show"/>
                          <label for="radio1" class="css-label radGroup2">Lorem ipsum Eu in et in voluptate fugiat pariatur velit reprehenderit in eiusmod sed adipisicing voluptate minim Excepteur minim amet ullamco et.</label><br/>
                          <div class="result hide">30 votes</div>

                          <input type="radio" name="foo" onclick="disable()" id="radio2" class="css-checkbox" data-id="show"/>
                          <label for="radio2" class="css-label radGroup2">Lorem ipsum Ullamco aliquip proident occaecat aliquip do sunt deserunt eu nostrud Duis proident nisi nostrud sint.</label><br/>
                          <div class="result hide">40 votes</div>

                          <input type="radio" name="foo" onclick="disable()" id="radio3" class="css-checkbox" data-id="show"/>
                          <label for="radio3" class="css-label radGroup2">Lorem ipsum Duis qui dolore nulla adipisicing sint dolor eiusmod tempor quis ex cillum eiusmod Duis tempor nisi ut nulla Ut dolor.</label><br/>
                          <div class="result hide">230 votes</div>
    <div class="load">
                    <a href="" type = "submit" class = "pure-button remodal-confirm center">Next Question</a>
                  </div>

                        </form>
                      
                        </div>
                  </section>
    
  </div>
</div>



<div class="remodal" data-remodal-id="modal">
    <h1>Create a new stroll</h1>
    <form action="">
      <input type="text" required placeholder="What's your question?">
      <hr class="half-rule">
      <input type="text" required placeholder="Enter a choice!">
      <input type="text" required placeholder="And another!">
      <input type="text" placeholder="One more (only if you are feeling adventurous)">
      <a class="remodal-cancel" href="#">Cancel</a>
      <a class="remodal-confirm" type="submit" href="#">Submit!</a>
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
      </body>
      </html>